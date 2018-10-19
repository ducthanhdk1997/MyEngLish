<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    //
    function __construct()
    {
    }

    public  function getList()
    {
        return view('admin.course.list');
    }

    public  function  add()
    {
        return view('admin.course.add');
    }
}
