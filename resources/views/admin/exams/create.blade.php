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
                <form action=""  method="get" id="myform" class="form-group form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Khóa học</label>
                        <div class="col-sm-10">
                            <select name="course" onchange="submitForm();" class="form-control">
                                @foreach($cors as $cor)
                                    <option value="{{$cor->id}}" @if(isset($course)){{$course == $cor ? "selected" : "" }} @endif >{{$cor->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label for="inputEmail3" class="col-sm-2 control-label">Thời gian:</label>
                        <div class="col-sm-10" id="detail_course">
                            <label for="inputEmail3" class=" control-label">Khoa học bắt đầu từ ngày: {{$course->start_date}} và kết thúc vào ngày: {{$course->end_date}}.</label>
                        </div>
                    </div>
                </form>
                <form class="form-horizontal" action="{{ route('admin.exam.store') }}" method="post">
                    @csrf
                    <input type="text" name="course" value="{{$course->id}}" hidden>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" value="{{$course->name}}" placeholder="Title">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ngày thi</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="start_date" value="{{old('start_date')}}" id="start" min="{{$day}}" max="{{$course->start_date}}" placeholder="Ngày thi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ca thi</label>
                        <div class="col-sm-10">
                            <select class="form-control"  name="shift_id" id="shifts">
                               @php $i=1;
                               @endphp
                                @foreach($shifts as $shift)
                                    @if($shift->id == 6 || $shift->id == 7)
                                        <option value="{{$shift->id}}" {{ old('shift_id') == $shift->id ? 'selected' : '' }}  >{{$shift->name}}</option>
                                    @endif
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
                            <input type="date" class="form-control" name="deadline" value="{{old('deadline')}}" min="{{$day}}" max="{{$course->start_date}}" id="deadline" placeholder="Hạn đăng kí">
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
    <script>
        function submitForm() {
            $('#myform').submit();
        }
    </script>
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