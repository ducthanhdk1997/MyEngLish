<?php

namespace App\Http\Controllers;

use App\Class_Exercise;
use App\Classes;
use App\Exercise;
use App\Http\Requests\Admin\Class_ExerciseRerquest;
use App\Http\Requests\Admin\Class_ExerciseStoreRequest;
use App\Http\Requests\Admin\ExerciseStoreRequest;
use App\Question;
use App\User_Class;
use App\User_Exersice;
use  Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExerciseController extends Controller
{
    //
    public  function getList()
    {
        $exercises = Exercise::all();
        return view('admin.exercise.list',['exercises'=>$exercises]);
    }

    public  function  create()
    {
        return view('admin.exercise.add');
    }

    public  function  assign()
    {

        $exercises = Exercise::all();
        return view('admin.exercise.assign',['exercises'=>$exercises]);
    }

    public  function  postAssign(Class_ExerciseStoreRequest $request, Class_Exercise $class_Exercise)
    {
        $class_id = $request->class_id;
        $class = Classes::query()->findOrFail($class_id);
        $students = $class->students()->get();

        $exercise_id = $request->exercise_id;
        $date = $request->date;
        $time = $request->time;
        $deadline = $date." ".$time;
        $isSexerciseExists = Class_Exercise::query()->where('class_id',$class_id)->where('exercise_id',$exercise_id)->exists();
        if($isSexerciseExists)
        {
            $class_Exercise->deadline = $deadline;
            if($class_Exercise->where('class_id',$class_id)
                                ->where('exercise_id',$exercise_id)
                                ->update(['deadline'=>$deadline])
            )
            {
                foreach ($students as $student)
                {
                    if(User_Exersice::query()->where('user_id',$student->id)
                                    ->where('exercise_id',$exercise_id)
                                    ->get()=='[]'
                    )
                    {
                        $new = [
                            'user_id' => $student->id,
                            'exercise_id' => $exercise_id,
                            'total_question' => 0,
                            'correct_answer' => 0,
                            'point' => 0,
                            'new' => true
                        ];
                       $user_exercise = User_Exersice::create($new);
                    }
                    else
                    {
                        User_Exersice::where('user_id',$student->id)
                                    ->where('exercise_id',$exercise_id)
                                    ->update(['new'=>true]);
                    }
                }
                flash('Giao bai tap thanh cong');
            }
            else{
                flash('Giao bai khong thanh cong');
            }
        }
        else
        {
            $class_Exercise=Class_Exercise::create(['class_id'=>$class_id,'exercise_id'=>$exercise_id,'deadline'=>$deadline]);
            foreach ($students as $student)
            {
                if(User_Exersice::where('user_id',$student->id)
                        ->where('exercise_id',$exercise_id)
                        ->get()=='[]'
                )
                {
                    $new = [
                        'user_id' => $student->id,
                        'exercise_id' => $exercise_id,
                        'total_question' => 0,
                        'correct_answer' => 0,
                        'point' => 0,
                        'new' => true
                    ];
                    $user_exercise = User_Exersice::create($new);
                }
                else
                {
                    User_Exersice::where('user_id',$student->id)
                        ->where('exercise_id',$exercise_id)
                        ->update(['new'=>true]);
                }
            }
            flash('Giao bai tap thanh cong');

        }
        return redirect()->route('admin.exercise.assign');


    }

    /**
     * @param ExerciseStoreRequest $request
     * @param Exercise $exercise
     */
    public  function  store(ExerciseStoreRequest $request, Exercise $exercise)
    {
        $exercises = Exercise::where('grade_id',$request->grade_id)->get();
        foreach ($exercises as $ex)
        {

            if(str_slug($ex->name) == str_slug($request->name))
            {

                flash('Ten ton tai');
                return view('admin.exercise.add');
            }
        }
        $exercise->name = $request->name;
        $exercise->grade_id = $request->grade_id;
        if($exercise->save())
        {
            flash('Them thanh cong');
            return redirect()->route('admin.exercise.list');
        }
        else
        {
            flash('them that bai');
        }
    }

    public  function getExercise(Exercise $exercise)
    {
        return view('admin.exercise.edit',compact('exercise'));
    }


    public  function  setName(Request $request,Exercise $exercise)
    {

        $exercises = Exercise::where('grade_id',$exercise->grade_id)
            ->where('style_id',$exercise->style_id)
            ->get();
        foreach ($exercises as $exe)
        {
            if(str_slug($exe->name)==str_slug($request->name))
            {
                flash('Tên tồn tại');
                return view('admin.exercise.edit',compact('exercise'));
            }
        }
        $exercise->name = $request->name;
        if($exercise->save())
        {
            flash('Sửa tên thành công');
            return redirect()->route('admin.exercise.list');
        }
        else
        {
            flash('Sửa tên thất bại');
        }
    }




}
