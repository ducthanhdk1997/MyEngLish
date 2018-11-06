@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="page-title" style="padding: 0;">
        <div class="title_right pull-right">
            <div class="form-group pull-right top_search" style="padding: 0;">
                <div class="input-group">
                    <div class="input-group">
                        <form action="{{ route('admin.students.search') }}" method="get" style="display: inherit;border-radius: 25px 0 0 25px">
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

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Create</a>
        <div class="pull-right form-group">
            <form action="" method="get" id="myform">
                <select name="filter" onchange="submitForm();" class="form-control">
                    <option value="">Lọc theo khóa học</option>
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" @if(isset($filter)){{$filter == $grade->id ? "selected" : "" }} @endif >
                            {{ $grade->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
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
                            <th>Tên khóa học</th>
                            <th>Thời gian bắt đầu</th>
                            <th>Thời gian kết thúc</th>
                            <th>Trình độ</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                        ?>
                        @foreach($courses as $course)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td><a href="{{ route('admin.courses.show', $course) }}">{{ $course->name }}</a></td>
                                <td>{{ $course->time_start }}</td>
                                <td>{{ $course->time_end }}</td>
                                <td>{{ $course->grade->name }}</td>
                                <td>
                                    <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-success" {{ Auth::user()->role_id == 4 ? "disabled" : ""}}>
                                        <i class="fa fa-edit"></i> Sửa
                                    </a>
                                    <form action="{{ route('admin.courses.delete', $course) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" {{ Auth::user()->role_id == 4 ? "disabled" : ""}} onclick='return confirm("Bạn có muốn xóa " + "\"" + "{{ $course->name }}" + "\"");'>
                                            <i class="fa fa-remove"></i> Xóa
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $courses->links() }}
                </div>
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