<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    //
    public  function getList()
    {
        return view('admin.exercise.list');
    }

    public  function  add()
    {
        return view('admin.exercise.add');
    }

    public  function  assign()
    {
        return view('admin.exercise.assign');
    }
}
