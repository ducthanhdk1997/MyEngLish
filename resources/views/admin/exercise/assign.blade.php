@extends('admin.layouts.index')
@section('content')
<div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
    {{--giao bai tap--}}
    <form action="#" method="get" accept-charset="utf-8">
        <div class="form-group">
            <label for="group_class">Chọn khối học:</label>
            <select class="form-control" id="group_class" name="idGroup">
                <option value="1" selected>A1</option>
            </select>
        </div>


        <div class="form-group">
            <label for="style_exer">Chọn kiểu bài tập:</label>
            <select class="form-control" id="style_exer" name="idStyle">
                <option value="1" selected>day</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exer">Chọn bài tập:</label>
            <select class="form-control" id="exer" name="idExer">
                <option value="1" selected>Bai1</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exer">Chọn lớp:</label>
            <select class="form-control list_class" id="lstClass" name="idClass">
                <option value="1" selected>A1_No1</option>
            </select>
        </div>

        <div class="form-group row">
            <div class="col-xs-6">
                <label for="ex">Hạn bài tập</label>
                <input class="form-control" id="ex3" type="date" name="date" min="">
            </div>
            <div class="col-xs-6">
                <label for="ex3">Chọn giờ</label>
                <input class="form-control" id="ex4" type="time" name="time" >
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Giao</button>
    </form>
</div>


@endsection()