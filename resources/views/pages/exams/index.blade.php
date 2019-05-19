@extends('admin.layouts.index')

@section('content')

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">

        <div class="x_panel">
            <div class="title_right pull-right">
                <div class="form-group pull-right top_search">
                    <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for title.." title="Type in a title">
                </div>
            </div>
            <div class="x_title">
                <h2>Danh sách lịch thi đầu vào</h2>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <div class="col-xs-3">
                    <form action="" method="get" id="myform" class="form-group">
                        <select name="filter" onchange="submitForm();" class="form-control">
                            <option value="-1" @if(isset($filter)){{$filter == -1 ? "selected" : "" }} @endif >All </option>
                            <option value="1" @if(isset($filter)){{$filter == 1 ? "selected" : "" }} @endif >Chưa xong </option>
                            <option value="2" @if(isset($filter)){{$filter == 2 ? "selected" : "" }} @endif >Đã xong </option>
                        </select>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-hover" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Ngày thi</th>
                        <th>Ca thi</th>
                        <th>Khóa học</th>
                        <th>Phòng thi</th>
                        <th>Hạn đăng ký</th>
                        <th>Trạng thái</th>
                        <th>Điểm</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($exams as $exam)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td><a href="{{ route('admin.exam.show', $exam) }}">{{ $exam->title }}</a></td>
                            <td>{{ $exam->start_date }}</td>
                            <td>{{$exam->shift->name}}</td>
                            <td>{{ $exam->classroom->name }}</td>
                            <td>{{ $exam->course->name }}</td>
                            <td>{{ $exam->deadline}}</td>
                            @if($exam->state==0)
                                <td>Chưa xong</td>
                            @else
                                <td>Đã xong</td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $exams->appends(request()->all())->links()}}
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