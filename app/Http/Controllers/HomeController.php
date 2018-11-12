<?php

namespace App\Http\Controllers;

use App\Class_Exercise;
use App\Classes;
use App\User;
use App\User_Class;
use Carbon\Carbon;
use DateTime;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::query()->findOrFail(\Auth::user()->id);
        $now = Carbon::now();
        $exercises = DB::table('class_exercises')
            ->where('deadline','>=',$now)
            ->join('class','class_exercises.id','=','class.id')
            ->join('user_exercises','class_exercises.id','=','user_exercises.exercise_id')
            ->where('user_exercises.new','=',1)
            ->where('user_exercises.user_id','=',$user->id)
            ->join('exercises','class_exercises.exercise_id','=','exercises.id')
            ->select('exercises.id','exercises.name','class_exercises.deadline','class.name as class_name')
            ->get();

        return view('pages.exercise.list',['exercises'=>$exercises]);
    }
}
