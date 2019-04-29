@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thêm học viên</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-group" action="{{ route('admin.students.store') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="inputEmail3" class="control-label">Tên</label>
                        <input type="text" class="form-control" name="username" value="{{ old('name') }}" placeholder="Nhập họ tên">
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="control-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Nhập email">
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class=" control-label">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" placeholder="Nhập họ tên" >
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="control-label">Giới tính</label>
                        <input type="radio" name="gender" value="1"> Nam
                        <input type="radio" name="gender" value="0"> Nữ
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class=" control-label">Mật khẩu</label>
                        <input type="text" class="form-control" name="password" placeholder="Nhập mật khẩu">
                        <p>( Để trống nếu để mật khẩu mặc định là secret)</p>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle"></i> Create</button>
                            <a href="{{ route('admin.students.index') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end of new class --}}



@endsection()


