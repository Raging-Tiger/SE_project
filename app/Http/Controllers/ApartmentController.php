<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\ApartmentInhabitant;
use App\Models\Inhabitant;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    
    public function __construct() {
       
        $this->middleware('admin')->only(['adminApartmentView', 'editApartmentView', 'saveApartmentView']);
        $this->middleware('tenant')->only(['index', 'email']);
        
      }  
      
    /*Tenant*/
    public function index()
    {
        $mail = auth()->user()->email_notifications;
        if($mail == 1)
        {
            $mail=TRUE;  
        }
        else{
            $mail=FALSE;
        }
        $inh = Inhabitant::where('user_id', auth()->user()->id)->first();
        
        if(!isset($inh))
        {
            return view('general/error');
        }
        $userid = ApartmentInhabitant::where('inhabitant_id', $inh->id)->get();
                
        
        return view('tenant/appartment_data', ['ai' => $userid, 'email' => $mail]);
    }
    
    public function email (Request $request)
    {
        if($request->mail==TRUE)
        {
            $mail = auth()->user();
            $mail ->email_notifications = 1;
            $mail ->save();
            
        }
        
        else {
            $mail = auth()->user();
            $mail ->email_notifications = 0;
            $mail ->save();
        }
        
        return redirect()->action('ApartmentController@index');
    }
    
    
    /*Admin*/
    
    public function adminApartmentView() {
        return view('/admin/apartment_management/apartment', ['apartments' => Apartment::orderBy('number')->get()]);
    }
    
    public function  editApartmentView($id) {
       
        return view('/admin/apartment_management/apartment_edit', ['apartment' => Apartment::where('id', $id)->first()]);
    }
    
    public function  saveApartmentView(Request $request){
        $rules = array(
            'area' => 'required|numeric',
            'floor' => 'required|numeric',
            'number' => 'required|numeric',
         
        );     
        
       $this->validate($request, $rules); 
        
        $apartment = Apartment::where('id', $request->id)->first();
        $apartment->area_m2 = $request->area;
        $apartment->floor = $request->floor;
        $apartment->number = $request->number;
        $apartment->save();
        
 
        
        return view('/admin/apartment_management/apartment', ['apartments' => Apartment::orderBy('number')->get()]);

        #return view('/admin/user_management/users', array('users' => User::orderBy('role_id')->get()));
    }
}
