@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-8 col-sm-8 col-xs-12 padding-r-l-30 padding-t-30">

        {{--Tao bai tap--}}
        <form action="{{route('admin.exercise.create')}}" method="POST">
            @csrf
            <div class="form-group">
                <label for="list_grade">Chọn trình độ:</label>
                <select class="form-control" id="grade_id" name="grade_id">
                    @foreach ($grades as $grade)
                        @if($grade['ID']==1)
                            <option value="{{$grade->id}}" selected>{{$grade->name}}</option>
                        @else
                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="input-group new_grade">
                <span class="input-group-addon">Tên bài tập:</span>
                <input id="namegrade" type="text" class="form-control name_grade" name="name">
            </div>

            <button type="submit" class="btn btn-default" id="thuchien">Thực hiện</button>

        </form>

        <!-- end of tao bai tap -->

    </div>


@endsection()
{{--@section('script')--}}
    {{--<script src="{{asset('admin_asset/js/Baitap/baitap.js')}}"></script>--}}
{{--@endsection()--}}