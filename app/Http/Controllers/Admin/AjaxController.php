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

    public  function  getClassTypeTable($grade_id)
    {
        $class= Classes::where('grade_id',$grade_id)->get();
        $i=1;
        foreach ($class as $class)
        {

            $course = DB::table('class_course')
                ->join('courses', 'class_course.course_id', '=', 'courses.id')
                ->where('class_id',$class->id)
                ->select( 'courses.name', 'courses.time_end')
                ->get();
            foreach ($course as $course)
            echo(
                '<tr>
					<td>'.$i.'</td>
					<td>'.$class->name.'</td>
					<td>'.$course->name.'</td>
					<td>'.$course->time_end.'</td>
					
					<td class="data-table-edit">
						<a class="" href="'.route('admin.class.edit',$class).'"><i class="fa fa-pencil"></i> Edit</a>
					</td>
					<td class="data-table-edit">
						<a class="" href=""><i class="fa fa-pencil"></i> Detail</a>
					</td>
					<td class="data-table-delete">
						<a onclick="if(!confirm(\'Are you sure?\')) return false;" class=" red" href=""><i class="fa fa-trash-o"></i> Delete</a>
					</td>
				</tr>'
                );
            $i++;
       }
    }
    public  function getClassTypeSelect($grade_id)
    {

        $class= Classes::where('grade_id',$grade_id)->get();
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

    public  function getExerciseTypeSelect($grade_id,$style_id)
    {
        $exercises = Exercise::where('grade_id',$grade_id)->where('style_id',$style_id)->get();
        $i=1;
        foreach ($exercises as $exercise)
        {
            if($i==1)
            {
                echo ('<option value="'.$exercise->id.'" selected>'.$exercise->name.'</option>');
            }
            else {
                echo('<option value="' . $exercise->id .'">' . $exercise->name . '</option>');
            }
            $i++;
        }
    }
    public function getExerciseTypeTable($grade_id,$style_id)
    {
        $exercises = Exercise::where('grade_id',$grade_id)->where('style_id',$style_id)->get();
        $i=1;
        foreach ($exercises as $exercise)
        {
            echo ('<tr>
                            <td>'.$i++.'</td>
                            <td>'.$exercise->name.'</td>
                            <td>'.$exercise->num_part.'</td>
                            <td></td>
                            <td class="data-table-edit">
                                <a class="" href="'.route('admin.exercise.edit',$exercise).'"><i class="fa fa-pencil"></i> Edit</a>
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
}
