@extends('admin.layouts.index')
@section('content')
    {{-- new class --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        <form action="{{ route('admin.classes.store') }}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <label for="group_class">Chọn trình độ:</label>
                <select class="form-control" id="grades" name="grade_id">
                    @foreach ($grades as $grade)
                        @if($grade['id']==1)
                            <option value="{{$grade->id}}" selected>{{$grade->name}}</option>
                        @else
                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="courses">Chọn khóa học:</label>
                <select class="form-control" id="courses" name="course_id">
                    @foreach ($courses as $course)
                        @if($course['id']==1)
                            <option value="{{$course->id}}" selected>{{$course->name}}</option>
                        @else
                            <option value="{{$course->id}}">{{$course->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="input-group new_class">
                <span class="input-group-addon">Tên lớp:</span>
                <input id="nameclass" type="text" class="form-control name_class" name="name">
            </div>
            <div class="input-group new_class">
                <span class="input-group-addon">Tên giảng viên:</span>
                <select name="teacher" id="" class="form-control">
                    @foreach($teachers as $teacher)
                        <option value="{{ $teacher->id }}">{{ $teacher->username }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary  ">Thêm</button>
        </form>
    </div>
    {{-- end of new class --}}

@endsection()

@section('script')
    <script>
        $(document).ready(function () {
            $('#grades').change(function () {
                var grade_id = $(this).val();
                $.get("{{asset('admin/ajax/coursetypeselect')}}" + "/" + grade_id, function (data) {
                    $('#courses').html(data)
                });
            })
        })
    </script>
@endsection()