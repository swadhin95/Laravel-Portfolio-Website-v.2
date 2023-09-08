<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PhotoModel;


class PhotoController extends Controller
{
    function PhotoIndex(){
        return view('Photo');
    }
    

    function PhotoJSON(){
        return PhotoModel::take(4)->get();
    }

    function PhotoJSONByID(Request $request){
        $FirstId=$request->id;
        $LastId=$FirstId+4;

        return PhotoModel::where('id','>',$FirstId)->where('id','<=',$LastId)->get();
    }

    function PhotoUoload(Request $request){
        $photoPath = $request->file('photo')->store('public');

        $photoName= (explode('/',$photoPath))[1];

        $host= $_SERVER['HTTP_HOST'];

        $location ="http://".$host."/storage/".$photoName;

        $result = PhotoModel::insert(['location'=>$location]);

        return $result;
    }
}
