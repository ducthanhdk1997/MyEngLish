@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thông tin người dùng</h2>
                <div class="clearfix"></div>
            </div>
            <div class="text-center">
                <img src="{{ asset("/admin_asset/images/img.jpg")}}" alt="" style="width: 250px; height:250px;">
            </div>
            <div class="x_content" >
                <table style="margin: 0 auto;">
                    <tr >
                        <td width="100px"><label for="">Ten</label></td>
                        <td style="padding-left: 30px"><label for="">{{ $user->username }}</label></td>
                    </tr>
                    <tr>
                        <td width="100px" class="pull-right"><label for="">Email</label></td>
                        <td style="padding-left: 30px"><label for="">{{ $user->email }}</label></td>
                    </tr>
                    <tr>
                        <td width="100px" class="pull-right"><label for="">Số điện thoại</label></td>
                        <td style="padding-left: 30px"><label for="">{{ $user->phone }}</label></td>
                    </tr>
                    <tr>
                        <td width="100px" class="pull-right"><label for="">Giới tính</label></td>
                        <td style="padding-left: 30px"><label for="">{{ $user->gender == 1 ? "Nam" : "Nữ" }}</label></td>
                    </tr>
                    <tr>
                        <td width="100px" class="pull-right"><label for="">Chức vụ</label></td>
                        <td style="padding-left: 30px"><label for="">{{ $user->role->name }}</label></td>
                    </tr>
                </table>
                <a class="btn btn-default" href="{{ route('admin.users.index') }}"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()