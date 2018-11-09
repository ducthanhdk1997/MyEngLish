@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        <form action="{{route('admin.style_exercise.edit',$style_exercise)}}" method="post">
            @csrf
            <div class="input-group ">
                <span class="input-group-addon">Tên dạng đề:</span>
                <input id="name" type="text" class="form-control " name="name" value="{{$style_exercise->name}}">
            </div>
            <div class="input-group ">
                <span class="input-group-addon">Số phần:</span>
                <input id="name" type="text" class="form-control " name="num_part" value="{{$style_exercise->num_part}}">
            </div>
            <button type="submit" class="btn btn-primary">Sủa</button>
        </form>
    </div>
@endsection