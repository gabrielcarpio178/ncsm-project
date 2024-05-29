<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthUser;
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
    Route::get('/signoutAction', 'signoutAction')->name('signoutAction');
});
