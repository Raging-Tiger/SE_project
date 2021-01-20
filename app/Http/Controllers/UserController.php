<?php

namespace App\Http\Controllers;

use App\Models\ApartmentInhabitant;
use App\Models\Inhabitant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function __construct() {
       
        $this->middleware('admin')->only(['adminUsersView', 'adminUsersRoleShow', 'assignInh', 'setRole', 'setUser']);
      }  
      
      
    public function adminUsersView()
    {
        return view('/admin/user_management/users', array('users' => User::orderBy('role_id')->get()));
    }
    
    public function adminUsersRoleShow($id, Request $request)
    {
        $user = User::where('id', $id)->first();
        $roles = Role::all();
        $roles = $roles->pluck('name', 'id');
        return view('/admin/user_management/user_change', ['user' => $user,'role' => $roles]);
    }
    
    public function assignInh(Request $request)
    {
            $user = User::where('id', $request->userid)->first();
            return view('/admin/user_management/inhabitant_assign', ['user' => $user, 'inhs' => Inhabitant::where('user_id', NULL)->get()]);
    }
    
    
    public function setRole(Request $request)
    {
        $rules = array(
            'status' => 'required',
        );        
        $this->validate($request, $rules); 
        
        $user = User::where('id', $request->userid)->first();
        $user->role_id = $request->status;
        $user->save();
        
         return view('/admin/user_management/users', array('users' => User::orderBy('role_id')->get()));
    }
    
    
    public function setUser(Request $request)
    {
        
        $inh = Inhabitant::where('id', $request->inhid)->first();
        $inh->user_id = $request->userid;
        $inh->save();
        return view('/admin/inhabitant_management/inhabitant', ['inhs' => Inhabitant::orderBy('user_id')->get(), 'app_inh' => ApartmentInhabitant::all()]);
    }
}
