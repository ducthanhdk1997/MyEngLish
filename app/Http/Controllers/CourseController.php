<?php

namespace App\Http\Controllers;

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
        return view('admin.course.list');
    }

    public  function  add()
    {
        return view('admin.course.add');
    }
}
