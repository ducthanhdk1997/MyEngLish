<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Classes;
use App\Grade;
use function Sodium\compare;


class ClassController extends Controller
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

    public function getClass(Classes $classes)
    {
        return view('admin.classes.edit',compact($classes));
    }
}
