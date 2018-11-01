@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        {{--   List Grade --}}

        <div class="panel panel-default rowlistClass ">
            <table class="table  table-hover">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1;?>
                @foreach($grades as $grade)

                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$grade->name}}</td>
                        <td class="data-table-edit">
                            <a class="" href="{{route('admin.grade.edit',$grade)}}"><i class="fa fa-pencil"></i> Edit</a>
                        </td>
                        <td class="data-table-edit">
                            <a class="" href=""><i class="fa fa-pencil"></i> Detail</a>
                        </td>
                        <td class="data-table-delete">
                            <a onclick="if(!confirm('Are you sure?')) return false;" class=" red" href=""><i class="fa fa-trash-o"></i> Delete</a>
                        </td>
                    </tr>
                    <?php $i++;?>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection