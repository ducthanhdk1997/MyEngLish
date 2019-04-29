@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <div class="x_panel">
            <div class="x_title">
                <h2>Đóng học phí</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal" action="{{route('admin.user_course.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <div class="alert alert-danger" style="display:none;">

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" placeholder="Nhập email" id="email">
                        </div>
                        <div class="col-sm-1">
                            <button type="button" id="btnEmail" class="btn btn-success">Kiểm tra</button>
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
                            <select name="course" id="courses" class="form-control">
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}" >
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Voucher</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="voucher" placeholder="voucher" id="voucher">
                        </div>
                        <div class="col-sm-1">
                            <button type="button" id="btnVoucher" class="btn btn-success">Kiểm tra</button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-2 control-label">Giá gốc</label>
                        <div class="col-sm-9 fprice" id="fprice">
                           <h3>{{$price}} vnd</h3>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Thành tiền</label>
                        <div class="col-sm-9 lprice" id="lprice">
                            <label ></label>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Xong</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()

@section('script')
    <script>
        $(document).ready(function () {
            $('#btnEmail').click(function () {
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
                            $('#username'). append(`<label for="inputEmail3">${data.success}</label>`)
                        }
                    }

                });
            })

            $('#btnVoucher').click(function () {
                var voucher = $('#voucher').val();
                var course = $('#courses').val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ url('admin/ajax/checkvoucher') }}",
                    data: {
                        voucher: voucher,
                        course: course

                    },
                    success: function(data){
                        if(data.state == false)
                        {
                            $('.alert-danger').html('');
                            jQuery('.alert-danger').show();
                            jQuery('.alert-danger').append(`<p>${data.errors}</p>`);
                        }
                        else
                        {
                            $('.alert-danger').html('');
                            $('.alert-danger').hide();
                            $('#lprice').html('');
                            $('#lprice'). append(`<h3>${data.success} vnd</h3>`)
                        }
                    }

                });
            })

            $('#courses').change(function () {
                var course = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "post",
                    url: "{{ url('admin/ajax/getprice') }}",
                    data: {
                        course: course
                    },
                    success: function(data){
                        if(data.state == false)
                        {
                            $('.alert-danger').html('');
                            jQuery('.alert-danger').show();
                            jQuery('.alert-danger').append(`<p>${data.errors}</p>`);
                        }
                        else
                        {
                            $('.alert-danger').html('');
                            $('.alert-danger').hide();
                            $('#fprice').html('');
                            $('#fprice'). append(`<h3>${data.success} vnd</h3>`)
                        }
                    }

                });
            })
        })
    </script>
@endsection()
