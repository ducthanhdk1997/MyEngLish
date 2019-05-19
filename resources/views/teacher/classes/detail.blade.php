@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}


    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <div class="btn-group form-group">
            <a href="{{route('teacher.class.detail',$class)}}"><button class="btn  btn-primary" type="button">Danh sách lớp</button></a>
            <a href="{{route('teacher.class.student_test',$class)}}"><button class="btn  btn-primary" type="button" ></i>Điểm của lớp</button></a>
        </div>


        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách học sinh</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên học viên</th>
                        <th>Email</th>
                        <th>Số điện thoai</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($usersClass as $item)
                        <tr style="height: 50px;">
                            <td>{{ $i++ }}</td>
                            <td>{{ optional($item->user)->username }}</td>
                            <td>{{ optional($item->user)->email }}</td>
                            <td>{{ optional($item->user)->phone }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $usersClass->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()

