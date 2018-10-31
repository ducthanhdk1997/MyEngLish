@extends('admin.layouts.index')
@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        <form action="" method="GET">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
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
                <label for="group_class">Tên khóa học:</label>
                <input id="nameclass" type="text" class="form-control " id="name_course" name="name">
            </div>

            <div class="form-group">
                <label for="group_class">Giá:</label>
                <input id="nameclass" type="text" class="form-control" id="price" name="price">
            </div>
            <div class="form-group">
                <label for="ex">Start</label>
                <input class="form-control" id="start" type="date" name="start" min="">
            </div>
            <div class="form-group">
                <label for="ex">End</label>
                <input class="form-control" id="end" type="date" name="end" min="">
            </div>
            <div class="form-group">
                <label for="group_class">Mô tả:</label>
                <textarea   class="form-control " id="describe" rows="5" name="describe"> </textarea>
            </div>
            <button type="submit" class="btn btn-primary btnGroupClass ">Thêm</button>
        </form>
    </div>
    {{-- end of new class --}}

@endsection()