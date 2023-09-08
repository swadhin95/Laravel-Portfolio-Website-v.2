<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactModel;
use App\Models\ProjectsModel;
use App\Models\CourseModel;
use App\Models\ReviewModel;
use App\Models\ServicesModel;
use App\Models\VisitorModel;



class HomeController extends Controller
{
    function HomeIndex(){

    	$TotalContact=ContactModel::count();
    	$TotalProject=ProjectsModel::count();
    	$TotalCourse=CourseModel::count();
    	$TotalReview=ReviewModel::count();
    	$TotalService=ServicesModel::count();
    	$TotalVisitor=VisitorModel::count();


        return view('Home',[
        	'TotalContact'=>$TotalContact,
        	'TotalProject'=>$TotalProject,
        	'TotalCourse'=>$TotalCourse,
        	'TotalReview'=>$TotalReview,
        	'TotalService'=>$TotalService,
        	'TotalVisitor'=>$TotalVisitor

        ]);
    }
}
