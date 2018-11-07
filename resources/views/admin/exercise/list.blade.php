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
        <div class="form-group">
            <label for="group_class">Chọn kiểu bài tập:</label>
            <select class="form-control" id="style" name="style_id">
                <?php  $i=1; ?>
                @foreach ($style as $style)
                    @if($i==1)
                        <option value="{{$style->id}}" selected>{{$style->name}}</option>
                    @else
                        <option value="{{$style->id}}">{{$style->name}}</option>
                    @endif
                    <?php $i++ ?>
                @endforeach
            </select>
        </div>
        <div class="panel panel-default rowlistClass ">

            <table class="table  table-hover">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên bài tập</th>
                    <th>Số phần</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="exercises">
                    <?php $i=1;?>
                    @foreach($exercises as $exercise)
                        @if($exercise->grade_id==1 && $exercise->style_id ==1)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$exercise->name}}</td>
                            <td>{{$exercise->num_part}}</td>
                            <td></td>
                            <td class="data-table-edit">
                                <a class="" href="{{route('admin.exercise.edit',$exercise)}}"><i class="fa fa-pencil"></i> Edit</a>
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
            $('#grades').change(function () {
                var grade_id = $(this).val();
                var style_id = $('#style').val();
                $.get("{{asset('admin/ajax/exercisetypetable')}}"+"/"+grade_id+"/"+style_id,function (data2) {
                    $('#exercises').html(data2);
                })
            })
            $('#style').change(function () {
                var style_id = $(this).val();
                var grade_id = $('#grades').val();
                $.get("{{asset('admin/ajax/exercisetypetable')}}"+"/"+grade_id+"/"+style_id,function (data3) {
                    $('#exercises').html(data3);
                })
            })
        })
    </script>
@endsection