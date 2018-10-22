@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        {{--   List Grade --}}
        <div class="form-group">
            <label for="grade">Chọn trình độ:</label>
            <select class="form-control" id="list_grade">
                @foreach ($grades as $grade)
                    @if($grade['ID']==1)
                        <option value="{{$grade->id}}" selected>{{$grade->name}}</option>
                    @else
                        <option value="{{$grade->id}}">{{$grade->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="panel panel-default rowCourse ">
            <table class="table  table-hover">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Actua End</th>
                    <th>Describe</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="list_course">
                <?php $i=1; ?>
                @foreach($courses as $cours)
                    @if($cours->grade_id==1)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$cours->name}}</td>
                            <td>{{$cours->time_start}}</td>
                            <td>{{$cours->time_end}}</td>
                            <td>{{$cours->actua_end_date}}</td>
                            <td>{{$cours->describe}}</td>
                            <td>{{$cours->price}}</td>

                            <td class="data-table-edit">
                                <a class="" href=""><i class="fa fa-pencil"></i> Edit</a>
                            </td>
                            <td class="data-table-edit">
                                <a class="" href=""><i class="fa fa-pencil"></i> Detail</a>
                            </td>
                            <td class="data-table-delete">
                                <a onclick="if(!confirm('Are you sure?')) return false;" class=" red" href=""><i class="fa fa-trash-o"></i> Delete</a>
                            </td>
                        </tr>
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
            $('#list_grade').change(function () {
                var grade_id = $(this).val();

                $.get("{{asset('admin/ajax/course_type_table')}}"+"/"+grade_id,function (data) {
                    $('#list_course').html(data)
                });
            })
        })
    </script>
@endsection()