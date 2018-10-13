<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes;
use App\Grade;

class ClassController extends Controller
{
    //
    function __construct()
    {

    }

    public function getList()
    {
    	// $class = Classes::all();
    	// $grades = Grade::all();
    	return view('admin.classes.list');
    }
}
