@extends('admin.layouts.index')

@section('content')
    <div class="col-md-12">
        <div class="x_content">
            <div class="x_panel">
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-4">
                            <select class="form-control" id="sel1">
                                <option>Chưa xong</option>
                                <option>Đã xong</option>
                                <option>Tất cả</option>
                                <option>Hôm nay</option>
                            </select>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @foreach($exams as $exam)
                        <div class="panel panel-primary">
                            <div class="panel-heading">{{$exam->title}}</div>
                            <div class="panel-body">
                                <h4>{{$exam->note}}</h4>
                                <h4>{{$exam->classroom->name}}</h4>
                            </div>
                            <div class="panel-footer">
                                <div class="col-xs-2">
                                    <p> từ {{$exam->start_time}} đến {{$exam->end_time}}</p>
                                </div>
                                <div class="col-xs-2" style="float: right">
                                    <select class="form-control" id="sel1">
                                        <option>Chưa xong</option>
                                        <option>Đã xong</option>
                                    </select>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection