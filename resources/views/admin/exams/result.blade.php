@extends('admin.layouts.index')

@section('content')

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">

        <div class="x_panel">
            <div class="alert alert-danger">

            </div>
            <form action="" method="get" id="myform" class="form-group">
                <div class="form-group">
                    <label for="" class="">Chọn khóa học</label>
                    <select name="filCourse" onchange="submitForm();" id="course" class="form-control">
                        @foreach($courses as $course)
                            <option value="{{$course->id}}" @if(isset($filCourse)){{$filCourse == $course->id ? "selected" : "" }} @endif>{{$course->name}} </option>
                        @endforeach
                    </select>
                </div>
            </form>
            <div class="form-group">
                <label for="" class="">Chọn lịch thi:</label>
                <select name="filExam"  id="exam" class="form-control">
                    @foreach($exams as $exam)
                        <option value="{{$exam->id}}" @if(isset($filExam)){{$filExam == $exam->id ? "selected" : "" }} @endif>{{$exam->shift->name}} - {{$exam->classroom->name}}
                            - {{$exam->start_date}} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="x_panel">
            <div class="x_title">
                <h2>Cập nhật điểm</h2>
                <div class="clearfix"></div>
            </div>
            <a href="{{route('admin.exam.create_result')}}"><button type="button" class="btn btn-primary" style="margin-bottom: 5px">Upload</button></a>
            <div class="x_content">
                <table class="table table-hover" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Họ và tên</th>
                        <th>Điểm</th>
                    </tr>
                    </thead>
                    <tbody id="tbo">
                    <?php
                    $i = 1;
                    ?>
                    @foreach($examResults as $examResult)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $examResult->user_id}}</td>
                            <td>{{ $examResult->user->username }}</td>
                            <td>{{$examResult->score}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $examResults->appends(request()->all())->links()}}
                </div>
            </div>
        </div>
    </div>

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <script>
        function submitForm() {
            $('#myform').submit();
        }
    </script>


@endsection

@section('script')
    <script>
        $('.alert-danger').hide();
        $(document).ready(function () {

            $('#exam').change(function () {
                var exam = $(this).val();
                var course = $('#course').val();
                var url = "http://myenglish.test:8080/admin/exam/showResult/"+course+'/'+exam + '';
                location.replace(url);
            });


        });
    </script>
@endsection()