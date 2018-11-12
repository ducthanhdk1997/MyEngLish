@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-8 col-sm-8 col-xs-12 padding-r-l-30 padding-t-30">
        <form action="{{route('admin.exercises.store')}}" method="POST" enctype="multipart/form-data" class="form-horizontal">
            @csrf
            <div class="form-group">
                <label class="col-sm-2 control-label">Chọn trình độ</label>
                <div class="col-sm-10">
                    <select name="grade" id="" class="form-control">
                        @foreach($grades as $grade)
                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Tên</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="Nhập tên bài tập">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">Chọn file</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="file_excel">
                </div>
            </div>
            <div class="col-sm-10 col-sm-offset-2">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>

        <!-- end of tao bai tap -->

    </div>


@endsection()
{{--@section('script')--}}
    {{--<script src="{{asset('admin_asset/js/Baitap/baitap.js')}}"></script>--}}
{{--@endsection()--}}