<?php

namespace App\Http\Controllers;

use App\Models\User_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUser extends Controller
{
    public function index(){
        return view("login");
    }
    public function loginAction(Request $request){
        $data = $request->validate([
            "username"=> ["required"],
            "password"=> ["required"]
        ]);
        $user = User_info::where("username", $data["username"])->where("password", md5($data['password']))->first();
        if($user){
          if($user->usertype==='staff'){
            $request->session()->put('usertype', $user->usertype);
            $request->session()->put('userid', $user->id);
            return redirect()->route('staff')->with('success','welcome staff');
          }else if($user->usertype=== 'admin'){
            $request->session()->put('usertype', $user->usertype);
            $request->session()->put('userid', $user->id);
            return redirect()->route('admin')->with('success','welcome admin');
          }else if($user->usertype=== 'cms'){

          }
        }else{
            return back()->with('invalid','Invalid Credentials!');
        }

    }
}
