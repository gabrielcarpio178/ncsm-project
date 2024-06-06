<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthUser;
use App\Http\Controllers\PhpmailerController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

Route::controller(AdminController::class)->group(function () {
    Route::get("/settings", "settings")->name("settings");
    Route::put("/settings/{id}","update")->name("update");
    Route::get("/register-student", 'register_student')->name('register_admin');
    Route::post('/search/applicant','search_applicant')->name('search.applicant');
    Route::post('/search/register','search_register')->name('search.registers');
    Route::get('/student_profile/{id}','student_profile')->name('student_profile');
    Route::get('/applicant','gotoApplicant')->name('applicant_admin');
    Route::get('/filter/applicant/{course}','filter_applicant')->name('filter_applicant');
    Route::post('/delete-aplicant','deleteApplicant')->name('delete.applicant');
    Route::put('/accept-aplicant','acceptApplicant')->name('accept.applicant');
    Route::get('/printpdf/{id}','downloadPdf')->name('print.pdf');
    Route::get('/upload-welcome/','upload_welcome')->name('upload-welcome');
    Route::put('/upload-cover/','upload_cover')->name('upload_cover');
});

Route::controller(AuthUser::class)->group(function(){
    Route::get('/', 'index')->name('login');
    Route::post('/loginAction','loginAction')->name('loginAction');
    Route::get('/staff','staff')->name('staff')->middleware('auth');
    Route::get('/admin','admin')->name('admin')->middleware('auth');
    Route::get('/officer','officer')->name('officer')->middleware('auth');
    Route::post('/signoutAction', 'signoutAction')->name('signoutAction');
});

Route::get("/register",function () {
    return view("students.register");
});

Route::controller(StudentsController::class)->group(function () {
    Route::post("/registerStudent","registerStudent")->name("register_student");
});





