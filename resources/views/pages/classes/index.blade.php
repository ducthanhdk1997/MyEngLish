@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="page-title">

    </div>
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">


        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách lớp học</h2>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <div class="col-xs-3">
                    <form action="" method="get" id="myform" class="form-group">
                        <select name="filter" onchange="submitForm();" class="form-control">
                            @foreach($courses as $course)
                                <option value="{{$course->id}}" @if(isset($filter)){{$filter == $course->id ? "selected" : "" }} @endif >{{$course->name}} </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <br>
            <br>
            <div class="x_content">
                <table class="table table-hover " id="table_classes">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên lớp</th>
                        <th>Tên giảng viên</th>
                        <th>Khóa học</th>
                        <th>Lịch học</th>
                        <th>Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody id="table_classes">
                    <?php
                    $i = 1;
                    ?>
                    @foreach($classes as $class)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td><a href="{{ route('student.class.detail', $class) }}">{{ $class->name }}</a></td>
                            <td>{{ $class->teacher->username }}</td>
                            <td>{{ $class->course->name }}</td>
                            <td>
                                @php $i =1;
								$weekdays = [1=>'Thứ 2',2=>'Thứ 3',3 =>'Thứ 4',4 =>'Thứ 5',5 =>'Thứ 6',6 =>'Thứ 7',7 =>'CN']
                                @endphp
                                @foreach($scheduleclass as $sc)
                                    @if($sc->class_id == $class->id)
                                        <p>Từ {{$sc->start_date}} đến {{$sc->end_date}} ({{$i++}})</p>
                                        <p>{{$weekdays[$sc->weekday]}} {{$sc->shift->name}} {{$sc->classroom->name}}</p>
                                    @endif
                                @endforeach
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()

@section('script')
    <script>
        // $(document).ready(function () {
        //     $('#courses').change(function () {
        //         var course_id = $(this).val();
        //         var url = "http://myenglish.test:8080/admin/classes/"+course_id + '';
        //         location.replace(url);
        //     })
        // })
    </script>
    <script>
        function submitForm() {
            $('#myform').submit();
        }
    </script>
@endsection()

