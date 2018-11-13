@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">

        <h2>Danh sách bài tập đã làm</h2>

        <table class="table table-hover">
            <thead>
            <tr>
                <th>STT</th>
                <th>Tên bài tập</th>
                <th>Số câu trả lời đúng</th>
                <th>Tổng số câu</th>
                <th>Điểm</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="lstexercise">
            @foreach($exerhavedone as $item)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td>{{$item->exercise->name}}</td>
                        <td>{{$item->correct_answer}}</td>
                        <td>{{$item->total_question}}</td>
                        <td>{{$item->point}}</td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection()
