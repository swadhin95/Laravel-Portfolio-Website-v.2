<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PhotoController;




Route::get('/', [HomeController::class, 'HomeIndex'])->middleware('loginCheck');




//Admin Panel Service Management
Route::get('/visitor', [VisitorController::class, 'VisitorIndex'])->middleware('loginCheck');


//Admin Panel Service Management
Route::get('/service', [ServiceController::class, 'ServiceIndex'])->middleware('loginCheck');
Route::get('/getServicesData', [ServiceController::class, 'getServicesData'])->middleware('loginCheck');
Route::post('/ServiceDelete', [ServiceController::class, 'ServiceDelete'])->middleware('loginCheck');
Route::post('/ServiceEdit', [ServiceController::class, 'ServiceEdit'])->middleware('loginCheck');
Route::post('/ServiceDetails', [ServiceController::class, 'getServiceDetails'])->middleware('loginCheck');
Route::post('/ServiceUpdate', [ServiceController::class, 'ServiceUpdate'])->middleware('loginCheck');
Route::post('/ServiceAdd', [ServiceController::class, 'ServiceAdd'])->middleware('loginCheck');


//Admin Panel Courses Management
Route::get('/Courses', [CoursesController::class, 'CoursesIndex'])->middleware('loginCheck');
Route::get('/getCoursesData', [CoursesController::class, 'getCoursesData'])->middleware('loginCheck');
Route::post('/CoursesDelete', [CoursesController::class, 'CoursesDelete'])->middleware('loginCheck');
Route::post('/CoursesEdit', [CoursesController::class, 'CoursesEdit'])->middleware('loginCheck');
Route::post('/CoursesDetails', [CoursesController::class, 'getCoursesDetails'])->middleware('loginCheck');
Route::post('/CoursesUpdate', [CoursesController::class, 'CoursesUpdate'])->middleware('loginCheck');
Route::post('/CoursesAdd', [CoursesController::class, 'CoursesAdd'])->middleware('loginCheck');


//Admin Panel Project Management
Route::get('/Project', [ProjectController::class, 'ProjectIndex'])->middleware('loginCheck');
Route::get('/getProjectsData', [ProjectController::class, 'getProjectsData'])->middleware('loginCheck');
Route::post('/ProjectDelete', [ProjectController::class, 'ProjectDelete'])->middleware('loginCheck');
Route::post('/ProjectEdit', [ProjectController::class, 'ProjectEdit'])->middleware('loginCheck');
Route::post('/ProjectDetails', [ProjectController::class, 'getProjectDetails'])->middleware('loginCheck');
Route::post('/ProjectUpdate', [ProjectController::class, 'ProjectsUpdate'])->middleware('loginCheck');
Route::post('/ProjectAdd', [ProjectController::class, 'ProjectAdd'])->middleware('loginCheck');


//Admin Panel Contact Management
Route::get('/Contact', [ContactController::class, 'ContactIndex'])->middleware('loginCheck');
Route::get('/getContactData', [ContactController::class, 'getContactData'])->middleware('loginCheck');
Route::post('/ContactDelete', [ContactController::class, 'ContactDelete'])->middleware('loginCheck');


//Admin Panel Review Management
Route::get('/Review', [ReviewController::class, 'ReviewIndex'])->middleware('loginCheck');
Route::get('/getReviewData', [ReviewController::class, 'getReviewData'])->middleware('loginCheck');
Route::post('/ReviewDelete', [ReviewController::class, 'ReviewDelete'])->middleware('loginCheck');
Route::post('/ReviewEdit', [ReviewController::class, 'ReviewEdit'])->middleware('loginCheck');
Route::post('/ReviewDetails', [ReviewController::class, 'getReviewDetails'])->middleware('loginCheck');
Route::post('/ReviewUpdate', [ReviewController::class, 'ReviewUpdate'])->middleware('loginCheck');
Route::post('/ReviewAdd', [ReviewController::class, 'ReviewAdd'])->middleware('loginCheck');



//Admin Panel Login Management
Route::get('/Login', [LoginController::class, 'LoginIndex']);
Route::post('/onLogin', [LoginController::class, 'onLogin']);
Route::get('/Logout', [LoginController::class, 'onLogout']);


//Admin Panel Photo Gallery Management
Route::get('/Photo', [PhotoController::class, 'PhotoIndex'])->middleware('loginCheck');
Route::post('/PhotoUoload', [PhotoController::class, 'PhotoUoload'])->middleware('loginCheck');
Route::get('/PhotoJSON', [PhotoController::class, 'PhotoJSON'])->middleware('loginCheck');
Route::get('/PhotoJSONByID/{id}', [PhotoController::class, 'PhotoJSONByID'])->middleware('loginCheck');
