@extends('admin.layouts.index')
@section('content')
{{-- new class --}}
<div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30"> 
  <form action="" method="GET">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="form-group">
      <label for="group_class">Chọn trình độ:</label>
      <select class="form-control" id="group_class" name="IdGroup">
          @foreach ($grades as $grade)
              @if($grade['ID']==1)
                  <option value="{{$grade->id}}" selected>{{$grade->name}}</option>
              @else
                  <option value="{{$grade->id}}">{{$grade->name}}</option>
              @endif
          @endforeach
      </select>
    </div>
    <div class="input-group new_class">
      <span class="input-group-addon">Tên lớp:</span>
      <input id="nameclass" type="text" class="form-control name_class" name="nameclass">
    </div>
    <button type="submit" class="btn btn-primary btnGroupClass ">Thêm</button>
  </form>
</div>
{{-- end of new class --}}

@endsection()