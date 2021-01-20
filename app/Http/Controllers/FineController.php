<?php

namespace App\Http\Controllers;

use App\Models\Fine;
use App\Models\FineReason;
use App\Models\FineStatus;
use App\Models\Inhabitant;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade as PDF;

class FineController extends Controller
{
    public function __construct() {
       
        $this->middleware('admin')->only(['finesView', 'addFinesView', 'postSearch', 'fineShow', 'setFine', 'editFine',
                                          'deleteFine', 'setFineEdit', 'editFineStatus', 'setFineStatus']);
        $this->middleware('tenant')->only(['index', 'download']);
        
    }
    /*Tenant*/
    
    public function index()
    {
        $user = auth()->user()->id;
        $inh = Inhabitant::where('user_id', $user)->first();
        return view('/tenant/fines',  array('fines' => Fine::where('inhabitant_id', $inh->id)->orderBy('id', 'desc')->get()));
         //return view('/fines', array('fines' => Fine::where('status_id')->get()));
    }
    
    
    public function download(Request $request)
    {
        $fine = Fine::where('id', $request->fineid)->first();
        $inhabitant = Inhabitant::where('id', $fine->inhabitant_id)->first();
        $reason = FineReason::where('id', $fine->fine_reason_id)->first();
        $name = 'Fine_'.$request->fineid.'.pdf';
        
        $path = public_path('img/1.jpg');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $datai = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($datai);


        $data = [
            'fine' => $fine,
            'inhabitant' => $inhabitant,
            'reason' => $reason,
            'name' => $name,
            'pic' =>  $base64
            ];
        
        $pdf = PDF::loadView('/tenant/pdf/fine', $data); 
        
        return $pdf->download($name);
    }
    
    
    
    
    /*Admin*/
    public function finesView()
    {
        $n = Fine::orderBy('updated_at', 'desc')->paginate(10);
        return view('/admin/fine_management/fines', array('fines' => $n));
    }
    
    public function addFinesView()
    {
        
         return view('/admin/fine_management/fines_add');
    }
    
    
    public function postSearch(Request $request) {
        
        
        return Inhabitant::where('name', 'LIKE', '%'.$request->get('search').'%')
                ->orWhere('surname', 'LIKE', '%'.$request->get('search').'%')->get();
    }   
    
    public function fineShow($id)
    {
        $reason = FineReason::all();
        $reason = $reason->pluck('name', 'id');
        
        return view('/admin/fine_management/fine_info', ['status' => $reason, 'inh' => Inhabitant::where('id', $id)->first()]);
        
    }
    
    public function setFine(Request $request)
    {
        $rules = array(
            'status' => 'required',
            'fsum' => 'numeric|nullable',
        );     
        
       $this->validate($request, $rules); 
       
       $fine = new Fine(); 
       $fine->inhabitant_id = $request->inhid;
       $fine->fine_reason_id = $request->status;
       $fine->sum = $request->fsum;
       
       if($request->fsum == NULL)
       {
          $fine->fine_status_id = 3; 
       }
       
       else{
           $fine->fine_status_id = 1;
       }
       
       $fine->save();

       return redirect()->action('FineController@finesView');
       // return view('/admin/fines', array('fines' => Fine::orderBy('status_id')->get()));
    }
    
    public function editFine($id)
    {
        $reason = FineReason::all();
        $reason = $reason->pluck('name', 'id');
        
        return view('/admin/fine_management/editfine', ['fine' => Fine::where('id', $id)->first(), 'status' => $reason]);
    }
        
    public function deleteFine(Request $request)
    {
         Fine::where('id',$request->fineid)->delete();
         return redirect()->action('FineController@finesView');
        // $n = Fine::orderBy('updated_at', 'desc')->paginate(10);
        // return view('/admin/fines', array('fines' => $n));
    }
    
    public function setFineEdit(Request $request)
    {
          $rules = array(
            'status' => 'required',
            'fs' => 'numeric|nullable',
            );        
         $this->validate($request, $rules); 
         $fine = Fine::where('id', $request->fineid)->first();
         $fine->fine_reason_id = $request->status;
         $fine->sum = $request->fs;
         $fine->updated_at = Carbon::now();
         
         if($request->fs == NULL)
         {
              $fine->fine_status_id = 3; 
         }
         else
         {
             $fine->fine_status_id = 1; 
         }
         
         $fine->save();
         
         return redirect()->action('FineController@finesView');
         //$n = Fine::orderBy('updated_at', 'desc')->paginate(10);
         //return view('/admin/fines', array('fines' => $n));
    }
    
    public function editFineStatus($id)
    {
        $status = FineStatus::all();
        $status = $status->pluck('name', 'id');
        
        return view('/admin/fine_management/editfine_status', ['fine' => Fine::where('id', $id)->first(), 'status' => $status]);
    }
    
    
    public function setFineStatus(Request $request)
    {
          $rules = array(
            'status' => 'required',
            );        
         $this->validate($request, $rules); 
         
         $fine = Fine::where('id', $request->fineid)->first();
         $fine->fine_status_id = $request->status;
    
         $fine->save();
         $n = Fine::orderBy('updated_at', 'desc')->paginate(10);
        return view('/admin/fine_management/fines', array('fines' => $n));
         return redirect()->action('FineController@finesView');

    }
}
