<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\VisitorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;




Route::get('/', [HomeController::class, 'HomeIndex']);



//Admin Panel Service Management
Route::get('/visitor', [VisitorController::class, 'VisitorIndex']);


//Admin Panel Service Management
Route::get('/service', [ServiceController::class, 'ServiceIndex']);
Route::get('/getServicesData', [ServiceController::class, 'getServicesData']);
Route::post('/ServiceDelete', [ServiceController::class, 'ServiceDelete']);
Route::post('/ServiceEdit', [ServiceController::class, 'ServiceEdit']);
Route::post('/ServiceDetails', [ServiceController::class, 'getServiceDetails']);
Route::post('/ServiceUpdate', [ServiceController::class, 'ServiceUpdate']);
Route::post('/ServiceAdd', [ServiceController::class, 'ServiceAdd']);


//Admin Panel Courses Management
Route::get('/Courses', [CoursesController::class, 'CoursesIndex']);
Route::get('/getCoursesData', [CoursesController::class, 'getCoursesData']);
Route::post('/CoursesDelete', [CoursesController::class, 'CoursesDelete']);
Route::post('/CoursesEdit', [CoursesController::class, 'CoursesEdit']);
Route::post('/CoursesDetails', [CoursesController::class, 'getCoursesDetails']);
Route::post('/CoursesUpdate', [CoursesController::class, 'CoursesUpdate']);
Route::post('/CoursesAdd', [CoursesController::class, 'CoursesAdd']);


//Admin Panel Project Management
Route::get('/Project', [ProjectController::class, 'ProjectIndex']);
Route::get('/getProjectsData', [ProjectController::class, 'getProjectsData']);
Route::post('/ProjectDelete', [ProjectController::class, 'ProjectDelete']);
Route::post('/ProjectEdit', [ProjectController::class, 'ProjectEdit']);
Route::post('/ProjectDetails', [ProjectController::class, 'getProjectDetails']);
Route::post('/ProjectUpdate', [ProjectController::class, 'ProjectsUpdate']);
Route::post('/ProjectAdd', [ProjectController::class, 'ProjectAdd']);


//Admin Panel Contact Management
Route::get('/Contact', [ContactController::class, 'ContactIndex']);
Route::get('/getContactData', [ContactController::class, 'getContactData']);
Route::post('/ContactDelete', [ContactController::class, 'ContactDelete']);


//Admin Panel Review Management
Route::get('/Review', [ReviewController::class, 'ReviewIndex']);
Route::get('/getReviewData', [ReviewController::class, 'getReviewData']);
Route::post('/ReviewDelete', [ReviewController::class, 'ReviewDelete']);
Route::post('/ReviewEdit', [ReviewController::class, 'ReviewEdit']);
Route::post('/ReviewDetails', [ReviewController::class, 'getReviewDetails']);
Route::post('/ReviewUpdate', [ReviewController::class, 'ReviewUpdate']);
Route::post('/ReviewAdd', [ReviewController::class, 'ReviewAdd']);