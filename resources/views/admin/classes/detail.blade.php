@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thông tin người dùng</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" >
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên học viên</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                        $i = 1;
                    ?>
                    @foreach($usersClass as $item)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ optional($item->user)->username }}</td>
                            <td>{{ optional($item->user)->email }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a class="btn btn-default" href="{{ route('admin.users.index') }}"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()