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
		<a href="{{ route('admin.classes.create') }}" class="btn btn-primary pull-left">
			<i class="fa fa-plus-circle"> Create</i>
		</a>
		<div class="x_panel">
			<div class="x_title">
				<h2>Danh sách học viên</h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-hover">
					<thead>
					<tr>
						<th>#</th>
						<th>Tên lớp</th>
						<th>Khóa học</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>
                    <?php
                    $i = 1;
                    ?>
					@foreach($classes as $class)
						<tr>
							<th scope="row">{{ $i++ }}</th>
							<td><a href="{{ route('admin.classes.show', $class) }}">{{ $class->name }}</a></td>
							<td>{{ $class->grade->name }}</td>
							<td>
								<a href="{{ route('admin.classes.edit', $class) }}" class="btn btn-success" {{ Auth::user()->role_id == 4 ? "disabled" : ""}}>
									<i class="fa fa-edit"></i> Sửa
								</a>
								<form action="{{ route('admin.classes.delete', $class) }}" method="post" style="display: inline">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-danger" {{ Auth::user()->role_id == 4 ? "disabled" : ""}} onclick='return confirm("Bạn có muốn xóa " + "\"" + "{{ $class->name }}" + "\"");'>
										<i class="fa fa-remove"></i> Xóa
									</button>
								</form>
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