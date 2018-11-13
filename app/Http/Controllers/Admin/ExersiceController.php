<?php

namespace App\Http\Controllers\Admin;

use App\Class_Exercise;
use App\Exercise;
use App\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;

class ExersiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.exercise.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $exercise = new Exercise();
        $exercise->name = $request->name;
        $exercise->grade_id = $request->grade;
        $exercise->save();

        $check = Exercise::query()->where('name', $request->name)->first();
//        dd($check->id);
        if(!$request->hasFile('file-excel')){
            return redirect()->back()->withErrors("No file selected");
        }
        $file = $request->file('file-excel');
        if(!$file->getclientoriginalextension() == "xlsx"){
            return redirect()->back()->withErrors("Selected file is not excel file");
        }
        $filename = $file->getClientOriginalName();
        $file->move('excel', $filename);
        $filePath = 'public/excel/' . $filename;
//        $filePath = public_path('excel/' . $filename);
        $reader = Excel::load($filePath);
        foreach ($reader->toArray() as $key => $row){
            $question = Question::query()->create([
                'name' => $row['cau_hoi'],
                'content' => $row['noi_dung'],
                'a' => $row['a'],
                'b' => $row['b'],
                'c' => $row['c'],
                'd' => $row['d'],
                'answer' => $row['dap_an'],
                'point' => $row['diem_so'],
                'exercise_id' => $check->id,
                'image' => 'a'
            ]);

//            dd($question);
        }
        flash()->success('Tạo câu hỏi thành công');
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function assign(Request $request){
        $class = new Class_Exercise();
        $class->class_id = $request->class_id;
        $class->exercise_id = $request->exercise_id;
        $class->deadline = $request->date;

        if($class->save()){
            flash()->success('Giao bai tap thanh cong');
        }
        else{
            flash()->error('Giao bài tập thất bại');
        }
        return redirect()->back();
    }
}
