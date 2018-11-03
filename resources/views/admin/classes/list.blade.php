@extends('admin.layouts.index')
@section('content')
<div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
	{{--   Giao bai tap --}}
	<div class="form-group">
		<label for="group_class">Chọn trình độ:</label>
		<select class="form-control" id="grades">
			 @foreach ($grades as $grade)
				@if($grade['ID']==1)
					<option value="{{$grade->id}}" selected>{{$grade->name}}</option>
				@else
					<option value="{{$grade->id}}">{{$grade->name}}</option>
				@endif
			@endforeach
		</select>
	</div>
	<div class="panel panel-default rowlistClass ">
		<table class="table  table-hover">
			<thead>
				<tr>
					<th>STT</th>
					<th>Tên lớp</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody id="list_class">
			<?php $i=1;?>
			@foreach($class as $class)
				@if($class->grade_id==1)
				<tr>
					<td>{{$i}}</td>
					<td>{{$class->name}}</td>
					<td class="data-table-edit">
						<a class="" href="{{route('admin.class.edit',$class)}}"><i class="fa fa-pencil"></i> Edit</a>
					</td>
					<td class="data-table-edit">
						<a class="" href=""><i class="fa fa-pencil"></i> Detail</a>
					</td>
					<td class="data-table-delete">
						<a onclick="if(!confirm('Are you sure?')) return false;" class=" red" href=""><i class="fa fa-trash-o"></i> Delete</a>
					</td>
				</tr>
				<?php $i++?>
				@endif
			@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('script')
	<script>
		$(document).ready(function () {
			$('#grades').change(function () {
				var grade_id = $(this).val();

				$.get("{{asset('admin/ajax/classtypetable')}}"+"/"+grade_id,function (data) {
					$('#list_class').html(data)
                });
            });
        });
	</script>
@endsection()