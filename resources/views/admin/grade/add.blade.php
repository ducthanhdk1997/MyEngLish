@extends('admin.layouts.index')
@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        <form action="" method="GET">
            <div class="input-group new_grade">
                <span class="input-group-addon">Tên trình độ:</span>
                <input id="nameclass" type="text" class="form-control name_grade" name="namegrade">
            </div>
            <button type="submit" class="btn btn-primary btnGroupClass ">Thêm</button>
        </form>
    </div>
    {{-- end of new class --}}

@endsection()