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
                <form class="form-horizontal" action="{{route('update',$user)}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="username" placeholder="Nhập họ tên" value="{{ $user->username }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Nhập email" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Địa chỉ</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="address" placeholder="Nhập họ tên" value="{{ $user->address }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Số điện thoại</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" placeholder="Nhập họ tên" value="{{ $user->phone }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Avatar</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="avatar" {{old('avatar')}}>
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
                        <label for="inputEmail3" class="col-sm-2 control-label">Mật khẩu mới</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="new_password" {{old('new_password')}}>
                            <p>( Để trống nếu không thay đổi mật khẩu)</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Nhập lại mật khẩu mới</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="renew_password" {{old('renew_password')}}>
                            <p>( Để trống nếu không thay đổi mật khẩu)</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Mật khẩu cũ</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="old_password">
                            <p>( Để trống nếu không thay đổi mật khẩu)</p>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()