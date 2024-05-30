<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthUser;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

Route::controller(AdminController::class)->group(function () {
    Route::get("/settings", "settings")->name("settings");
    Route::put("/settings/{id}","update")->name("update");
});

Route::controller(AuthUser::class)->group(function(){
    Route::get('/', 'index')->name('login');
    Route::post('/loginAction','loginAction')->name('loginAction');
    Route::get('/staff','staff')->name('staff')->middleware('auth');
    Route::get('/admin','admin')->name('admin')->middleware('auth');
    Route::post('/signoutAction', 'signoutAction')->name('signoutAction');
});

// Route::controller(Students::class)->group(function(){

// });

Route::get("/register",function () {
    return view("students.register");
});

Route::controller(StudentsController::class)->group(function () {
    Route::post("/registerStudent","registerStudent")->name("register_student");
});
