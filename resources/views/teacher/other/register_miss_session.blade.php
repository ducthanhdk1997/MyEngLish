@extends('admin.layouts.index')

@section('content')

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">

        <div class="x_panel">

            <div class="x_title">
                <h2>Giao diện đăng ký nghỉ học</h2>
                <div class="clearfix"></div>
            </div>

            <div class="form-group">
                <form action="{{route('teacher.class.store_change_class_session',Auth::user()->id)}}" class="form-horizontal" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Chọn lớp</label>
                        <div class="col-sm-10">
                            <select name="class" id="class"  class="form-control">
                                @foreach($classes as $class)
                                    <option value="{{$class->id}}" >{{$class->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Lịch học muốn nghỉ</label>
                        <div class="col-sm-10">
                            <?php
                                $i = 1;
                                $weekdays = [1=>'Thứ 2',2=>'Thứ 3',3 =>'Thứ 4',4 =>'Thứ 5',5 =>'Thứ 6',6 =>'Thứ 7',7 =>'CN'];
                            ?>
                            <select name="class_session" id="class_session"  class="form-control">
                                @foreach($class_sessions as $class_session)
                                    @php
                                        $start_date = \Carbon\Carbon::parse($class_session->start_date);
                                    @endphp
                                    @if($class_session->state == 0)
                                        <option value="{{$class_session->id}}" >
                                            {{$weekdays[$class_session->Schedule->weekday]}} - ngày
                                            {{$class_session->start_date}} -
                                            {{$class_session->classroom->name}} -
                                            {{$class_session->shift->name }}
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Lý do</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="reason" value="{{old('reason')}}" placeholder="Lý do">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ngày muốn học bù</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="start_date" value="{{old('start_date')}}" id="start" min="{{$day}}" placeholder="Ngày thi">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Ca học</label>
                        <div class="col-sm-10">
                            <select class="form-control"  name="shift_id" id="shifts">
                                @php $i=1;
                                @endphp
                                @foreach($shifts as $shift)
                                    @if($shift->id <= 5)
                                        <option value="{{$shift->id}}" {{ old('shift_id') == $shift->id ? 'selected' : '' }}  >{{$shift->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Phòng học</label>
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
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function submitForm() {
            $('#myform').submit();
        }
    </script>
@endsection

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