<?php

namespace App\Http\Controllers;

use App\Models\User_info;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function settings(){
        $id = auth()->user()->id;
        $adminData = User_info::find($id);
        return view("pages.adminSetting", ["dataAdmin"=> $adminData]);
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
        $adminData->password = bcrypt($data['password']);
        $adminData->save();
        return redirect()->back()->with('success','Update success');
    }
}
