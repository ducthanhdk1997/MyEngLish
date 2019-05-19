@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Lịch hôm nay</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                @foreach($class_sessions as $class_session)
                                    <a href=""><p>Giảng viên: {{$class_session->class->teacher->username}} -
                                            Lớp: {{$class_session->class->name}} - {{$class_session->classroom->name}}
                                            - {{$class_session->shift->name}}</p></a>
                                    <a href="{{route('admin.schedule.updateState',$class_session)}}">
                                        <button type="button" class="btn btn-success">Đã xong</button>
                                    </a>
                                    <hr>
                                @endforeach
                                @foreach($nowExams as $nowExam)
                                    <a href=""><p>{{$nowExam->title}} - {{$nowExam->course->name}}
                                            - {{$nowExam->classroom->name}} - {{$nowExam->shift->name}}</p></a>
                                    <a href="{{route('admin.exam.updateState',$nowExam)}}">
                                        <button type="button" class="btn btn-success">Đã xong</button>
                                    </a>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Yêu cầu</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <?php
                                $i = 1;
                                $weekdays = [1 => 'Thứ 2', 2 => 'Thứ 3', 3 => 'Thứ 4', 4 => 'Thứ 5', 5 => 'Thứ 6', 6 => 'Thứ 7', 7 => 'CN'];
                                ?>
                                @foreach($change_class_sessions as $change_class_session)
                                    @php
                                        $start_date1 = \Carbon\Carbon::parse($change_class_session->class_session->start_date);
                                        $start_date2 = \Carbon\Carbon::parse($change_class_session->start_date);
                                    @endphp
                                    <p>Giảng viên: {{$change_class_session->user->username}}</p>
                                    <p>Chuyển lịch học của
                                        lớp: {{$change_class_session->class_session->class->name}}</p>
                                    <p>Từ:
                                        {{$weekdays[$start_date1->dayOfWeek]}} - ngày
                                        {{$change_class_session->class_session->start_date}} -
                                        {{$change_class_session->class_session->classroom->name}} -
                                        {{$change_class_session->class_session->shift->name }}
                                    </p>
                                    <p>Sang:
                                        {{$weekdays[$start_date2->dayOfWeek]}} - ngày
                                        {{$change_class_session->start_date}} -
                                        {{$change_class_session->classroom->name}} -
                                        {{$change_class_session->shift->name }}
                                    </p>
                                    <p>Lý do: {{$change_class_session->reason}}</p>
                                    <div class="alert alert-danger">

                                    </div>
                                    <div class="alert alert-success">

                                    </div>
                                    <button type="button" class="btn btn-info btncheck"
                                            id="{{$change_class_session->id}}">Kiểm tra
                                    </button>
                                    <a href="{{route('admin.requires.cancel',$change_class_session)}}">
                                        <button type="button" class="btn btn-danger">Từ chối</button>
                                    </a>
                                    <a href="{{route('admin.requires.update',$change_class_session)}}">
                                        <button type="button" class="btn btn-success">Thực hiện</button>
                                    </a>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Công việc chưa xong</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                @foreach($missClass_sessions as $missClass_session)
                                    <a href=""><p>Giảng viên: {{$missClass_session->class->teacher->username}} -
                                            Lớp: {{$missClass_session->class->name}} - {{$missClass_session->classroom->name}}
                                            - {{$missClass_session->shift->name}} - Ngày: {{$missClass_session->start_date}}</p></a>
                                    <a href="{{route('admin.schedule.updateState',$missClass_session)}}">
                                        <button type="button" class="btn btn-success">Đã xong</button>
                                    </a>
                                    <hr>
                                @endforeach
                                @foreach($missExams as $missExam)
                                    <a href=""><p>{{$missExam->title}} - {{$missExam->course->name}}
                                            - {{$missExam->classroom->name}} - {{$missExam->shift->name}} - Ngày: {{$missExam->start_date}}</p></a>
                                    <a href="{{route('admin.exam.updateState',$missExam)}}">
                                        <button type="button" class="btn btn-success">Đã xong</button>
                                    </a>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Danh sách lớp học kết thúc</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                @foreach($end_classes as $end_class)
                                    <a href=""><p>{{$end_class->name}} Thuộc: {{$end_class->course->name}}</p></a>
                                    <a href="{{route('employee.classes.update_state',$end_class)}}">
                                        <button type="button" class="btn btn-success">Đã xong</button>
                                    </a>
                                    <hr>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()

@section('script')
    <script>
        $('.alert-success').hide();
        $('.alert-danger').hide();
        $(document).ready(function () {
            $('.btncheck').click(function () {
                var change_id = $(this).attr('id');

                $.get("{{asset('admin/ajax/checkchange')}}" + "/" + change_id, function (data) {
                    if(data.success)
                    {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.alert-success').html('').append(data.success);
                    }
                    else
                    {
                        $('.alert-danger').show();
                        $('.alert-success').hide();
                        $('.alert-danger').html('').append(data.errors);
                    }

                });

            });
        })
    </script>
@endsection()