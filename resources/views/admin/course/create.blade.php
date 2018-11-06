@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thay đổi thông tin khóa học</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal" action="{{ route('admin.courses.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Trình độ</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="group_class">
                                @foreach ($grades as $grade)
                                    @if($grade['ID']==1)
                                        <option value="{{$grade->id}}" selected>{{$grade->name}}</option>
                                    @else
                                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên khóa học</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Nhập tên khóa học" value="{{ old('name') }}" >
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Thời gian bắt đầu</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="time_start" placeholder="Nhập email" value="{{ old('time_start') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Thời gian kết thúc</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="time_end" placeholder="Nhập họ tên" value="{{ old('time_end') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Thời gian dự kến kết thúc</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="actua_end_date" placeholder="Nhập họ tên" value="{{ old('actua_end_date') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Giá tiền</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="price" placeholder="Nhập giá tiền" value="{{ old('price') }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Mô tả</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="summary-ckeditor" name="describe">{{ old('describe') }}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
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