<?php

namespace App\Http\Controllers;

use App\Class_Exercise;
use App\Exercise;
use App\Http\Requests\Admin\Class_ExerciseRerquest;
use App\Http\Requests\Admin\Class_ExerciseStoreRequest;
use App\Http\Requests\Admin\ExerciseStoreRequest;
use App\Part;
use App\Question;
use App\Style_Exercise;
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

    public  function  add()
    {
        return view('admin.exercise.add');
    }

    public  function  assign()
    {
        $styles = Style_Exercise::all();
        $exercises = Exercise::all();
        return view('admin.exercise.assign',['styles'=>$styles,'exercises'=>$exercises]);
    }

    public  function  postAssign(Class_ExerciseStoreRequest $request)
    {
        $class_id = $request->class_id;
        $exercise_id = $request->exercise_id;
        $date = $request->date;
        $time = $request->time;
        $deadline = $date." ".$time;
        $class_Exercise=Class_Exercise::create(['class_id'=>$class_id,'exercise_id'=>$exercise_id,'deadline'=>$deadline]);
        flash('Giao bai tap thanh cong');
        return redirect()->route('admin.exercise.assign');

    }

    /**
     * @param ExerciseStoreRequest $request
     * @param Exercise $exercise
     */
    public  function  postExercise(ExerciseStoreRequest $request, Exercise $exercise)
    {

//        return $request->num_part;
        $exercise->name = $request->name;
        $exercise->num_part = $request->num_part;
        $exercise->style_id = $request->style_id;
        $exercise->grade_id = $request->grade_id;
        $exercise_name = $request->name;
        $sophan = $request->num_part;

        if ($exercise->save()) {
            $exercise_id = $exercise->where('name', $exercise_name)->value('id');
            for ($i = 1; $i <= $sophan; $i++)
            {
                $socau = $_POST['socauphan' . $i . ''];
                $part = Part::create([
                    'name' => "Part" . $i,
                    'num_question' => $socau,
                    'exercise_id' => $exercise_id
                ]);

                $part_id = $part->where('name', 'Part' . $i)->where('exercise_id', $exercise_id)->value('id');
                for ($j = 1; $j <= $socau; $j++)
                {
                    $dapan = $_POST['cau' . $j . $i . ''];
                    $questions = Question::create([
                        'answer' => $dapan,
                        'part_id' => $part_id
                    ]);
                }

            }
            flash()->success('Them thanh cong');
            return redirect()->route('admin.exercise.list');
        }

        else{
            flash()->error('Them that bai');
        }
    }

}
