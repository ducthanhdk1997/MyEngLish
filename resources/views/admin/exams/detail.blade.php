@extends('admin.layouts.index')

@section('content')
    <div class="col-md-12">
        <div class="x_content">
            <div class="x_panel">
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading">{{$exam->title}}</div>
                        <div class="panel-body">
                            <h4>Ngày thi {{$exam->start_date}}</h4>
                            <h4>Ca thi: {{$exam->shift->name}}</h4>
                            <h4>Bắt đầu từ {{$exam->shift->start_time}} đến {{$exam->shift->end_time}}</h4>
                            <h4>{{$exam->course->name}}</h4>
                            <h4>Phòng thi:{{$exam->classroom->name}}</h4>
                            @if($exam->state==0)
                                <h4>Tình trạng: Chưa xong</h4>
                            @else
                                <h4>Tình trạng: Đã xong</h4>
                            @endif
                        </div>
                        <div class="panel-footer"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection