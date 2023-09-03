<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectsModel;

class ProjectController extends Controller
{
        function ProjectIndex(){

            $ProjectData= json_decode(ProjectsModel::orderBy('id','desc')->get());
            return view('Projects',[
                'ProjectData'=>$ProjectData
            ]);
        }
}
