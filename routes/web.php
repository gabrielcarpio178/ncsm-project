<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthUser;
use App\Http\Controllers\NolitcController;
use App\Http\Controllers\PhpmailerController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Drivers\Gd\Modifiers\RotateModifier;

Route::middleware(['auth'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get("/settings", "settings")->name("settings");
        Route::put("/settings/{id}","update")->name("update");
        Route::post('/search/applicant','search_applicant')->name('search.applicant');
        Route::post('/search/register','search_register')->name('search.registers');
        Route::get('/student_profile/{id}','student_profile')->name('student_profile');
        Route::get('/filter/applicant/{course}','filter_applicant')->name('filter_applicant');
        Route::post('/delete-aplicant','deleteApplicant')->name('delete.applicant');
        Route::put('/accept-aplicant','acceptApplicant')->name('accept.applicant');
        Route::get('/printpdf/{id}','downloadPdf')->name('print.pdf');
        Route::get('/upload-welcome/','upload_welcome')->name('upload-welcome');
        Route::put('/upload-cover/','upload_cover')->name('upload_cover');
        Route::get('/program-management','program_management')->name('program_management');
        Route::get('/program-management/form','program_management_form')->name('programs');
        Route::get('/program-management/addform','programs_addform')->name('programs_addform');
        Route::post('/program-addQualification','addTesdaQualification')->name('addTesdaQualification');
        Route::get('/program/program/content/{id}','program_qualification')->name('see_more_program');
        Route::get('/program/program/upadate.content/{id}','update_program')->name('updateContent');
        Route::post('/program/program/upadate.content/{id}','updateContent_program')->name('updateContent_program');
        Route::delete('/program/delete','delete_program')->name('delete.programs');
        Route::get('/scorecards','showScoreCard')->name('showScoreCard');
        Route::post('/export','export')->name('export');
        Route::get('/export', 'export_excel')->name('export_excel');
        Route::get('/register-student', 'register_student')->name('register_admin');
        Route::post('/register-student', 'filter')->name('filter');
        Route::get('/students/{id}', 'filter_show')->name('students.show');
        Route::put('/updateScoreCards/{id}', 'updateScoreCards')->name('updateScoreCards');
        Route::get('/managePartners', 'managePartners')->name('managePartners');
        Route::post('/add_partners', 'add_partners')->name('add_partners');
        Route::delete('/delete_partners', 'delete_partners')->name('delete_partners');
    });
});

Route::controller(AuthUser::class)->group(function(){
    Route::get('/login-user', 'index')->name('login');
    Route::post('/loginAction','loginAction')->name('loginAction');
    Route::get('/staff','staff')->name('staff')->middleware('auth');
    Route::get('/admin','admin')->name('admin')->middleware('auth');
    Route::get('/officer','officer')->name('officer')->middleware('auth');
    Route::post('/signoutAction', 'signoutAction')->name('signoutAction');
});

// Route::get("/register",function () {
//     return view("students.register");
// });

Route::controller(StudentsController::class)->group(function () {
    Route::post("/registerStudent","registerStudent")->name("register_student");
    Route::post("/registerStudent_submit","submit_data")->name("register_student_submit");
});


Route::controller(NolitcController::class)->group(function () {
    Route::get("/","welcome")->name("welcome");
    Route::get("/tesda_qual","tesda_qual")->name("tesda_qual");
    Route::get("/see_more/{id}","see_more")->name("see-more");
    Route::get("/ccs","ccs")->name("ccs");
    Route::get("/know-more","know_more")->name("know_more");
    Route::get("/register", "register_student")->name("register.student");
    Route::get("/thank_you", "thank_page")->name("thank_page.student");
});




