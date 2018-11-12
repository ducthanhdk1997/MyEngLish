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
                <form class="form-horizontal" action="{{ route('admin.classes.update', $class) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Nhập họ tên" value="{{ $class->name }}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Tên giảng viên</label>
                        <div class="col-sm-10">
                            <select name="teacher" class="form-control">
                                @foreach($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ $teacher->username == $class->teacher->username ? "selected" : ""  }}>{{ $teacher->username }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()