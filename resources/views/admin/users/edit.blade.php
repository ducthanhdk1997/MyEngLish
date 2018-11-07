@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thay đổi thông tin</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal" action="{{ route('admin.users.update', $user) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Nhập họ tên" value="{{ $user->username }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Nhập email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Số điện thoại</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" placeholder="Nhập họ tên" value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Giới tính</label>
                        <div class="col-sm-10">
                            <input type="radio" name="gender" {{ $user->gender  == 1 ? "checked" : "" }} > Nam
                            <input type="radio" name="gender" {{ $user->gender  == 0 ? "checked" : "" }}> Nữ
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Mật khẩu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="password" placeholder="Nhập mật khẩu">
                            <p>( Để trống nếu không thay đổi mật khẩu)</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()