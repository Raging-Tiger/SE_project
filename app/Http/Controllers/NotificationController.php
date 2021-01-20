<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Models\NotificationType;
use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function __construct() {
       
        $this->middleware('privadmin')->only(['see', 'edit', 'delete', 'save', 'addNewView', 'addNew']);
    }
    
    
     public function index(Request $request)
    {
        $lang = $request->cookie('language');
        if (isset($lang))
        {
            if ($lang == 'en')
            {
                $lang = 1;
            }
            else {
                $lang = 2;
            }
            $n = Notification::where('language_id', $lang)->orderBy('id', 'desc')->paginate(5);
            $p = Notification::where('language_id', $lang)->where('notification_type_id',1)->orderBy('id', 'desc')->paginate(5);
            return view('general/index', ['notifications' => $n, 'publics' => $p, 'lang' => $lang]);
        }
        else {
        $n = Notification::where('language_id', 1)->orderBy('id', 'desc')->paginate(5);
        $p = Notification::where('language_id', 1)->where('notification_type_id',1)->orderBy('id', 'desc')->paginate(5);
        return view('general/index', ['notifications' => $n, 'publics' => $p, 'lang' => $lang]);
        }
    }
    
    public function see()
    {

        $role = User::where('id', auth()->user()->id) -> first();
       
        if($role->role_id == 1)
        {
         $n = Notification::orderBy('id', 'desc')->paginate(5);
          return view('notification/notification_list', ['notifications' => $n]);
        }
        elseif($role->role_id == 4)
        {  
          $n = Notification::where('user_id', auth()->user()->id)->orderBy('id', 'desc')->paginate(5);
          return view('notification/notification_list', ['notifications' => $n]);
        }
        
    }
    
    public function edit(Request $request, $id)
    {
        $type = NotificationType::all();
        $type = $type->pluck('name', 'id');
        $notification = Notification::where('id', $id)->first();
        $user = auth()->user();
        //$user = $notification->user();
        if(!isset($notification))
        {   
            return view('general/error');
        }
        if($user->role_id!=1 && $user->id != $notification->user_id)
        {
            return view('general/error');
        }

        return view('notification/notification_edit', ['notification' => $notification,
                                          'status' => $type]);
    }
    
    public function delete(Request $request)
    {
        Notification::where('id', $request->notid)->delete();

        return redirect()->action('NotificationController@index');
    }
    
    public function save(Request $request)
    {
        $rules = array(
            'header' => 'required',
            'message' => 'required',
            'status' => 'required',
            
    
        );        
        $this->validate($request, $rules); 
        
        $notification =  Notification::where('id', $request->notid)->first();
        $notification->header = $request->header;
        $notification->message = $request->message;
        $notification->notification_type_id = $request->status;
       
        $notification->save();
 
        return redirect()->action('NotificationController@index');
    }
    
    public function addNewView()
    {
        $type = NotificationType::all();
        $type = $type->pluck('name', 'id');
        return view('notification/notification_new', ['status' => $type]);
        
    }
    
    
    public function addNew(Request $request)
    {
            $rules = array(
            'header' => 'required',
            'message' => 'required',
            'status' => 'required',
            'lang' => 'required',
    
        );    
        $this->validate($request, $rules);
        
        $notification =  new Notification();
        $notification->header = $request->header;
        $notification->message = $request->message;
        $notification->notification_type_id = $request->status;
         $notification->language_id = $request->lang;
        $notification->user_id = auth()->user()->id;
        $notification->save();
        
        
         return redirect()->action('NotificationController@index');
        
    }
}
