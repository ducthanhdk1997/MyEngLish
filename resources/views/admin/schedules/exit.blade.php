@extends('admin.layouts.index')

@section('content')
    <div class="col-md-12">
        <div class="x_content">
            <div class="x_panel">
                <div class="row">

                    <form action="{{route('admin.schedule.update',$schedule)}}"  method="post" class="form-horizontal" id="lich">
                        @csrf
                        <div class="form-group">
                            <div class="alert alert-danger" style="display:none;">

                            </div>
                            @if(session('messages') !== null)
                                <div class="alert alert-danger">
                                    <p>{{ session('messages') }}</p>
                                </div>
                            @endisset
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="courses">Thứ trong tuần:</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="weekdays" name="weekdays">
                                    <option value="1"  {{ $schedule->weekday == 1 ? 'selected' : '' }}>Thứ 2</option>
                                    <option value="2" {{ $schedule->weekday == 2 ? 'selected' : '' }}>Thứ 3</option>
                                    <option value="3" {{ $schedule->weekday == 3 ? 'selected' : '' }}>Thứ 4</option>
                                    <option value="4" {{ $schedule->weekday == 4 ? 'selected' : '' }}>Thứ 5</option>
                                    <option value="5" {{ $schedule->weekday == 5 ? 'selected' : '' }}>Thứ 6</option>
                                    <option value="6" {{ $schedule->weekday == 6 ? 'selected' : '' }}>Thứ 7</option>
                                    <option value="7" {{ $schedule->weekday == 7 ? 'selected' : '' }}>CN</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Thông tin:</label>
                            <div class="col-sm-10">
                                <label for="inputEmail3" class=" control-label">Khóa học bắt đầu từ: {{$schedule->class->course->start_date}} đến {{$schedule->class->course->end_date}}</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Ngày bắt đầu:</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="start_date" value="{{$schedule->start_date}}" min="{{$schedule->class->course->start_date}}" max="{{$schedule->class->course->end_date}}" id="start" placeholder="Ngày bắt đầu" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Ngày kết thúc</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" name="end_date" value="{{$schedule->end_date}}" min="{{$schedule->class->course->start_date}}" max="{{$schedule->class->course->end_date}}"  id="end" placeholder="Ngày kết thúc" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Ca học:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="shifts" id="shifts">
                                    @foreach($shifts as $shift)
                                        <option value="{{$shift->id}}" {{ $schedule->shift_id == $shift->id ? 'selected' : '' }}>{{$shift->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Phòng học:</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="classroom" id="classroom">
                                    <option value="{{$schedule->classroom_id}}" selected>{{$schedule->classroom->name}}</option>
                                    @foreach($rooms as $room)
                                        <option value="{{$room->id}}" {{ $schedule->classroom_id == $room->id ? 'selected' : '' }}>{{$room->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </div>
                    </form>
                    <hr>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {

            var roomId = {{$schedule->classroom_id}}
            $('#start').change(function () {
                var start_date = $(this).val();
                var weekday = $('#weekdays').val();
                var shift = $('#shifts').val();
                var end_date = $('#end').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ url('admin/ajax/getclassroom') }}",
                    data: {
                        start_date: start_date,
                        weekday: weekday,
                        shift: shift,
                        end_date: end_date
                    },
                    success: function(data){
                        if(data.state == false)
                        {
                            $('.alert-danger').html('');
                            jQuery.each(data.errors, function(key, value){
                                jQuery('.alert-danger').show();
                                jQuery('.alert-danger').append('<p>'+value+'</p>');
                            });
                        }
                        else
                        {
                            $('.alert-danger').html('');
                            $('.alert-danger').hide();
                            $('#classroom').html('');
                            $('#classroom').append(`<option value="{{$schedule->classroom_id}}" selected>{{$schedule->classroom->name}}</option>`)
                            $.each(data.success, function(key, value){
                                var room = value;
                                if(room.id !=roomId)
                                    $('#classroom').append(`<option value="${room.id}" >${room.name}</option>`)

                            });
                        }

                    }

                });


            });

            $('#weekdays').change(function () {
                var weekday = $(this).val();
                var start_date = $('#start').val();
                var shift = $('#shifts').val();
                var end_date = $('#end').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ url('admin/ajax/getclassroom') }}",
                    data: {
                        start_date: start_date,
                        weekday: weekday,
                        shift: shift,
                        end_date: end_date
                    },
                    success: function(data){
                        if(data.state == false)
                        {
                            $('.alert-danger').html('');
                            jQuery.each(data.errors, function(key, value){
                                jQuery('.alert-danger').show();
                                jQuery('.alert-danger').append('<p>'+value+'</p>');
                            });
                        }
                        else
                        {
                            $('.alert-danger').html('');
                            $('.alert-danger').hide();
                            $('#classroom').html('');
                            $('#classroom').append(`<option value="{{$schedule->classroom_id}}" selected>{{$schedule->classroom->name}}</option>`)
                            $.each(data.success, function(key, value){
                                var room = value;
                                if(room.id !=roomId)
                                $('#classroom').append(`<option value="${room.id}" >${room.name}</option>`)

                            });
                        }

                    }

                });
            });

            $('#shifts').change(function () {
                var shift = $(this).val();
                var start_date = $('#start').val();
                var weekday = $('#weekdays').val();
                var end_date = $('#end').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ url('admin/ajax/getclassroom') }}",
                    data: {
                        start_date: start_date,
                        weekday: weekday,
                        shift: shift,
                        end_date: end_date
                    },

                    success: function(data){
                        if(data.state == false)
                        {
                            $('.alert-danger').html('');
                            jQuery.each(data.errors, function(key, value){
                                jQuery('.alert-danger').show();
                                jQuery('.alert-danger').append('<p>'+value+'</p>');
                            });
                        }
                        else
                        {
                            $('.alert-danger').html('');
                            $('.alert-danger').hide();
                            $('#classroom').html('');
                            $('#classroom').append(`<option value="{{$schedule->classroom_id}}" selected>{{$schedule->classroom->name}}</option>`)
                            $.each(data.success, function(key, value){
                                var room = value;
                                if(room.id !=roomId)
                                    $('#classroom').append(`<option value="${room.id}" >${room.name}</option>`)

                            });
                        }
                    }
                });
            });


        })
    </script>
@endsection()