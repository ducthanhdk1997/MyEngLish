<?php

namespace App\Http\Controllers\Admin;

use App\Grade;
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

    public function getGrade(Grade $grade)
    {

        return view('admin.grade.edit',compact('grade'));
    }

    public  function  setName(Request $request,Grade $grade)
    {
        $this->validate($request,[
            'name' => 'required'
        ],
        [
            'name.required' => 'Bạn chưa nhập tên'
        ]);
        $grade->name=$request->name;
        $grade->save();
        return redirect()->route('admin.grade.list')->with('message','Sửa tên thành công');
    }
}
