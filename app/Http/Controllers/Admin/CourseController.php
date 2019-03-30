<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Grade;
use App\Http\Requests\Admin\CourseStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        if(!empty($request->filter)){
//            $filter = $request->filter;
//            $courses = Course::query()->where('grade_id', 'like', "$filter")->paginate(10);
//            return view('admin.course.index', compact('courses', 'filter'));
//        }
        $courses = Course::query()->paginate(10);
        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CourseStoreRequest $request)
    {
        $course = new Course();
        $course->name = $request->name;
        $course->start_date = $request->start_date;
        $course->end_date = $request->end_date;
        $course->price = $request->price;
        $course->describe = $request->describe;

        if($course->save()){
            flash()->success('Thêm khóa học thành công');
        }
        else{
            flash()->error('Thêm khóa học thất bại');
        }
        return redirect()->route('admin.courses.index');


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
    public function edit(Course $course)
    {
        return view('admin.course.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CourseStoreRequest $request, Course $course)
    {
        $course->name = $request->name;
        $course->time_start = $request->time_start;
        $course->time_end = $request->time_end;
        $course->actua_end_date = $request->actua_end_date;
        $course->price = $request->price;
        $course->describe = $request->describe;
//        dd($course);
        if($course->save()){
            flash()->success('Thay đổi khóa học thành công');
        }
        else{
            flash()->error('Thay đổi khóa học thất bại');
        }
        return redirect()->route('admin.courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $course)
    {
        if($course->delete()){
            flash()->success('Xoa khoa học thành công');
        }
        else{
            flash()->error('Xoa khóa học thất bại');
        }
        return redirect()->back();

    }
}
