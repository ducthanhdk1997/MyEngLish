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

    	return view('admin.classes.list');
    }

    public function add()
    {

        return view('admin.classes.add');
    }
    public function addUser()
    {

        return view('admin.classes.adduser');
    }
}
