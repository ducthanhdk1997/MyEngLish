@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="page-title">
        <div class="title_right pull-right">
            <div class="form-group pull-right top_search">
                <div class="input-group">
                    <div class="input-group">
                        <form action="{{ route('admin.users.search') }}" method="get" style="display: inherit;border-radius: 25px 0 0 25px">
                            {{--@csrf--}}
                            <input type="text" class="form-control" placeholder="Search for..." name="key">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Go!</button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách người dùng</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Chức vụ</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                        ?>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td><a href="{{ route('admin.users.detail', $user) }}">{{ $user->username }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->role->name }}</td>
                                <td>
                                    <button href="{{ route('admin.users.edit', $user) }}" class="btn btn-success" {{ Auth::user()->role_id != 1 ? "disabled" : ""}}>
                                        <i class="fa fa-edit"></i> Sửa
                                    </button>
                                    <form action="{{ route('admin.users.delete', $user) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" {{ Auth::user()->role_id != 1 ? "disabled" : ""}}><i class="fa fa-remove"></i> Xóa</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()