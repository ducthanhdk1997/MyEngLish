@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary pull-left">
            <i class="fa fa-plus-circle"> Thêm</i>
        </a>
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách giảng viên</h2>
                <div class="clearfix"></div>
            </div>
            <div class="form-group">
                <div class="col-sm-3">
                    <input class="form-control" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for username.." title="Type in a title">
                </div>
            </div>
            </br>
            </br>
            </br>
            </br>
            </br>
            <div class="x_content">
                <table class="table table-hover" id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Chức vụ</th>
                            <th>Trình độ</th>
                            <th>Các lớp đã dạy</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                        ?>
                        @foreach($teachers as $teacher)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $teacher->username }}</td>
                                <td>{{ $teacher->email }}</td>
                                <td>{{ $teacher->phone }}</td>
                                <td>{{ $teacher->role->name }}</td>
                                <td>{{$teacher->level}}</td>
                                <td>
                                    @php
                                        $classes = $teacher->clas()->get();
                                    @endphp
                                    @foreach($classes as $class)
                                        {{$class->name}} @if($class->state == 0)- chưa xong @else - đã xong @endif
                                        </br>
                                        @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-success" >
                                        <i class="fa fa-edit"></i> Sửa
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $teachers->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

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

@endsection()