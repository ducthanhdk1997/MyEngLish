<?php

namespace App\Http\Controllers;

use App\Grade;
use Illuminate\Http\Request;
use Illuminate\Http\ResPonse;
use App\PI_Amount;
use Illuminate\Database\Eloquent\Model;

class GradeController extends MasterController
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

    public  function  postGrade(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required'
            ],
            [
                'name.required' =>'Bạn chưa nhập tên'
            ]);
        $grade = new Grade();
        $grade->name =$request->name;
        $grade->save();
        return redirect('admin/grade/add')->with('message','Thêm thành công');
    }
}
