@extends('admin.layouts.index')

@section('content')

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">

        <div class="x_panel">
            <form action="" method="get" id="myform" class="form-group">
                <div class="form-group">
                    <label for="" class="">Chọn khóa học</label>
                    <select name="filter" onchange="submitForm();" class="form-control">
                        <option value="1" @if(isset($filter)){{$filter == 1 ? "selected" : "" }} @endif >Quý 1 </option>
                        <option value="2" @if(isset($filter)){{$filter == 2 ? "selected" : "" }} @endif >Quý 2 </option>
                        <option value="3" @if(isset($filter)){{$filter == 3 ? "selected" : "" }} @endif >Quý 3 </option>
                        <option value="4" @if(isset($filter)){{$filter == 4 ? "selected" : "" }} @endif >Quý 4 </option>
                        <option value="-1" @if(isset($filter)){{$filter == -1 ? "selected" : "" }} @endif >Cả năm </option>
                    </select>
                </div>
            </form>
        </div>

        <div class="x_panel">

            @php
                $sokh = $courses->count();
            @endphp
            <h4>Số khóa học mở được: {{$sokh}}</h4>
            <hr>
            @foreach($courses as $cou)
                <span for="" class="">{{$cou->name}} - Ngày bắt đầu: {{$cou->start_date}} - Ngày kết thúc: {{$cou->end_date}} - Giá: {{$cou->price}} VND</span>
                <br>
                @php
                    $us_c = \App\User_Course::query()->where('course_id','=',$cou->id)->get();
                    $tong = 0;
                    foreach ($us_c as $item)
                        $tong += $item->total_amount;
                @endphp
                <span></span>
                <span for="" class="">Số sinh viên đăng ký học: {{$us_c->count()}}</span>
                <br>
                <span for="" class="">Doanh thu của khóa là: {{$tong}} VND</span>
                <hr>
            @endforeach
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
                        <th>Khóa học</th>
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
                            <td>{{ $userCours->course->name }}</td>
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