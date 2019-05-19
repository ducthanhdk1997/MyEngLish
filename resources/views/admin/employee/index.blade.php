@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <a href="{{ route('admin.employee.create') }}" class="btn btn-primary pull-left">
            <i class="fa fa-plus-circle"> Create</i>
        </a>
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách nhân viên</h2>
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
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                        ?>
                        @foreach($employees as $employee)
                            <tr>
                                <th scope="row">{{ $i++ }}</th>
                                <td>{{ $employee->username }}</td>
                                <td>{{ $employee->email }}</td>
                                <td>{{ $employee->phone }}</td>
                                <td>{{ $employee->role->name }}</td>

                                <td>
                                    <form action="{{ route('admin.employee.delete', $employee) }}" method="post" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" {{ Auth::user()->role_id != 1 ? "disabled" : ""}} onclick='return confirm("Bạn có muốn xóa " + "\"" + "{{ $employee->username }}" + "\"");'>
                                    <i class="fa fa-remove"></i> Xóa
                                    </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $employees->links() }}
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