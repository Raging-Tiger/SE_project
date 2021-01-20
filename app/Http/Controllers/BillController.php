<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\ApartmentInhabitant;
use App\Models\Bill;
use App\Models\BillStatus;
use App\Models\Inhabitant;
use App\Models\Meter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade as PDF;

class BillController extends Controller
{
    
    public function __construct() {
       
        $this->middleware('admin')->only(['listBills', 'makeBillView', 'setBills', 'editBill', 'setBillEdit', 'downloadBill']);
        $this->middleware('tenant')->only(['index', 'showUploadFile', 'download']);
        
    }
      
      
      
    public function index()
    {
        $user = auth()->user()->id;
        
        $inhabitant = Inhabitant::where('user_id', $user)->first();
        
        if(isset($inhabitant->id))
        {
            $inhabitant = $inhabitant->id;
            $apps = ApartmentInhabitant::where('inhabitant_id', $inhabitant)->get();
        
            $apps_numbers = array();
            foreach($apps as $app)
            {
                array_push($apps_numbers, $app->apartment_id);
            }
        
            $queries = array();
            foreach($apps_numbers as $number)
            {
                array_push($queries, Bill::where('apartment_id', $number)->get());
            }
            return view('/tenant/bill', ['apps' => $apps, 'numbers' => $apps_numbers, 'js' => $queries]);
        }

        return view('/general/error');
       
    }
    
   
   public function showUploadFile(Request $request) {
       
      $rules = array(
            'bill' => 'required|mimetypes:application/pdf',
    
        );        
        $this->validate($request, $rules); 
      $file = $request->file('bill');

      $bill_id = $request->billid.'.pdf';
      
      $bill = Bill::where('id', $request->billid)->first();
      $bill->bill_status_id = 4;
      $bill->save();
      
      $file->storeAs('/public/uploads/bills', $bill_id);
         
     return redirect()->action('BillController@index');
      
   }
    
    public function download(Request $request)
    {
        $bill = Bill::where('id', $request->billid)->first();
        $appartment = Apartment::where('id', $bill->apartment_id)->first();
        $inh = Inhabitant::where('user_id' ,auth()->user()->id) ->first();
        
        $name = 'Bill_'.$request->billid.'.pdf';
        
        $path = public_path('img/1.jpg');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $datai = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($datai);


        $data = [
            'bill' => $bill,
            'appartment' => $appartment,
            'inh' => $inh,
            'name' => $name,
            'pic' =>  $base64
            ];
        
        $pdf = PDF::loadView('/tenant/pdf/bill', $data);  
        
         
        return $pdf->download($name);
    }
    
    
    
    /*Admin*/
    public function listBills(Request $request)
    {
        
       
        $bills = Bill::orderBy('created_at', 'desc')->get();
        
        return view ('/admin/bill_management/billist_view', ['bills' => $bills]);
        
    }
    
    public function makeBillView()
    {
        
        return view ('/admin/bill_management/bill');
    }
    
    
    public function  setBills(Request $request)
            
    {
       $rules = array(

            'admsum' => 'required|numeric',
            'admsummeter' => 'required|numeric',
            'hot' => 'required|numeric',
            'cold' => 'required|numeric',
            'heat' => 'required|numeric',
       );        
       
      $this->validate($request, $rules); 
      $apps = Apartment::all();
        
        foreach($apps as $app)
        {
            
             $bill = new Bill(); 
             $bill->apartment_id = $app->id;
             $bill->cost_per_m2	= ($app->area_m2 * $request->admsum);
             $bill->management_cost	= ($app->area_m2 * $request->admsummeter);
             
             $sum_utilities = 0;
             $month = date("m",strtotime($request->date));
             $year = date("Y",strtotime($request->date));
             
             for ($i = 1; $i < 4; $i++)
             {
                 
                 
                 $meter_last = Meter::where('apartment_id', '=', $app->id)
                         ->where('meter_type_id', '=', $i)
                         ->whereMonth('created_at', '=', $month)
                         ->whereYear('created_at', '=', $year)
                         ->orderBy('created_at', 'desc')->first();
                 $meter_prev = Meter::where('apartment_id', '=', $app->id)->where('meter_type_id', '=', $i)->orderBy('created_at', 'desc')->skip(1)->take(1)->first();
                 
                 if($meter_last == NULL || $meter_prev == NULL)
                 {
                     $average = Bill::avg('total_meters_cost');
                     $sum_utilities = $average;
                     break;
                 }
                 
                 $meter_total = $meter_last->amount - $meter_prev->amount;
                 
                 if ($i == 1)
                 {
                     $sum_utilities+= $meter_total*$request->cold;
                 }
                 
                 if ($i == 2)
                 {
                     $sum_utilities+= $meter_total*$request->hot;
                 }
                 
                 if ($i == 3)
                 {
                     $sum_utilities+= $meter_total*$request->heat;
                 }
             }
             
             $bill->total_meters_cost = $sum_utilities;
             $bill->bill_status_id = 1;
             $bill->created_at = $request->date;
             $bill->save();
            
            
        }
        

    
          return redirect()->action('BillController@listBills');
    }
    
    public function  editBill($id)
    {
       $status = BillStatus::all();
       $status = $status->pluck('name', 'id');
        return view ('/admin/bill_management/bill_edit', ['bill' => Bill::where('id', $id)->first(), 'status' => $status]);
    }
    
    public function  setBillEdit(Request $request)
    {
            
      $rules = array(

            'admsum' => 'required|numeric',
            'admsummeter' => 'required|numeric',
            'total' => 'required|numeric',
            'status' => 'required',
      );
       
      $this->validate($request, $rules);       
            
      $bill = Bill::where('id', $request->billid)->first();
      
      
      $bill->cost_per_m2 = $request->admsum;
      $bill->management_cost = $request->admsummeter;
      $bill->total_meters_cost = $request->total;
             
      $bill->bill_status_id=$request->status;
      $bill->save();
      
       //return view ('/admin/bill_management/billist_view', ['bills' => $bills]);
      return redirect()->action('BillController@listBills');
    }
    
    
    public function  downloadBill(Request $request)
    {
       
        $path = '/public/uploads/bills/'.$request->billid.'.pdf';
       
        return Storage::download($path);
       
        
    }
}
