<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class StudentsController extends Controller
{
    public function registerStudent(Request $request){
        $student = $request->validate([
            'fname'=>'required',
            'lname'=> 'required',
            'mname'=> 'required',
            'sname'=> 'required',
            "course"=> 'required',
            'student_numberStreet'=> 'required',
            'student_contactNumber'=> 'required',
            'student_email'=>'required|email|unique:email',
            'muni'=> 'required',
            'dist'=> 'required',
            'zip'=> 'required|numeric',
            'gender'=> 'required'
        ]);
        dd($request);
    }
}
