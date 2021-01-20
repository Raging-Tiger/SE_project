<?php

namespace App\Http\Controllers;

use App\Models\Meter;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class MeterController extends Controller
{
    public function __construct() {
       
        $this->middleware('admin')->only(['adminMeterView', 'uploadFile', 'editMeter', 'setMeterEdit']);
    }
    
    
    public function adminMeterView() {
        return view('/admin/meter_management/meters', ['meters' => Meter::orderBy('created_at', 'desc')->get()]);
    }
    
    public function upload() {
      return view('uploadfile');
   }
    
    public function uploadFile(Request $request) {
       
     $rules = array(
            'meter' => 'required|mimetypes:application/pdf',
    
        );        
      $this->validate($request, $rules); 
      
      $file = $request->file('meter');
      $time = Carbon::today()->toDateString();
     
      
      
      $meter = Meter::where('id', $request->meterid)->first();
      
      $meter_id = $meter->apartment->number.'_'.$time.'_'.$meter->meterType->name.'.pdf';
      $meter->verified_till = $time;
      $meter->save();
      
      $file->storeAs('/public/uploads/verifications', $meter_id);
     
     return view('/admin/meter_management/meters', ['meters' => Meter::orderBy('created_at')->get()]); 
     return redirect()->action('MeterController@adminMeterView');
      
   }
   
   public function editMeter($id)
    {
        
        return view('/admin/meter_management/meter_edit', ['meter' => Meter::where('id', $id)->first()]);
    }
    
    public function setMeterEdit(Request $request)
    {
        $rules = array(
            'amount' => 'required|numeric',
            'date' => 'required',
            );        
         $this->validate($request, $rules);
         
         
         $meter =  Meter::where('id', $request->meterid)->first();
         
         $meter->amount = $request->amount;
         $meter->verified_till = $request->date;
         $meter->updated_at = Carbon::now();

         
         $meter->save();
         
         $apart_id = $meter->apartment_id;
         $meter_type = $meter->meter_type_id;
         Meter::where('apartment_id', $apart_id)->where('meter_type_id', $meter_type)->update(['verified_till' => $request->date]);

         
         return redirect()->action('MeterController@adminMeterView');
    }
    
    
    
}
