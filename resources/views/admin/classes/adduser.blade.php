@extends('admin.layouts.index')
@section('content')
{{-- add user --}}
<div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30"> 
  <form action="" method="GET">
    <div class="form-group">
      <label for="group_class">Chọn trình độ:</label>
      <select class="form-control" id="group_class" name="IdGroup">
      	<option value="1" selected>A1</option>'
      </select>
    </div>
    <div class="form-group">
      <label for="group_class">Chọn lớp học:</label>
      <select class="form-control" id="group_class" name="IdGroup">
        <option value="1" selected>A1_01</option>'
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