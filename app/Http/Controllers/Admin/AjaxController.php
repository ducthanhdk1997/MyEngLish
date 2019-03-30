<?php

namespace App\Http\Controllers\Admin;
use App\Exercise;
use App\Http\Controllers\Controller;

use App\Classes;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    //
    public  function __construct()
    {
    }

    public  function  getClassTypeTable($course_id)
    {
        $classes = Classes::where('course_id', $course_id)->get();
    }

    public  function getClassTypeSelect($course_id)
    {
        if($course_id==-1)
        {
            $class = Classes::all();
        }
        else
        {
            $class= Classes::where('course_id',$course_id)->get();
        }
        $i=1;
        foreach ($class as $class)
        {
            if($i==1)
            {
                echo ('<option value="'.$class->id.'" selected>'.$class->name.'</option>');
            }
            else
            {
                echo ('<option value="'.$class->id.'">'.$class->name.'</option>');
            }
            $i++;
        }
    }

    public  function  getCourseTypeTable($grade_id)
    {
        $coures = Course::where('grade_id',$grade_id)->get();
        $i=1;
        foreach ($coures as $coure)
        {
            echo ('<tr>
                            <td>'.$i++.'</td>
                            <td>'.$coure->name.'</td>
                            <td>'.$coure->time_start.'</td>
                            <td>'.$coure->time_end.'</td>
                            <td>'.$coure->actua_end_date.'</td>
                            <td>'.$coure->describe.'</td>
                            <td>'.$coure->price.'</td>

                            <td class="data-table-edit">
                                <a class="" href=""><i class="fa fa-pencil"></i> Edit</a>
                            </td>
                            <td class="data-table-edit">
                                <a class="" href=""><i class="fa fa-pencil"></i> Detail</a>
                            </td>
                            <td class="data-table-delete">
                                <a onclick="if(!confirm(\'Are you sure?\')) return false;" class=" red" href=""><i class="fa fa-trash-o"></i> Delete</a>
                            </td>
                        </tr>');
        }
    }

    public  function  getCourseTypeSelect($grade_id)
    {
        $coures = Course::where('grade_id',$grade_id)->get();
        $i=1;
        foreach ($coures as $course)
        {
            if($i==1)
            {
                echo ('<option value="'.$course->id.'" selected>'.$course->name.'</option>');
            }
            else
            {
                echo ('<option value="'.$course->id.'">'.$course->name.'</option>');
            }
            $i++;
        }
    }

    public  function  getExercise($grade_id)
    {
        $exercises = Exercise::where('grade_id',$grade_id)->get();
        return $exercises;

    }

}
