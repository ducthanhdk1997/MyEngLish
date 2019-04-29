@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_content">
                <div class="row">
                    <div class="col-md-5">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Việc cần làm</div>
                            <div class="panel-body">
                                <h1>{{$nowToDo}}</h1>
                            </div>
                            <div class="panel-footer"><a href="{{route('admin.note.show',0)}}">Chi tiết</a></div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="panel panel-primary">
                            <div class="panel-heading">Lịch thi</div>
                            <div class="panel-body">
                                <h1>{{$nowExam}}</h1>
                            </div>
                            <div class="panel-footer"><a href="{{route('admin.exam.show',0)}}">Chi tiết</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()