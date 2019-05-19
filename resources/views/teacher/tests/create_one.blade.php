@extends('admin.layouts.index')

@section('content')

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">

        <div class="x_panel">

            <div class="x_title">
                <h2>Cập nhật điểm trong lớp {{$class->name}}</h2>
                <div class="clearfix"></div>
            </div>

            <div class="form-group">
                <form action="{{route('teacher.test.store_one',$class)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail3" class=" control-label">Chọn bài tập:</label>
                        <select name="test" id="test"  class="form-control">
                            @foreach($tests as $test)
                                <option value="{{$test->id}}" >{{$test->title}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class=" control-label">Mã sinh viên hoặc Email</label>
                        <input type="text" class="form-control" id="msv" name="msv" value="{{ old('msv') }}" placeholder="Mã sinh viên hoặc Email" >
                    </div>
                    <label for="inputEmail3" class=" control-label"></label>
                    <div class="form-group">
                        <label for="inputEmail3" class=" control-label">Điểm số</label>
                        <input type="text" class="form-control" id="score" name="score" value="{{ old('score') }}" >
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="margin-bottom: 5px">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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
                var class_id = $('#classes').val();
                var title = $('#title').val();
                var url = "http://myenglish.test:8080/teacher/test/export/"+class_id + '/' + title + '';
                location.replace(url);
            })

        })
    </script>
@endsection()