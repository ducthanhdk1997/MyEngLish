@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        {{--   List Exercise --}}
        <div class="form-group">
            <label for="group_class">Chọn trình độ:</label>
            <select class="form-control" id="grades" name="grade_id">
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
                    <th>ID</th>
                    <th>Tên bài tập</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="exercises">
                    @foreach($exercises as $exercise)
                        @if($exercise->grade_id==1)
                        <tr>
                            <td>{{$exercise->id}}</td>
                            <td>{{$exercise->name}}</td>
                            <td class="data-table-edit">
                                <a href="{{ route('admin.exercise.edit',$exercise) }}" class="btn btn-success">
                                    <i class="fa fa-edit"></i>Edit
                                </a>
                                <a href="{{route('admin.exercise.show',$exercise)}}" class="btn btn-success">
                                    <i class=" fa fa-angle-double-right"></i>Detail
                                </a>
                                <a class="btn btn-info" href="{{route('admin.question.create',$exercise)}}"><i class="fa fa-plus"></i> Add</a>
                                <form action="" method="post" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-remove"></i> Xóa
                                    </button>
                                </form>
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
            $('#grades').change(function () {
                var grade_id = $(this).val();
                var html = '';
                var token = $('meta[name="csrf-token"]').attr('content');
                $.get("{{asset('admin/ajax/exercise')}}"+"/"+grade_id,function (data2) {
                    data2.forEach(function (element) {
                        html+=`<tr>
                            <td>${element.id}</td>
                            <td>${element.name}</td>
                            <td class="data-table-edit">
                                <a href="/admin/exercise/${element}/edit" class="btn btn-success">
                                    <i class="fa fa-edit"></i>Edit
                                </a>
                                <a class="btn btn-info" href="/admin/question/${element}/create"><i class="fa fa-plus"></i> Add</a>
                                <form action="" method="post" style="display: inline">
                                <input type="hidden" name="_token" value="${token}">
                                <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-remove"></i> Xóa
                            </button>
                        </form>

                    </td>

                </tr>`
                    })
                    $('#exercises').html(html);
                });

            })
        })
    </script>
@endsection