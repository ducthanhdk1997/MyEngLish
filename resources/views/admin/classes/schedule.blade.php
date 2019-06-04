@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}


    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">

        <a href="{{ route('admin.schedule.create',$class) }}" class="btn btn-primary pull-left">
            <i class="fa fa-plus-circle"> Thêm</i>
        </a>
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách lịch học</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-hover " id="table_classes">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Ngày bắt đầu</th>
                        <th>Ngày kết thúc</th>
                        <th>Thứ</th>
                        <th>Ca</th>
                        <th>Địa điểm</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody id="table_classes">
                    <?php
                    $i = 1;
                    $weekdays = [1=>'Thứ 2',2=>'Thứ 3',3 =>'Thứ 4',4 =>'Thứ 5',5 =>'Thứ 6',6 =>'Thứ 7',7 =>'CN'];
                    ?>
                    @foreach($schedules as $schedule)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td><a href="{{ route('admin.classes.show', $class) }}">{{ $schedule->start_date }}</a></td>
                            <td>{{ $schedule->end_date }}</td>
                            <td>{{ $weekdays[$schedule->weekday]}}</td>
                            <td>{{$schedule->shift->name}}</td>
                            <td>{{$schedule->classroom->name}}</td>
                            <td>
                                @php( $start_date = \Carbon\Carbon::parse($schedule->start_date))
                                @if(!$start_date->isPast())
                                    <a href="{{ route('admin.schedule.edit', $schedule  ) }}" class="btn btn-success" {{ Auth::user()->role_id == 3 ? "disabled" : ""}}>
                                        <i class="fa fa-edit"></i> Sửa
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()

