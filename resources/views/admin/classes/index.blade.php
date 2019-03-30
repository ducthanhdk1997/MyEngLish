@extends('admin.layouts.index')

@section('content')
	{{-- new grade --}}
	<div class="page-title">
		<div class="title_right pull-right">

			<div class="form-group pull-right top_search">
				<div class="input-group">
					<div class="input-group">
						<form action="{{ route('admin.students.search') }}" method="get" style="display: inherit;border-radius: 25px 0 0 25px">
							{{--@csrf--}}
							<input type="text" class="form-control" placeholder="Search for..." name="key">
							<span class="input-group-btn">
                                <button class="btn btn-default" type="submit">Go!</button>
                            </span>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
		<div class="form-group">
			<label for="group_class">Chọn khóa học:</label>
			<select class="form-control" id="courses" name="course_id">
				<a href="{{route('admin.classes.index')}}">
					<option value="-1"> All</option></a>

				@foreach ($courses as $cours)
						@if($cours->id == $course_id)
							<option value="{{$cours->id}}" selected> {{$cours->name}}</option>
						@else
							<option value="{{$cours->id}}"> {{$cours->name}}</option>
						@endif

				@endforeach
			</select>
		</div>
		<a href="{{ route('admin.classes.create') }}" class="btn btn-primary pull-left">
			<i class="fa fa-plus-circle"> Create</i>
		</a>
		<div class="x_panel">
			<div class="x_title">
				<h2>Danh sách lớp học</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-hover " id="table_classes">
					<thead>
					<tr>
						<th>#</th>
						<th>Tên lớp</th>
						<th>Tên giảng viên</th>
						<th>Khóa học</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody id="table_classes">
                    <?php
                    $i = 1;
                    ?>
					@foreach($classes as $class)
						<tr>
							<th scope="row">{{ $i++ }}</th>
							<td><a href="{{ route('admin.classes.show', $class) }}">{{ $class->name }}</a></td>
							<td>{{ $class->teacher->username }}</td>
							<td>{{ $class->course->name }}</td>
							<td>
								<a href="{{ route('admin.classes.edit', $class) }}" class="btn btn-success" {{ Auth::user()->role_id == 3 ? "disabled" : ""}}>
									<i class="fa fa-edit"></i> Sửa
								</a>
							</td>
						</tr>
					@endforeach
					</tbody>
				</table>
				<div class="text-center">
					{{ $classes->links() }}
				</div>
			</div>
		</div>
	</div>
	{{-- end of new class --}}

@endsection()

@section('script')
	<script>
        $(document).ready(function () {
            $('#courses').change(function () {
                var course_id = $(this).val();
                var url = "http://myenglish.test:8080/admin/classes/"+course_id + '';
                location.replace(url);
            })
        })
	</script>
@endsection()

@