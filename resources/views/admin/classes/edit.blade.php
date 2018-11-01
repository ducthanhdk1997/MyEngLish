@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        <form action="{{route('admin.class.update',$class)}}" method="POST">
            @csrf
            <div class="input-group">
                <span class="input-group-addon">Tên lớp:</span>
                <input id="namegrade" type="text" class="form-control name_class" name="name" value="{{$class->name}}">
            </div>
            <button type="submit" class="btn btn-primary">Sủa</button>
        </form>
    </div>
@endsection()