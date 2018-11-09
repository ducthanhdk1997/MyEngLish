@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        {{--   Giao bai tap --}}
        <div class="panel panel-default rowlistClass ">
            <table class="table  table-hover">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Kiểu</th>
                    <th>Số phần</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody id="list_class">
                <?php $i=1;?>
                @foreach($style_exercises as $style_exercise)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$style_exercise->name}}</td>
                        <td>{{$style_exercise->num_part}}</td>
                        <td class="data-table-edit">
                            <a class="" href="{{route('admin.style_exercise.edit',$style_exercise)}}"><i class="fa fa-pencil"></i> Edit</a>
                        </td>
                        <td class="data-table-delete">
                            <a onclick="if(!confirm('Are you sure?')) return false;" class=" red" href=""><i class="fa fa-trash-o"></i> Delete</a>
                        </td>
                    </tr>
                    <?php $i++?>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection()