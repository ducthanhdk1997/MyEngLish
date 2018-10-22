@extends('admin.layouts.index')
@section('content')
<div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
    {{--giao bai tap--}}
    <form action="#" method="get" accept-charset="utf-8">
        <div class="form-group">
            <label for="group_class">Chọn trình độ:</label>
            <select class="form-control" id="group_class">
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
            <label for="style_exer">Chọn kiểu bài tập:</label>
            <select class="form-control" id="style_exer" name="idStyle">
                <option value="1" selected>day</option>
            </select>
        </div>

        <div class="form-group">
            <label for="exer">Chọn bài tập:</label>
            <select class="form-control" id="exer" name="idExer">
                <option value="1" selected>Bai1</option>
            </select>
        </div>

        <div class="form-group">
            <label for="group_class">Chọn lớp học:</label>

            <select class="form-control" id="list_class" name="class_id">
                <?php $i=1; ?>
                @foreach($class as $class)
                    @if($class->grade_id==1)
                        @if($i==1)
                            <option value="{{$class->id}}" selected>{{$class->name}}</option>'
                        @else
                            <option value="{{$class->id}}">{{$class->name}}</option>'
                        @endif
                    @endif
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