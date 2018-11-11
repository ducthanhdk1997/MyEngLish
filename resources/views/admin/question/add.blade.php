@extends('admin.layouts.index')
@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">

        <form action="{{route('admin.question.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
                <span class="input-group-addon">Chọn bài tập:</span>
                <input type="file" class="form-control" name="my-file" id="myfile">
            </div>
            <button type="submit" class="btn btn-primary btnGroupGrade ">Thêm</button>
        </form>
    </div>
    {{-- end of new class --}}

@endsection()