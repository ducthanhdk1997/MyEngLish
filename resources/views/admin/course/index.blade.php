@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}


    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> Create</a>
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
                            <th>Trạng thái</th>
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
                                <td>{{ $course->start_date }}</td>
                                <td>{{ $course->end_date }}</td>
                                @php
                                $now = \Carbon\Carbon::now()->toDateString();
                                @endphp
                                <td>
                                    @if(strtotime($now) > strtotime($course->start_date))
                                        Đã mở
                                    @else
                                        Sắp mở
                                    @endif
                                </td>
                                <td>
                                    @if($course->classes()->count()== 0 && Auth::user()->role_id == 1)
                                        <a href="{{ route('admin.courses.edit', $course) }}" class="btn btn-success">
                                            <i class="fa fa-edit"></i> Sửa
                                        </a>
                                    @endif
                                    {{--<form action="{{ route('admin.courses.delete', $course) }}" method="post" style="display: inline">--}}
                                        {{--@csrf--}}
                                        {{--@method('DELETE')--}}
                                        {{--<button type="submit" class="btn btn-danger" {{ Auth::user()->role_id == 1 ? "disabled" : ""}} onclick='return confirm("Bạn có muốn xóa " + "\"" + "{{ $course->name }}" + "\"");'>--}}
                                            {{--<i class="fa fa-remove"></i> Xóa--}}
                                        {{--</button>--}}
                                    {{--</form>--}}
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