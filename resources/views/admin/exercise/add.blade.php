@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-8 col-sm-8 col-xs-12 padding-r-l-30 padding-t-30">

        {{--Tao bai tap--}}
        <form action="{{asset('admin/exercise/add')}}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="alert alert-success fade in alert-dismissible" id="Info" style="margin-top:18px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                Vui lòng chuẩn bị đáp án trước khi tạo bài tập.
            </div>
            <div class="form-group">
                <label for="list_grade">Chọn trình độ:</label>
                <select class="form-control" id="grade_id">
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
                <select class="form-control" id="style_exer" name="style_exer">
                    echo '';
                @foreach($style as $style)
                    @if($style->id==1)
                        <option value="{{$style->id}}" selected>{{$style->name}}</option>
                    @else
                        <option value="{{$style->id}}" >{{$style->name}}</option>
                    @endif
                @endforeach()
                </select>
            </div>
            <div class="name_exer form-group">
                <label for="tenbaitap">Chọn tên bài tập:</label>
                <input  type="text" class="form-control" name="tenbaitap" id="tenbaitap" >
            </div>
            <div class="alert alert-danger fade in alert-dismissible" id="checktitle">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                Tên bài tập không được rỗng
            </div>
            <div class="form-group">
                <label for="usr">Số phần của câu:</label>
                <select class="form-control" id="phan" name="past_of_exer">
                    <option value='1' selected>1</option>
                    <option value='2'>2</option>
                    <option value='3'>3</option>
                    <option value='4' >4</option>
                    <option value='4' >5</option>
                    <option value='4' >6</option>
                    <option value='4' >7</option>
                    <option value='4' >8</option>
                    <option value='4' >9</option>
                    <option value='4' >10</option>
                </select>
            </div>
            <div class="form-group input-group col-xs-5" id="socau">
                <div class=" input-group" id="phan1">
                    <span class="input-group-addon">Số câu phần 1</span>
                    <input id="socauphan1" type="text" class="form-control" name="socauphan1">
                </div>
            </div>
            <div class="alert alert-danger fade in alert-dismissible" id="checksocau">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                Số câu phải lớn hơn 0 hoặc không được bỏ rỗng.
            </div>
            <button type="button" class="btn btn-primary" id="tao">Tạo</button>



            <div class="answer-sheet" id="answer-sheet">

            </div>
            <button type="submit" class="btn btn-default" id="thuchien">Thực hiện</button>

        </form>

        <!-- end of tao bai tap -->

    </div>


@endsection()
@section('script')
    <script src="{{asset('admin_asset/js/Baitap/baitap.js')}}"></script>
@endsection()