@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thay đổi thông tin</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal" action="{{ route('admin.teachers.update', $teacher) }}" method="post">
                    @csrf
                    @method('PUT')



                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Trình độ</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="level" placeholder="Nhập họ tên" value="{{ $teacher->level }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('admin.teachers.index') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()