@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách lịch thi đầu vào</h2>
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
            <div class="x_content">
                <form action="{{route('student.exam.store')}}" method="post" class="form-group">
                    @csrf
                    <table class="table table-hover" id="myTable">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Khóa học</th>
                            <th>Title</th>
                            <th>Ngày thi</th>
                            <th>Ca thi</th>
                            <th>Phòng thi</th>
                            <th>Hạn đăng ký</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @foreach($exams as $exam)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $exam->course->name }}</td>
                                <td>{{ $exam->title }}</td>
                                <td>{{ $exam->start_date }}</td>
                                <td>{{$exam->shift->name}}</td>
                                <td>{{ $exam->classroom->name }}</td>
                                <td>{{ $exam->deadline}}</td>
                                <td>
                                    <input type="radio" id="exam" name="exam" value="{{$exam->id}}" checked>
                                </td>
                                <td><button type="submit" class="btn btn-success"  id="btnDangKy">Đăng ký</button></td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </form>

            </div>
            <hr>
            <div class="x_title">
                <h2>Lịch thi đã đăng ký</h2>
                <div class="clearfix"></div>
            </div>
            <br>
            <div class="x_content">
                <form action="{{route('student.exam.delete')}}" method="post" class="form-group">
                    @csrf
                    <table class="table table-hover" id="myTable">
                        <thead>
                        <tr>
                            <th>STT</th>
                            <th>Khóa học</th>
                            <th>Title</th>
                            <th>Ngày thi</th>
                            <th>Ca thi</th>
                            <th>Phòng thi</th>
                            <th>Hạn đăng ký</th>
                            <th>Hủy</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @if($hasExams !='')
                                    <th scope="row">1</th>
                                    <td>{{ $hasExams->course->name }}</td>
                                    <td>{{ $hasExams->title }}</td>
                                    <td>{{ $hasExams->start_date }}</td>
                                    <td>{{$hasExams->shift->name}}</td>
                                    <td>{{ $hasExams->classroom->name }}</td>
                                    <td>{{ $hasExams->deadline}}</td>

                                    @php
                                        $now = \Carbon\Carbon::now()->toDateString();
                                    @endphp

                                    @if(strtotime($now) < strtotime($hasExams->deadline))
                                        <td><input type="radio" id="hasExam" name="hasExam" value="{{$hasExams->id}}"></td>
                                    @endif


                                @endif
                            </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button type="submit" class="btn btn-success"  id="btnHuy">Hủy</button></td>
                        </tr>
                        </tfoot>
                    </table>
                </form>

            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()
<script>
    function submitForm() {
        $('#myform').submit();
    }
</script>