@extends('admin.layouts.index')

@section('content')

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">

        <div class="x_panel">
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
        </div>

        <div class="x_panel">

            <span for="" class="">{{$cou->name}} - Ngày bắt đầu: {{$cou->start_date}} - Ngày kết thúc: {{$cou->end_date}} - Giá: {{$cou->price}} VND</span>
            <br>
            @php
                $c = \App\User_Course::query()->where('course_id','=',$cou->id)->count();
            @endphp
            <span for="" class="">Số sinh viên đăng ký học: {{$c}}</span>
            <br>
            <h4 for="" class="">Tổng số tiền: {{$total}} VND</h4>
        </div>


        <div class="x_panel">
            <div class="x_title">
                <h2>Chi tiết doanh thu</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-hover" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Họ và tên</th>
                        <th>Giá gốc</th>
                        <th>Mã voucher</th>
                        <th>Giá trị voicher</th>
                        <th>Thành tiền</th>
                        <th>Ngày đóng</th>
                    </tr>
                    </thead>
                    <tbody id="tbo">
                    <?php
                    $i = 1;
                    ?>
                    @foreach($userCourses as $userCours)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $userCours->user_id}}</td>
                            <td>{{ $userCours->user->username }}</td>
                            <td>{{ $userCours->course->price }}</td>
                            @if($userCours->vouche_id != null)
                                <td>{{ $userCours->voucher->code}}</td>
                                <td>{{ $userCours->voucher->value }}</td>
                            @else
                                <td>Không</td>
                                <td>Không</td>
                            @endif
                            <td>{{ $userCours->total_amount }}</td>
                            <td>{{ $userCours->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $userCourses->appends(request()->all())->links()}}
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