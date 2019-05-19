@extends('admin.layouts.index')

@section('content')

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">



        <div class="x_panel">
            <div class="x_title">
                <h2>{{$exam->title}} ngày {{$exam->start_date}} {{$exam->shift->name}} {{$exam->classroom->name}}</h2>
                <div class="clearfix"></div>
            </div>
            <a href="{{route('admin.exam.exprortUserExam',$exam)}}"><button type="button" class="btn btn-primary" style="margin-bottom: 5px">Export</button></a>
            <div class="x_content">
                <table class="table table-hover" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Họ và tên</th>
                    </tr>
                    </thead>
                    <tbody id="tbo">
                    <?php
                    $i = 1;
                    ?>
                    @foreach($userExams as $userExam)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $userExam->user_id}}</td>
                            <td>{{ $userExam->user->email }}</td>
                            <td>{{ $userExam->user->username }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $userExams->appends(request()->all())->links()}}
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