<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Classes;
use App\Grade;

class ClassController extends MasterController
{
    //
    function __construct()
    {
        parent::__construct();
    }

    public function getList()
    {
    	 $class = Classes::all();
    	 View::share('grades',Grade::all());
    	return view('admin.classes.list',['class'=>$class]);
    }

    public function add()
    {
        View::share('grades',Grade::all());
        return view('admin.classes.add');
    }
    public function addUser()
    {
        View::share('grades',Grade::all());
        return view('admin.classes.adduser');
    }
}
