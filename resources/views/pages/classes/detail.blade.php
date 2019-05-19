@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="page-title">

    </div>
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">


        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách điểm</h2>
                <div class="clearfix"></div>
            </div>

            <br>
            <br>
            <div class="x_content">
                <table class="table table-hover " id="table_classes">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên bài tập</th>
                        <th>Điểm</th>
                    </tr>
                    </thead>
                    <tbody id="table_classes">
                    <?php
                    $i = 1;
                    ?>
                    <tr>
                        @if($exam_result !=null)
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{$exam_result->exam->title}}</td>
                            <td>{{$exam_result->score}}</td>
                        @endif
                    </tr>
                    @foreach($test_results as $test_result)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{$test_result->test->title}}</td>
                            <td>{{$test_result->score}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()

@section('script')
    <script>
        // $(document).ready(function () {
        //     $('#courses').change(function () {
        //         var course_id = $(this).val();
        //         var url = "http://myenglish.test:8080/admin/classes/"+course_id + '';
        //         location.replace(url);
        //     })
        // })
    </script>
    <script>
        function submitForm() {
            $('#myform').submit();
        }
    </script>
@endsection()

