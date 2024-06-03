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
        // $total_numbers = Students::all();
        $total_numbers = DB::table('students')
        ->select('course', DB::raw('count(*) as total'))
        ->groupBy('course')
        ->get();
        $total_count = array();
        $courses = ["Visual Graphic Design NCIII", "Animation NC II", "Contact Center Services NC II", "2D Animation NC III"];

        foreach($courses as $course){
            foreach($total_numbers as $total_number){
                if($course==$total_number->course){
                    $total_count[$course] = $total_number->total;
                    break;
                }else{
                    $total_count[$course] = 0;
                }
            }
        }

        // dd($total_count);
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
