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
        $data = Students::groupBy('id_course')->select(DB::raw('id_course, count(*) as total_count'))->where('status','=',true)->whereMonth('created_at', Carbon::today()->month)->get();
        $labels_course = array();
        $values_course = array();

        foreach($data as $id_course){
            $program = Programs::where('id','=',$id_course->id_course)->first();
            $values_course[] = $id_course->total_count;
            $labels_course[] = $program->name;
        }
        $programs = Programs::all();
        foreach($programs as $program){
            if(!in_array($program->name, $labels_course)){
                $labels_course[] =  $program->name;
                $values_course[] = 0;
            }
        }

        $genders = Students::groupBy('gender')->select(DB::raw('gender, count(*) as total_gender'))->get();
        $labels_gender = array('Male', 'Female');
        $values_gender = array(0, 0);
        foreach($genders as $gender){
            if($gender->gender==='Male'){
                $values_gender[0] = $gender->total_gender;
            }elseif($gender->gender === 'Female'){
                $values_gender[1] = $gender->total_gender;
            }
        }

        $age_datas = Students::select(DB::raw("birthdate"))->get();
        $labels_age = array();
        foreach($age_datas as $age_data){
            $labels_age[] = $this->get_age($age_data->birthdate);
        }
        $values_age_array = array_count_values($labels_age);
        $values_age = array();
        foreach($values_age_array as $value_age_array){
            $values_age[] = $value_age_array;
        }
        $labels_age_key = array_keys($values_age_array);

        $monthly_reports = Students::groupBy('gender','created_month')->select(DB::raw("gender, count(*) AS total_student, extract(month from created_at) as created_month"))->get();
        $monthly_month = array();
        $monthly_male = array();
        $monthly_female = array();
        foreach($monthly_reports as $monthly_report){
            if(!in_array($monthly_report->created_month,$monthly_month)){
                $monthly_month[] = (int)$monthly_report->created_month;
            }
            if($monthly_report->gender==='Male'){
                $monthly_male[$monthly_report->created_month] = $monthly_report->total_student;
            }elseif($monthly_report->gender==='Female'){
                $monthly_female[$monthly_report->created_month] = $monthly_report->total_student;
            }
        }
        return view('pages.admin', [
            'total_student'=>$total_student,
            'totalNewStudent'=>$totalNewStudent,
            'total_pending'=>$total_pending,
            'values_course'=>$values_course,
            'labels_course'=>$labels_course,
            'labels_gender'=>$labels_gender,
            'values_gender'=>$values_gender,
            'values_age'=>$values_age,
            'labels_age'=>$labels_age_key,
            'monthly_month'=>$monthly_month,
            'monthly_male'=>$monthly_male,
            'monthly_female'=>$monthly_female
        ]);
    }

    public function get_age($birthdate){
        $date=date_create($birthdate);
        $birthdate = date_format($date,"m/d/Y");
        $birthDate = explode("/", $birthdate);
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));
        return $age;
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
