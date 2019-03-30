@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thay đổi thông tin khóa học</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal" action="{{ route('admin.courses.update', $course) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên khóa học</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Nhập họ tên" value="{{ $course->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Thời gian bắt đầu</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="time_start" placeholder="Nhập email" value="{{ $course->time_start }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Thời gian kết thúc</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="time_end" placeholder="Nhập họ tên" value="{{ $course->time_end }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Thời gian dự kến kết thúc</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="actua_end_date" placeholder="Nhập họ tên" value="{{ $course->actua_end_date }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Giá tiền</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="price" placeholder="Nhập họ tên" value="{{ $course->price }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="summary-ckeditor" name="describe">{{ $course->describe }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('teachers') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end of new class --}}
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'summary-ckeditor' );
    </script>
@endsection()