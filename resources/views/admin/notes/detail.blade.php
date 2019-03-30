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
                    @foreach($todos as $todo)
                        <div class="panel panel-primary">
                            <div class="panel-heading">{{$todo->title}}</div>
                            <div class="panel-body">
                                <h4>{{$todo->content}}</h4>
                            </div>
                            <div class="panel-footer">
                                <div class="col-xs-2">
                                    <p>{{$todo->plan}}</p>
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