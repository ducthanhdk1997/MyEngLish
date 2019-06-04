@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}


    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <a href="{{ route('admin.classroom.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Thêm mới</a>
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách khóa học</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên phòng học</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($classrooms as $classroom)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $classroom->name }}</td>
                            <td>
                                @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
                                    <a href="{{ route('admin.classroom.edit', $classroom) }}" class="btn btn-success">
                                        <i class="fa fa-edit"></i> Sửa
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- end of new class --}}
    <script>
        function submitForm() {
            $('#myform').submit();
        }
    </script>
@endsection()