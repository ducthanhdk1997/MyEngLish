@extends('admin.layouts.index')

@section('content')

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">

        <div class="x_panel">
            <div class="title_right pull-right">
                <div class="form-group pull-right top_search">
                    <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for title.." title="Type in a title">
                </div>
            </div>
            <div class="x_title">
                <h2>Danh sách lớp của bạn</h2>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <div class="col-xs-3">
                    <form action="" method="get" id="myform" class="form-group">
                        <select name="filter" onchange="submitForm();" class="form-control">
                            <option value="-1" @if(isset($filter)){{$filter == -1 ? "selected" : "" }} @endif >All </option>
                            <option value="1" @if(isset($filter)){{$filter == 1 ? "selected" : "" }} @endif >Chưa xong </option>
                            <option value="2" @if(isset($filter)){{$filter == 2 ? "selected" : "" }} @endif >Đã xong </option>
                        </select>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-hover" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Khóa học</th>
                        <th>Lịch học</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($classes as $class)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td><a href="{{route('teacher.class.detail',$class)}}">{{ $class->name }}</a></td>
                            <td>{{$class->course->name}}</td>
                            <td>
                                @php $i =1;
								$weekdays = [1=>'Thứ 2',2=>'Thứ 3',3 =>'Thứ 4',4 =>'Thứ 5',5 =>'Thứ 6',6 =>'Thứ 7',7 =>'CN'];
                                $scheduleclass = $class->schedule()->get();
                                @endphp
                                @foreach($scheduleclass as $sc)
                                    @if($sc->class_id == $class->id)
                                        <p>Từ {{$sc->start_date}} đến {{$sc->end_date}} ({{$i++}})</p>
                                        <p>{{$weekdays[$sc->weekday]}} {{$sc->shift->name}} {{$sc->classroom->name}}</p>
                                    @endif
                                @endforeach

                            </td>
                            @if($class->state==0)
                                <td>Chưa xong</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-upload"></i>
                                             Lên điểm <span class="caret"></span></button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li><a href="{{route('teacher.test.create',$class)}}">Upload File Excel</a></li>
                                            <li><a href="{{route('teacher.test.create_one',$class)}}">Thông thường</a></li>
                                        </ul>
                                    </div>
                                </td>
                            @else
                                <td>Đã xong</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $classes->appends(request()->all())->links()}}
                </div>
            </div>
        </div>
    </div>

    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>

    <script>
        function submitForm() {
            $('#myform').submit();
        }
    </script>
@endsection