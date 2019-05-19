@extends('admin.layouts.index')

@section('content')

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">

        <div class="x_panel">
            <div class="form-group">
                <div class="alert alert-danger" style="display:none;">

                </div>
            </div>
            <form action="{{route('admin.exam.arrange_student')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="" class="">Chọn khóa học</label>
                    <select name="filCourse"  id="course" class="form-control">
                        @foreach($courses as $course)
                            <option value="{{$course->id}}" @if(isset($filCourse)){{$filCourse == $course->id ? "selected" : "" }} @endif>{{$course->name}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="" class="">Chọn lớp muốn chia:</label>
                    <select name="class"  id="class" class="form-control">
                        @foreach($classes as $class)
                            <option value="{{$class->id}}" >{{$class->name}} đang có {{$class->students()->count() }} sinh viên</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="" class="">Kiểu chia</label>
                    <select name="type"  id="type" class="form-control">
                        <option value="1" >Chia theo số lượng</option>
                        <option value="2" >Chia theo điểm đầu vào</option>
                    </select>
                </div>

                <div class="form-group" id="type_1">
                    <label for="" class="">Số học sinh</label>
                    <input type="text" class="form-control" value="30" id="num_of_type_1" name="num_studen_1">
                </div>

                <div class="form-inline" id="type_2">
                    <div class="form-group">
                        <label for="focusedInput">Điểm từ</label>
                        <input class="form-control" value="0" id="txtFScore" type="text" name="fScore">
                    </div>
                    <div class="form-group">
                        <label for="inputPassword">Đến</label>
                        <input class="form-control" value="450" id="txtLScore" type="text" name="lScore">
                    </div>
                    <div class="form-group" id="type_1">
                        <label for="" class="">Số học sinh: Để "0"là không xét trường hợp này!</label>
                        <input type="text" value="0" class="form-control" id="num_of_type_2" name="num_studen_2">
                    </div>
                    <button type="button" class="btn btn-primary form-control" id="btnPreview" style="margin-top: 5px;">Xem trước</button>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary" id="btnPreview" style="margin-top: 5px;">Thực hiện</button>
                </div>

            </form>
        </div>
        <div class="x_panel">
            <div class="x_content">
                <table class="table table-hover" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>ID</th>
                        <th>Họ và tên</th>
                        <th>Điểm đầu vào</th>
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
        $('#type_2').hide();
        $(document).ready(function () {
            $('#course').change(function () {
                var filCourse = $(this).val();
                var url = "http://myenglish.test:8080/admin/exam/arrange_by_course/"+filCourse+ '';
                location.replace(url);
            });

            $('#type').change(function () {
                var type = $(this).val();
                if(type == 1) { $('#type_1').show(); $('#type_2').hide(); }
                else {$('#type_1').hide(); $('#type_2').show();}
            });

            $('#btnPreview').click(function () {
                var course = $('#course').val();
                var num_of_type_2  = $('#num_of_type_2').val();
                var fscore = $('#txtFScore').val();
                var lscore = $('#txtLScore').val();
                if(num_of_type_2 == '')
                {
                    num_of_type_2 = 0;
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "post",
                    url: "{{ url('admin/ajax/getstudent') }}",
                    data: {
                        course: course,
                        num_studnet: num_of_type_2,
                        first_score: fscore,
                        last_score: lscore
                    },
                    success: function(data){
                        if(data.errors == false)
                        {
                            $('.alert-danger').html('');
                            jQuery.each(data.errors, function(key, value){
                                jQuery('.alert-danger').show().append('<p>'+value+'</p>');
                            });
                        }
                        else
                        {
                            $('.alert-danger').html('');
                            $('.alert-danger').hide();
                            $('#classroom').html('');
                            $('#classroom').append()
                            $('#tbo').html('');
                            $.each(data.success, function(key, value){

                                    var examResult = value;
                                    $('#tbo').append(`<tr>
                                                <th scope="row">${key+1}</th>
                                                <td> ${ examResult.user_id}</td>
                                                <td> ${ examResult.username}</td>
                                                <td> ${ examResult.score}</td>
                                            </tr>`);

                            });
                        }

                    }

                });
            });




        })
    </script>
@endsection()