<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Classes;
use App\Course;
use Illuminate\Http\Request;

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
            echo(

                '<tr>
					<td>'.$i.'</td>
					<td>'.$class->name.'</td>
					<td class="data-table-edit">
						<a class="" href=""><i class="fa fa-pencil"></i> Edit</a>
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
                echo ('<option value='.$class->id.'">'.$class->name.'</option>');
            }
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
}
