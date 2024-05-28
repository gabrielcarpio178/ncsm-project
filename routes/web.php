<?php

use App\Http\Controllers\AuthUser;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthUser::class, 'index']);

Route::post('/loginAction', [AuthUser::class,'loginAction'])->name('loginAction');
Route::get('/staff', function(){
    return view('pages.staff');
})->name('staff');
Route::get('/admin', function(){
    return view('pages.admin');
})->name('admin');
