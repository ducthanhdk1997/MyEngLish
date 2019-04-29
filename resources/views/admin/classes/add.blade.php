@extends('admin.layouts.index')
@section('content')
    {{-- new class --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        <form class="form-horizontal" action="{{ route('admin.classes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="col-sm-2 control-label" for="courses">Chọn khóa học:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="courses" name="course_id">
                        @php $i=1;
                        @endphp
                        @foreach ($courses as $course)
                            @if($i++==1)
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
                @php
                $i =1;
                @endphp
                @foreach( $courses as $course)
                    @if($i++==1)
                        <div class="col-sm-10" id="detail_course">
                            <label for="inputEmail3" class=" control-label">Khoa học bắt đầu từ ngày: {{$course->start_date}} và kết thúc vào ngày: {{$course->end_date}};</label>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Tên lớp:</label>
                <div class="col-sm-10">
                    <input type="text" id="nameclass" class="form-control" name="name" placeholder="Name">
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">Tên giảng viên:</label>
                <div class="col-sm-10">
                    <select name="teacher" id="" class="form-control">
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->username }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
            <hr >
            <br>

            <br>
            <hr >
            <br>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Create</button>
                    <a href="{{ route('admin.classes.index') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
                </div>
            </div>
        </form>
    </div>
    {{-- end of new class --}}

@endsection()

@section('script')
    <script>
        $(document).ready(function () {
            $('#courses').change(function () {
                var course_id = $(this).val();
                $.get("{{asset('admin/ajax/getdetailcourse')}}" + "/" + course_id, function (data) {
                    $('#detail_course').html(data)
                });
            })


        })
    </script>
@endsection()