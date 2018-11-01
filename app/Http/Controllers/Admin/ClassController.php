<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ClassStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Classes;
use App\PI_Amount;
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
    public  function  postClass(ClassStoreRequest $request, Classes $classes)
    {
        $classes->name=$request->name;
        $classes->grade_id = $request->grade_id;
        echo $classes->name;
        die();
    }

    public function getClass(Classes $class)
    {
        return view('admin.classes.edit',compact('class'));
    }

    public function setName(ClassStoreRequest $request, Classes $classes)
    {
        $classes->name = $request->name;
        if($classes->save()){
            flash()->success('sua thanh cong');
            return redirect()->route('admin.class.list');
        }
        else{
            flash()->error('sua that bai');
        }
    }
}
