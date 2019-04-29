@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thêm lịch thi</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal" action="{{ route('admin.exam.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" value="{{old('title')}}" placeholder="Title">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ngày thi</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="start_date" value="{{old('start_date')}}" id="start" min="{{$day}}" placeholder="Ngày thi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ca thi</label>
                        <div class="col-sm-10">
                            <select class="form-control"  name="shift_id" id="shifts">
                               @php $i=1;
                               @endphp
                                @foreach($shifts as $shift)
                                    <option value="{{$shift->id}}" {{ old('shift_id') == $shift->id ? 'selected' : '' }}  >{{$shift->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Khóa học</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="course_id" id="courses">
                                @php $i=1;
                                @endphp
                                @foreach($courses as $course)
                                    <option value="{{$course->id}}"   {{ old('course_id') == $course->id ? 'selected' : '' }}>{{$course->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Phòng thi</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="classroom_id" id="classrooms">
                                @php $i=1;
                                @endphp
                                @foreach($classrooms as $classroom)
                                        <option value="{{$classroom->id}}" {{ old('classroom_id') == $classroom->id ? 'selected' : '' }}>{{$classroom->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Hạn đăng kí</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="deadline" value="{{old('deadline')}}" min="{{$day}}" id="deadline" placeholder="Hạn đăng kí">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Trạng thái</label>
                        <div class="col-sm-10">
                            <input type="radio" name="state" value="0" checked> Chưa xong
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Create</button>
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
        })
    </script>

@endsection()