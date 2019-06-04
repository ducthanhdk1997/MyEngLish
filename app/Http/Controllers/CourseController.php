<?php

namespace App\Http\Controllers;

use App\Course;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class CourseController extends Controller
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

    public function index()
    {
        $date = Carbon::now()->toDateString();
        $courses = Course::query()->where('start_date','>=', $date)->paginate(10);

        return \view('pages.courses.index',['courses' => $courses]);
    }
}
