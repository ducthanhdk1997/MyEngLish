<?php

namespace App\Http\Controllers;

use App\Imports\QuestionImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Excel;

class QuestrionController extends Controller
{
    //

    public  function create()
    {
        return view('admin.question.add');
    }

    public  function  store(Request $request)
    {
//        $file = $request->file('myfile');
        $file = Input::file('my-file');
        $filename = $file->getClientOriginalName('myfile');
        dd($file);
    }
}
