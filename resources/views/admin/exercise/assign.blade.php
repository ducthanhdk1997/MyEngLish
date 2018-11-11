@extends('admin.layouts.index')
@section('content')
<div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
    {{--giao bai tap--}}
    <form action="{{route('admin.exercise.assign')}}" method="post" accept-charset="utf-8">
        @csrf
        <div class="form-group">
            <label for="group_class">Chọn trình độ:</label>
            <select class="form-control" id="grades" name="grade_id">
                <?php $i=1; $grade_f = 0; ?>
                @foreach ($grades as $grade)
                    @if($i==1)
                        <option value="{{$grade->id}}" selected>{{$grade->name}}</option>
                        <?php  $grade_f = $grade->id; ?>
                    @else
                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                    @endif
                    <?php $i++;?>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exer">Chọn bài tập:</label>
            <select class="form-control" id="exer" name="exercise_id">
                <?php $i=1; ?>
                @foreach($exercises as $exercise)
                    @if($exercise->grade_id==$grade_f)
                        @if($i==1)
                            <option value="{{$exercise->id}}" selected>{{$exercise->name}}</option>
                        @else
                            <option value="{{$exercise->id}}">{{$exercise->name}}</option>
                        @endif
                    @endif
                    <?php $i++; ?>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="group_class">Chọn lớp học:</label>

            <select class="form-control" id="classes" name="class_id">
                <?php $i=1; ?>
                @foreach($class as $class)
                    @if($class->grade_id==$grade_f)
                        @if($i==1)
                            <option value="{{$class->id}}" selected>{{$class->name}}</option>'
                        @else
                            <option value="{{$class->id}}">{{$class->name}}</option>'
                        @endif
                    @endif
                    <?php $i++; ?>
                @endforeach
            </select>
        </div>

        <div class="form-group row">
            <div class="col-xs-6">
                <label for="ex">Hạn bài tập</label>
                <input class="form-control" id="ex3" type="date" name="date" min="">
            </div>
            <div class="col-xs-6">
                <label for="ex3">Chọn giờ</label>
                <input class="form-control" id="ex4" type="time" name="time" >
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Giao</button>
    </form>
</div>


@endsection()

@section('script')
    <script>
        $(document).ready(function () {
            $('#grades').change(function () {
                var grade_id = $(this).val();
                $.get("{{asset('admin/ajax/classtypeselect')}}"+"/"+grade_id,function (data) {
                    $('#classes').html(data);
                });
                $.get("{{asset('admin/ajax/exercise')}}"+"/"+grade_id,function (data2) {
                    var html = '';
                    var i=1;
                    data2.forEach(function (element) {
                        if(i==1)
                        {
                            html+=`<option value="${element.id}" selected>${element.name}</option>`;
                        }
                        else
                        {
                            html+=`<option value="${element.id}">${element.name}</option>`;
                        }
                        i++;
                    })
                    $('#exer').html(html);
                })
            })
        })
    </script>
@endsection()