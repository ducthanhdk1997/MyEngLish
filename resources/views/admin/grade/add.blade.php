@extends('admin.layouts.index')
@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        @if(count($errors)>0)
            <div class="alert alert-danger fade in alert-dismissible" id="Info" style="margin-top:18px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                @foreach($errors->all() as $err)
                    {{$err}}<br>
                @endforeach
            </div>
        @endif

        @if(session('message'))
            <div class="alert alert-success fade in alert-dismissible" id="Info" style="margin-top:18px;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                {{session('message')}}
            </div>
        @endif
        <form action="{{asset('admin/grade/add')}}" method="POST">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <div class="input-group new_grade">
                <span class="input-group-addon">Tên trình độ:</span>
                <input id="namegrade" type="text" class="form-control name_grade" name="name">
            </div>
            <button type="submit" class="btn btn-primary btnGroupGrade ">Thêm</button>
        </form>
    </div>
    {{-- end of new class --}}

@endsection()