<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradeController extends MasterController
{
    //
    function __construct()
    {
        parent::__construct();
    }

    public  function getList()
    {
        return view('admin.grade.list');
    }

    public  function  add()
    {
        return view('admin.grade.add');
    }
}
