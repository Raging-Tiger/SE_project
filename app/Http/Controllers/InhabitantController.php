<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\ApartmentInhabitant;
use App\Models\Inhabitant;
use Illuminate\Http\Request;

class InhabitantController extends Controller
{
   public function __construct() {
       
        $this->middleware('admin')->only(['addInhView', 'addInh', 'adminInhabitantView', 'connectWithInh', 'destroyInhApp', 'addInhApp']);
    }
    
    public function addInhView()
    {
        return view('/admin/inhabitant_management/inhabitant_add');
    }
    
    public function addInh(Request $request)
    {
        $rules = array(
            'name' => 'required|alpha|max:255',
            'surname' => 'required|alpha|max:255',
            'pers' => 'required|regex:/[0-9]{6}[-]{1}[0-9]{5}/|unique:inhabitants,personal_code',
        );        
        $this->validate($request, $rules); 
        
       $inhabitant = new Inhabitant(); 
       $inhabitant->name = $request->name;
       $inhabitant->surname = $request->surname;
       $inhabitant->personal_code = $request->pers;
      // $inhabitant->user_id = 'NULL';
        $inhabitant->save();
       
      return view('/admin/inhabitant_management/inhabitant', ['inhs' => Inhabitant::orderBy('user_id')->get(), 'app_inh' => ApartmentInhabitant::all()]);
       // return view('/admin/inhabitant_add');
    }
    
     public function adminInhabitantView() {
        return view('/admin/inhabitant_management/inhabitant', ['inhs' => Inhabitant::orderBy('user_id')->get(), 'app_inh' => ApartmentInhabitant::all()]);
    } 
    
    public function connectWithInh ($id)
            
    {
         $inh = ApartmentInhabitant::where('inhabitant_id', $id)->get();
         $inh_app = $inh->pluck('apartment_id','apartment_id');
         $app = Apartment::all();
         $app = $app->pluck('number', 'id');
         foreach($inh_app as $key => $value)
         {
             unset($app[$key]); 
         }
         return view('/admin/inhabitant_management/app_inh', ['inhid' => $id, 'apps' => $app,  'inh' => Inhabitant::where('id', $id)->first()]);
    }
    
    
    public function destroyInhApp ($id, Request $request)
    {
       ApartmentInhabitant::where('id',$request->iaid)->delete();
       

       return redirect('admin/inhabitants/'.$id);
    }
    
    
    public function addInhApp ($id, Request $request)
    {
      $rules = array(
            'appno' => 'required',
       );        
      $this->validate($request, $rules); 
      
      
      $ai = new ApartmentInhabitant();
      $ai->apartment_id= $request->appno;
      $ai->inhabitant_id= $request->inhid;
 
      $ai->save();   
      
     return redirect('admin/inhabitants/'.$id);
    }
}
