<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Models\User_info;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;
use App\Mail\Sendemail;
use Illuminate\Support\Facades\Mail;


class AdminController extends Controller
{
    public function settings(){
        $id = auth()->user()->id;
        $adminData = User_info::find($id);
        return view("pages.adminSetting", ["dataAdmin"=> $adminData]);
    }

    public function register_student(){
        $students = Students::where('status','=','TRUE')->orderBy('id', 'desc')->paginate(10);
        return view("pages.adminRegisterStudent", ['students'=>$students]);
    }

    public function gotoApplicant(){
        $students = Students::where('status','=','FALSE')->orderBy('id', 'desc')->paginate(10);
        return view('pages.adminapplicant', ['students'=>$students]);
    }



    public function search_applicant(Request $request){
        $request->validate([
            'search'=> ['required'],
        ]);
        $students = Students::where("status","=","FALSE")->where('fname','LIKE','%'.strtolower($request->search).'%')->orWhere('lname','LIKE','%'.strtolower($request->search).'%')->orWhere('mname','LIKE','%'.strtolower($request->search).'%')->paginate(10);
        return view("pages.adminapplicant", ['students'=>$students]);
    }

    public function filter_applicant($course){
        dd($course);
    }
    public function search_register(Request $request){
        $request->validate([
            'search'=> ['required'],
        ]);
        $students = Students::where("status","=","TRUE")->where('fname','LIKE','%'.strtolower($request->search).'%')->orWhere('lname','LIKE','%'.strtolower($request->search).'%')->orWhere('mname','LIKE','%'.strtolower($request->search).'%')->paginate(10);
        return view("pages.adminapplicant", ['students'=>$students]);
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            "fname"=> ['required'],
            "lname"=> ['required'],
            "email"=> ['required', 'email', Rule::unique('users')->ignore($id)],
            "username"=> ["required"],
            "password"=> 'required|confirmed',
        ]);
        $adminData = User_info::find($id);
        $adminData->fname = $data['fname'];
        $adminData->lname = $data['lname'];
        $adminData->email = $data['email'];
        $adminData->username = $data['username'];
        $adminData->decrypt = $data['password'];
        $adminData->password = bcrypt($data['password']);

        $adminData->save();
        return redirect()->back()->with('success','Update success');
    }

    public function student_profile($id){
        $student = Students::find($id);
        $student['birthdate'] = date("M-d-Y", strtotime($student['birthdate']));
        return view('pages.adminuser_profile', ['student'=>$student]);
    }
    public function deleteApplicant(Request $request){
        $data = array(
            'message'=> '
            Thank you for your interest in the Negros Occidental Language and Information Technology Center (NOLITC). We appreciate the time you took to complete the registration form.'."
            \n".
            'After careful consideration, we regret to inform you that we are unable to offer you a place in the course at this time. The selection process was highly competitive, and we received many strong registrations.'."
            \n".
            'We encourage you to apply again in the future and wish you the best in your educational and professional endeavors. If you have any questions, please feel free to contact us at:'."
            \n",
            'telephone' => "(034) 435 6092",
            'email'=> "nolitc@gmail.com"
        );
        $student = Students::find($request->student_id);
        Mail::to($student->email)->send(new Sendemail($data));
        $student->delete();
        return redirect()->route('applicant_admin');
    }

    public function acceptApplicant(Request $request){
        $data = array(
            'message'=> '
            We are pleased to inform you that you have been accepted at Negros Occidental Language and Information Technology Center (NOLITC). We are excited to welcome you to our community.'."
            \n".
            'We look forward to your participation in the course and are confident that you will find it both challenging and rewarding.'."
            \n".
            'If you have any questions or need further information, do not hesitate to contact us at:'."
            \n",
            'telephone' => "(034) 435 6092",
            'email'=> "nolitc@gmail.com"
        );
        $user_id = $request->student_id;
        $student = Students::find($user_id);
        Mail::to($student->email)->send(new Sendemail($data));
        $student['status'] = true;
        $student->save();
        return redirect()->route('applicant_admin');
    }


    public function downloadPdf($id){
        $student = Students::find($id);
        $student['birthdate'] = date("M-d-Y", strtotime($student['birthdate']));
        $data = [
            'title' => 'student profile',
            'student' =>  $student
        ];

        $pdf = Pdf::loadView('pdf.downloadPdf', ['data'=>$data])->setPaper('a4', 'portrait');
        return $pdf->download($student->fname." ".$student->lname.".pdf");
    }

}

