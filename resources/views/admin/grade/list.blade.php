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
                            <a class="btn btn-success" href="{{route('admin.grade.edit',$grade)}}"><i class="fa fa-pencil"></i> Edit</a>

                            <form action="{{ route('admin.grade.delete', $grade) }}" method="post" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" {{ Auth::user()->role_id == 4 ? "disabled" : ""}} onclick='return confirm("Bạn có muốn xóa " + "\"" + "{{ $grade->name }}" + "\"");'>
                                    <i class="fa fa-remove"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php $i++;?>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection