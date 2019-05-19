@extends('admin.layouts.index')

@section('content')
	{{-- new grade --}}

	<div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
		<div class="form-group">
			<label for="group_class">Chọn khóa học:</label>
            <form action="" method="get" id="myform" class="form-group">
                <select class="form-control" id="courses" name="filter" onchange="submitForm();" >
                    @foreach ($courses as $cours)
                        <option value="{{$cours->id}}" @if(isset($filter)){{$filter == $cours->id ? "selected" : "" }} @endif> {{$cours->name}}</option>
                    @endforeach
                </select>
            </form>
		</div>
        @if(Auth::user()->role_id == 1)
            <a href="{{ route('admin.classes.create') }}" class="btn btn-primary pull-left">
                <i class="fa fa-plus-circle"> Create</i>
            </a>
        @endif
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
						<th>Lịch học</th>
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
								@php $i =1;
								$weekdays = [1=>'Thứ 2',2=>'Thứ 3',3 =>'Thứ 4',4 =>'Thứ 5',5 =>'Thứ 6',6 =>'Thứ 7',7 =>'CN'];
								@endphp
								@foreach($scheduleclass as $sc)
									@if($sc->class_id == $class->id)
										<p>Từ {{$sc->start_date}} đến {{$sc->end_date}} ({{$i++}})</p>
										<p>{{$weekdays[$sc->weekday]}} {{$sc->shift->name}} {{$sc->classroom->name}}</p>
									@endif
								@endforeach
							</td>
							<td>
								<a href="{{ route('admin.classes.edit', $class) }}" class="btn btn-success">
									<i class="fa fa-edit"></i> Sửa
								</a>
							</td>
							<td>
								<a href="{{ route('admin.classes.schedule', $class) }}" class="btn btn-success">
									<i class="fa fa-edit"></i> Lịch học
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
    <script>
        function submitForm() {
            $('#myform').submit();
        }
    </script>

@endsection()

@section('script')
	{{--<script>--}}
        {{--$(document).ready(function () {--}}
            {{--$('#courses').change(function () {--}}
                {{--var course_id = $(this).val();--}}
                {{--var url = "http://myenglish.test:8080/admin/classes/"+course_id + '';--}}
                {{--location.replace(url);--}}
            {{--})--}}
        {{--})--}}
	{{--</script>--}}
@endsection()

