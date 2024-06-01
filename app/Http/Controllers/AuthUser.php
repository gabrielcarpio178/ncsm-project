<?php

namespace App\Http\Controllers;

use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        // echo bcrypt($data["password"]);
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
        $total_numbers = Students::all();

        $vgd = 0;
        $ccs = 0;
        $ani = 0;
        $ani2d = 0;
        foreach($total_numbers as $total_number){
            if($total_number->course==="Visual Graphic Design NCIII"){
                $vgd =+ 1;
            }elseif($total_number->course==="Contact Center Services NC II"){
                $ccs =+ 1;
            }elseif($total_number->course=== "Animation NC II"){
                $ani =+ 1;
            }elseif($total_number->course=== "2D Animation NC III"){
                $ani2d =+1;
            }
        }
        $total_count = ['vgd'=>$vgd, 'ccs'=>$ccs,'ani'=>$ani,'ani2d'=>$ani2d];

        return view('pages.admin', ['total_count'=>$total_count])->with('success','Welcome Admin');
    }
    public function staff(){
        return view('pages.staff')->with('success','Welcome Staff');
    }

    public function signoutAction(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('logout','Logout Success');
    }

}
