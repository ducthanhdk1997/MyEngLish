@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
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
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
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