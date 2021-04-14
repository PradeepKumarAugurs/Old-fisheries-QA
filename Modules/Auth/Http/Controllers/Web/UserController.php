<?php

namespace Modules\Auth\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Auth\Entities\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {   
        $data['getUserList']=User::where('role','!=','1')->get(); 
        return view('auth::users')->with($data);
    }

    /*  Edit  Profile */
    public  function edit_profile(Request $request){
        if($request->row_id){
            $data['user_data']=User::find($request->row_id); 
            return view('auth::editprofile')->with($data);
        }
    }

    /**
     * UPdate Password 
    */
    public  function  updatePassword(Request $request){
       
        $validatedData = $request->validate([
            'old_password' => 'required|min:8',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:new_password'
        ]);
        if($request->old_password!=$request->new_password){
            $getUser=User::find(auth()->user()->id);
            if(Hash::check($request->old_password, $getUser->password)){
                $updateUser=User::where('id',auth()->user()->id)->update(array('password'=>Hash::make($request->new_password)));
                return  redirect()->back()->with('msgp','<div class="alert  alert-success"> Password has been updated.</div>'); 
            }
            else{
                return  redirect()->back()->with('msgp','<div class="alert  alert-danger"> old password are invalid.</div>'); 
            }
        }
        else{
            return  redirect()->back()->with('msgp','<div class="alert  alert-danger"> old password and new password can`t be same.</div>'); 
        } 
        
    }

    /**
     * Update Password
    */
    public function updateProfile(Request $request){
       $update=array(
           'name' =>  $request->name,
           'email' =>  $request->email,
           'username' =>  $request->username,
           'mobile_no' =>  $request->mobile_no
       ); 
      
       $updateUserProfile=User::where('id',auth()->user()->id)->update($update);
       return  redirect()->back()->with('msg','<div class="alert  alert-success"> Profile has been updated.</div>'); 
    }
    
    
}
