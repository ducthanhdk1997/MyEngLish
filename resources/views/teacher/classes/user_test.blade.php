@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}


    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <div class="btn-group form-group">
            <a href="{{route('teacher.class.detail',$class)}}"><button class="btn  btn-primary" type="button">Danh sách lớp</button></a>
            <a href="{{route('teacher.class.student_test',$class)}}"><button class="btn  btn-primary" type="button" ></i>Điểm của lớp</button></a>
        </div>


        <div class="x_panel">
            <div class="x_title">
                <h2>Điểm tổng quát</h2>
                <div class="clearfix"></div>
            </div>
            <div class="btn-group form-group">
                <a href="{{route('teacher.class.detail',$class)}}"><button class="btn  btn-primary" type="button"><i class="fa fa-file-excel-o"> Xuất Excel</i></button></a>
            </div>
            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Học viên/Test</th>
                        <th>Đầu vào</th>
                        @foreach($tests as $test)
                            <th>{{$test->title}}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)

                        <tr style="height: 50px;">
                            <td>{{ $user->username }}</td>
                            @php
                                $exam_of_user = $user->exams()->get();
                            @endphp
                            @if($exam_of_user != null)
                                @php
                                    $check = 0;
                                    $id = 0;
                                    foreach ($exam_of_user as $item)
                                    {
                                        foreach ($exams as $exam)
                                        {
                                            if($exam->id == $item->id)
                                            {
                                                $check = 1;
                                                $id = $exam->id;
                                                break;
                                            }
                                        }
                                        if($check==1) break;
                                    }
                                @endphp
                                @if($id == 0)
                                    <td></td>
                                @else
                                    @php
                                       $exam_result =  $user->examResult()->where('exam_id','=',$id)->first();
                                    @endphp
                                    @if($exam_result !='')
                                        <td>{{$exam_result->score}}</td>
                                    @else
                                        <td></td>
                                    @endif
                                @endif

                            @else
                                <td></td>
                            @endif
                            @foreach($tests as $test)
                                @php
                                    $result_test = $user->testResult()->where('test_id','=',$test->id)->first();
                                @endphp
                                @if($result_test !='')
                                    <td>{{$result_test->score}}</td>
                                @else
                                    <td></td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()

