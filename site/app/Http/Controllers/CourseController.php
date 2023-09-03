<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CourseModel;


class CourseController extends Controller
{
    function CourseIndex(){

        $CoursesData= json_decode(CourseModel::orderBy('id','desc')->get());
        return view('Courses',[
        'CoursesData'=>$CoursesData
        ]);
    }
}
