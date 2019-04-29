@extends('admin.layouts.index')
@section('content')
    {{-- add user --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        <form action="{{route('admin.classes.storeuser')}}" method="POST" class="form-horizontal">
            @csrf
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="email" placeholder="Nhập email" id="email">
                </div>
                <div class="col-sm-1">
                    <button type="button" id="btnCheck" class="btn btn-success">Kiểm tra</button>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3"  class="col-sm-2 control-label"></label>
                <div class="col-sm-10" id="username">
                    <label for="inputEmail3"></label>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class=" col-sm-2 control-label">Khóa học</label>
                <div class="col-sm-9">
                    <select name="course_id" id="courses" class="form-control">
                        <option value="-1">All</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" >
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class=" col-sm-2 control-label">Lớp</label>
                <div class="col-sm-9">
                    <select name="class" id="classes" class="form-control">
                        <?php $i = 1; ?>
                        @foreach($classes as $class)
                            @if($i==1)
                                <option value="{{ $class->id }}" selected>{{ $class->name }}</option>
                            @else
                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Xong</button>

                </div>
            </div>
        </form>
    </div>
    {{-- end of add user --}}

@endsection()

@section('script')
    <script>
        $(document).ready(function () {
            $('#courses').change(function () {
                var course_id = $(this).val();
                $.get("{{asset('admin/ajax/classtypeselect')}}" + "/" + course_id, function (data) {
                    $('#classes').html(data)
                });
            });
        });

        $('#btnCheck').click(function () {
            var email = $('#email').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: "{{ url('admin/ajax/getusername') }}",
                data: {
                    email: email
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
                        $('#username').html('');
                        $('#username'). append(`<label for="inputEmail3">${data.success}</label>`);

                    }
                }

            });
        })
    </script>
@endsection()