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
        if(auth()->attempt($data)){
            $request->session()->regenerate();
            if(auth()->user()->usertype == "staff"){
                return redirect()->route('staff')->with('success','welcome staff');
            }else if(auth()->user()->usertype == 'admin'){
                return redirect()->route('admin')->with('success','welcome admin');
            }
        }else{
            return back()->with('invalid','Invalid Credentials!');
        }
    }
    public function admin(){
        return view('pages.admin')->with('success','Welcome Admin');
    }
    public function staff(){
        return view('pages.staff')->with('success','Welcome Staff');
    }

    public function signoutAction(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return view('login')->with('success','Logout Success');
    }

}
