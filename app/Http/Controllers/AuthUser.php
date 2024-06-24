<?php

namespace App\Http\Controllers;

use App\Models\Programs;
use App\Models\Students;
use App\Models\User_info;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
        $user = User_info::where("username", $data["username"])->first();
        if(auth()->attempt($data)||Hash::check($data["password"], $user->password)){
            $request->session()->regenerate();
            if(auth()->user()->usertype == "staff"){
                return redirect()->route('staff')->with('success','welcome staff');
            }else if(auth()->user()->usertype == 'admin'){
                return redirect()->route('admin')->with('success','welcome admin');
            }else if(auth()->user()->usertype == 'officer'){
                return redirect()->route('officer')->with('success','welcome officer');
            }
        }else{
            return back()->with('invalid','Invalid Credentials!');
        }
    }
    public function admin(){
        $total_student = Students::count();
        $totalNewStudent = Students::whereBetween('updated_at', [Carbon::now()->subDay(7),'NOW()'])->count();
        $total_pending = Students::where('status','=',false)->count();

        //graph data
        $data = Students::groupBy('id_course')->select(DB::raw('id_course, count(*) as total_count'))->whereMonth('created_at', Carbon::today()->month)->get();
        $labels = array();
        $values = array();

        foreach($data as $id_course){
            $program = Programs::where('id','=',$id_course->id_course)->first();
            $values[] = $id_course->total_count;
            $labels[] = $program->name;
        }
        $programs = Programs::all();
        foreach($programs as $program){
            if(!in_array($program->name, $labels)){
                $labels[] =  $program->name;
                $values[] = 0;
            }
        }
        return view('pages.admin', [
            'total_student'=>$total_student,
            'totalNewStudent'=>$totalNewStudent,
            'total_pending'=>$total_pending,
            'values'=>$values,
            'labels'=>$labels
        ]);
    }
    public function staff(){
        return view('pages.staff')->with('success','Welcome Staff');
    }
    public function officer(){
        return view('pages.officer')->with('success','Welcome Staff');
    }

    public function signoutAction(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login-user')->with('logout','Logout Success');
    }

}
