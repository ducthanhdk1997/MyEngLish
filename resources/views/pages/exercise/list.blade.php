@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">

        <h2>Danh sách bài tập mới</h2>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Lớp</th>
                <th>Tên bài tập</th>
                <th>DeadLine</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($exercises as $exercise)
                <tr>
                    <td>{{$exercise->class_name}}</td>
                    <td>{{$exercise->name}}</td>
                    <td>{{$exercise->deadline}}</td>
                    <td><a href="{{route('user.exercise',$exercise->id)}}"><i class="fa fa-pencil"></i> Làm</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection()