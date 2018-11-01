<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
use App\Http\Requests\Admin\GradeStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Http\ResPonse;
use App\PI_Amount;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;

class GradeController extends Controller
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

    public  function  postGrade(GradeStoreRequest $request)
    {

        $grade = new Grade();
        $grade->name =$request->name;
        if($grade->save())
        {
            flash()->success('Them thanh cong');
            return redirect()->route('admin.grade.add');
        }
        else
        {
            flash()->error('Them that bai');
        }
    }

    public function getGrade(Grade $grade)
    {

        return view('admin.grade.edit',compact('grade'));
    }

    public  function  setName(GradeStoreRequest $request,Grade $grade)
    {
        $grade->name=$request->name;
        if($grade->save()){
            flash()->success('Sua thanh cong');
            return redirect()->route('admin.grade.list');
        }
        else{
            flash()->error('Sua that bai');
        }

    }
}
