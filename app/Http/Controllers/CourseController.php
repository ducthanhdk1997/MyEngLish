<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CourseController extends MasterController
{
    //
    function __construct()
    {
        parent::__construct();
    }

    public  function getList()
    {
        $courses =  Course::all();
        return view('admin.course.list',['courses'=>$courses]);
    }

    public  function  add()
    {
        return view('admin.course.add');
    }
}
