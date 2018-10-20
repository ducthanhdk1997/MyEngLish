<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassRoomController extends Controller
{
    //
    function __construct()
    {
    }

    public  function getList()
    {
        return view('admin.classroom.list');
    }

    public  function  add()
    {
        return view('admin.classroom.add');
    }
}
