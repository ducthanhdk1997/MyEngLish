@extends('admin.layouts.index')
@section('content')
    {{-- add user --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        <form action="" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="form-group">
                <label for="group_class">Chọn trình độ:</label>
                <select class="form-control" id="grades" name="grade_id">
                    @foreach ($grades as $grade)
                        @if($grade['ID']==1)
                            <option value="{{$grade->id}}" selected>{{$grade->name}}</option>
                        @else
                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="group_class">Chọn lớp học:</label>

                <select class="form-control" id="list_class" name="class_id">
                    <?php $i = 1; ?>
                    @foreach($class as $class)
                        @if($class->grade_id==1)
                            @if($i==1)
                                <option value="{{$class->id}}" selected>{{$class->name}}</option>
                            @else
                                <option value="{{$class->id}}">{{$class->name}}</option>
                            @endif
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group form-group-sm">
                <label class="col-sm-1 control-label" for="sm">Username</label>
                <div class="col-sm-3">
                    <input class="form-control" type="text" id="sm">
                </div>
            </div>
            <div class="form-group" style="clear: both;">
                <button type="submit" class="btn btn-primary btnGroupClass ">Thêm</button>
            </div>
        </form>
    </div>
    {{-- end of add user --}}

@endsection()

@section('script')
    <script>
        $(document).ready(function () {
            var grade_id;
            var class_id;
            $('#grades').change(function () {
                grade_id = $(this).val();
                $.get("{{asset('admin/ajax/class_type_select')}}" + "/" + grade_id, function (data) {

                    $('#list_class').html(data)
                });
            })
        })
    </script>
@endsection()