@extends('admin.layouts.index')

@section('content')

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">

        <div class="x_panel">

            <div class="x_title">
                <h2>Cập nhật điểm cho lớp: {{$class->name}}</h2>
                <div class="clearfix"></div>
            </div>

            <div class="form-group">
                <form action="{{route('teacher.test.store',$class)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail3" class=" control-label">Tên bài tập</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" placeholder="Tên bài tập" >
                    </div>
                    <div class="form-group">
                        <label class="" for="">Upload điểm:</label>
                        <input type="file" class="form-control"  name="file">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="margin-bottom: 5px">Submit</button>

                        <button type="button" class="btn btn-primary" id="btnExport" style="margin-bottom: 5px">Tải Excel mẫu</button>
                    </div>
                </form>
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

@section('script')
    <script>
        $(document).ready(function () {
            $('#btnExport').click(function () {
                var class_id = '{{$class->id}}';
                var title = $('#title').val();
                if(title == '')
                {
                    alert('Tên bài tập rỗng!');
                    return;
                }
                var url = "http://myenglish.test:8080/teacher/test/export/"+class_id + '/' + title + '';
                location.replace(url);
            })

        })
    </script>
@endsection()