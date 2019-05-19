<?php

namespace App\Http\Controllers\Teacher;

use App\Classes;
use App\Http\Requests\Teacher\ExportTestRequest;
use App\Http\Requests\Teacher\StoreTestResultRequest;
use App\ResultTest;
use App\Test;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class TestController extends Controller
{
    //

    public function index()
    {

    }

    public  function create(Classes $class)
    {

        return view('teacher.tests.create',
            [
                'class' => $class
            ]);
    }

    public  function create_one(Classes $class)
    {
        $tests = Test::query()->where('class_id','=',$class->id)->get();
        return view('teacher.tests.create_one',
            [
                'class' => $class,
                'tests' => $tests
            ]);
    }


    public  function store(ExportTestRequest $request, Classes $class)
    {
        if($request->hasFile('file'))
        {
            $file = $request->file;
            $title = $request->title;
            $test = new Test();
            $test->title = $title;
            $test->class_id = $class->id;
            $test->save();


            $test_results =Excel::load($request->file('file'), function($reader) {
            })->get()->toArray();
            if(!empty($test_results))
            {
                $insert = [];


                foreach ($test_results as $test_result)
                {
                    $student_id = trim($test_result['user_id']);
                    $username = trim($test_result['username']);
                    $score = trim($test_result['score']);

                    if ($student_id== '') {
                        flash()->error('Một số cột trong bảng sai cú pháp!');
                        return redirect()->back();

                    }
                    if ($score== '') {
                        flash()->error('Một số cột trong bảng sai cú pháp!');
                        return redirect()->back();
                    }

                    if (ResultTest::query()
                        ->where('user_id','=',$student_id)
                        ->where('test_id','=',$test->id)
                        ->exists())
                    {
                        ResultTest::query()
                            ->where('user_id','=',$student_id)
                            ->where('test_id','=',$test->id)
                            ->update(['score' => $score]);
                        continue;
                    }

                    $insert[] = [
                        'user_id' =>$student_id,
                        'test_id' => $test->id,
                        'score' => $score
                    ];
                }

                ResultTest::query()->insert($insert);
                flash()->success('Cập nhật điểm thành công!');
                return redirect()->back();
            }
            else
            {
                flash()->error('Không có dữ liệu trong file!');
                return redirect()->back();
            }
        }
        else
        {
            flash()->error('File rỗng!');
            return redirect()->back();
        }
    }

    public  function store_one(StoreTestResultRequest $request, Classes $class)
    {

        $test = $request->test;
        $score = $request->score;

        if($request->has('msv'))
        {
            $msv = $request->msv;
            $checkByMSV = true;
            $checkByEmail = true;
            $userByMSV = User::find($msv);
            $userByEmail = User::query()->where('email','=',$msv)->first();
            if($userByMSV == '') $checkByMSV = false;
            if($userByEmail == '') $checkByEmail = false;

            if($checkByMSV == true )
            {
                $cl = $userByMSV->classes()->where('class_id','=',$class->id)->first();
                if($cl == '')
                {
                    flash()->error('Học viên này không thuộc trong lớp!');
                    return redirect()->back();
                }
                if (ResultTest::query()
                    ->where('user_id','=',$msv)
                    ->where('test_id','=',$test)
                    ->exists())
                {
                    ResultTest::query()
                        ->where('user_id','=',$msv)
                        ->where('test_id','=',$test)
                        ->update(['score' => $score]);
                    flash()->success('Cập nhật điểm thành công!');
                    return redirect()->back();
                }
                else
                {
                    $testResult = new ResultTest();
                    $testResult->user_id = $msv;
                    $testResult->test_id = $test;
                    $testResult->score = $score;
                    if($testResult->save())
                    {
                        flash()->success('Cập nhật điểm thành công!');
                        return redirect()->back();
                    }
                    else
                    {
                        flash()->error('Cập nhật điểm không thành công!');
                        return redirect()->back();
                    }

                }
            }

            if($checkByEmail == true )
            {
                $cl = $userByEmail->classes()->where('class_id','=',$class->id)->first();
                if($cl == '')
                {
                    flash()->error('Học viên này không thuộc trong lớp!');
                    return redirect()->back();
                }
                if (ResultTest::query()
                    ->where('user_id','=',$userByEmail->id)
                    ->where('test_id','=',$test)
                    ->exists())
                {
                    ResultTest::query()
                        ->where('user_id','=',$userByEmail->id)
                        ->where('test_id','=',$test)
                        ->update(['score' => $score]);
                    flash()->success('Cập nhật điểm thành công!');
                    return redirect()->back();
                }
                else
                {
                    $testResult = new ResultTest();
                    $testResult->user_id = $userByEmail->id;
                    $testResult->test_id = $test;
                    $testResult->score = $score;
                    if($testResult->save())
                    {
                        flash()->success('Cập nhật điểm thành công!');
                        return redirect()->back();
                    }
                    else
                    {
                        flash()->error('Cập nhật điểm không thành công!');
                        return redirect()->back();
                    }

                }
            }

            flash()->error('MSV hoặc email không chính xác!');
            return redirect()->back();


        }
        else
        {
            flash()->error('MSV hoặc email không được rỗng!');
            return redirect()->back();
        }
    }

    public function export(Request $request)
    {
        $class = $request->class_id;
        $title = $request->title;
        if($title == '')
        {
            flash()->error('Tiêu đề không được rỗng');
            return redirect()->back();
        }
        if($class == '')
        {
            flash()->error('Lớp không được rỗng');
            return redirect()->back();
        }

        $cl = Classes::find($class);
        $filename = $title . '_' . $cl->name;
        $data = [];
        $students = $cl->students()->get();

        foreach ($students as $student)
        {
            $data[] = [
                'user_id' => $student->id,
                'username' => $student->username,
                'score' => ''
            ];
        }
//        return $data;
        return Excel::create($filename, function($excel) use ($data) {
            header('Content-Encoding: UTF-8');
            header('Content-type: text/csv; charset=UTF-8');
            header('Content-Disposition: attachment; filename=solutionstuff_example.csv');
            $excel->sheet('sheet1', function($sheet) use ($data)
            {
                $sheet->fromArray($data);
            });
        })->download('csv');
    }
}
