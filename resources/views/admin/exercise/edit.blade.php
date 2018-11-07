@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        <form action="{{route('admin.exercise.update',$exercise)}}" method="post">
            @csrf
            <div class="input-group edit">
                <span class="input-group-addon">Tên bài tập:</span>
                <input id="name" type="text" class="form-control name_Exercise" name="name" value="{{$exercise->name}}">
            </div>
            <button type="submit" class="btn btn-primary">Sủa</button>
        </form>
    </div>
@endsection