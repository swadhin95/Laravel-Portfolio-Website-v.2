<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\TermsController;


Route::get('/', [HomeController::class, 'HomeIndex']);
Route::post('/contactsend', [HomeController::class, 'ContactSend']);

Route::get('/Projects', [ProjectController::class, 'ProjectIndex']);
Route::get('/Courses', [CourseController::class, 'CourseIndex']);

Route::get('/Policy', [PolicyController::class, 'PolicyIndex']);
Route::get('/Terms', [TermsController::class, 'TermsIndex']);
