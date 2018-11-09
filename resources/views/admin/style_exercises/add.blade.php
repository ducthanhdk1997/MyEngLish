@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        {{--   Giao bai tap --}}
        <form action="" method="POST">
            @csrf
            <div class="input-group">
                <span class="input-group-addon">Tên dạng đề:</span>
                <input id="nameclass" type="text" class="form-control name_theme" name="name">
            </div>
            <div class="input-group">
                <span class="input-group-addon">Số phần:</span>
                <input id="nameclass" type="text" class="form-control number_part" name="num_part">
            </div>
            <button type="submit" class="btn btn-primary  ">Thêm</button>
        </form>
    </div>

@endsection()