@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thay đổi thông tin</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal" action="{{ route('admin.exam.update', $exam) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Khóa học</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="course_id" id="courses">
                                @foreach($courses as $course)
                                    @if($exam->course_id == $course->id)
                                        <option value="{{$course->id}}" selected>{{$course->name}}</option>
                                    @else
                                        <option value="{{$course->id}}">{{$course->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label for="inputEmail3" class="col-sm-2 control-label">Thời gian:</label>
                        @foreach( $courses as $course)
                            @if($exam->course_id == $course->id)
                                <div class="col-sm-10" id="detail_course">
                                    <label for="inputEmail3" class=" control-label">Khoa học bắt đầu từ ngày: {{$course->start_date}} và kết thúc vào ngày: {{$course->end_date}};</label>
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" placeholder="Title" value="{{ $exam->title }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ngày thi</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="start_date" id="start" min="{{$day}}" placeholder="Ngày thi" value="{{ $exam->start_date }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ca thi</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="shift_id" id="shifts">
                                @foreach($shifts as $shift)
                                    @if($exam->shift_id == $shift->id)
                                        <option value="{{$shift->id}} " selected>{{$shift->name}}</option>
                                    @else
                                        <option value="{{$shift->id}}">{{$shift->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Phòng thi</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="classroom_id" id="classrooms">
                                @foreach($classrooms as $classroom)
                                    @if($exam->classroom_id == $classroom->id)
                                        <option value="{{$classroom->id}}" selected>{{$classroom->name}}</option>
                                    @else
                                        <option value="{{$classroom->id}}">{{$classroom->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Hạn đăng kí</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="deadline" min="{{$day}}" id="deadline" placeholder="Hạn đăng kí" value="{{ $exam->deadline }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Trạng thái</label>
                        <div class="col-sm-10">
                            @if (strtotime($day) >= strtotime($exam->start_date) && strtotime($time) >= strtotime($exam->shift->end_time))
                                <input type="radio" name="state" value="1"  {{ $exam->state  == 1 ? "checked" : "" }} > Đã xong
                                <input type="radio" name="state" value="0" {{ $exam->state  == 0 ? "checked" : "" }}> Chưa xong

                            @else
                                <input type="radio" name="state" value="{{$exam->state}}" {{ $exam->state  == 0 ? "checked" : "" }}> Chưa xong
                            @endif


                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('admin.exam.index') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()

@section('script')
    <script>
        $(document).ready(function () {
            $('#start').change(function () {
                var start_date = $(this).val();
                var shift_id = $('#shifts').val();
                $.get("{{asset('admin/ajax/getroombyshiftandday')}}"+"/"+start_date+"/"+shift_id, function (data) {
                    $('#classrooms').html(data)

                });

            });

            $('#shifts').change(function () {
                var shift_id = $(this).val();
                var start_date = $('#start').val();
                $.get("{{asset('admin/ajax/getroombyshiftandday')}}"+"/"+start_date+"/"+shift_id, function (data) {
                    $('#classrooms').html(data)

                });

            });

            $('#courses').change(function () {
                var course_id = $(this).val();
                $.get("{{asset('admin/ajax/getdetailcourse')}}" + "/" + course_id, function (data) {
                    $('#detail_course').html(data)
                });
            })
        })
    </script>

@endsection()