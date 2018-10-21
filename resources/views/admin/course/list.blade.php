@extends('admin.layouts.index')
@section('content')
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30 padding-t-30">
        {{--   List Grade --}}
        <div class="form-group">
            <label for="group_class">Chọn trình độ:</label>
            <select class="form-control" id="group_class">
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
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Email</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>John</td>
                    <td>Doe</td>
                    <td>john@example.com</td>
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
                <tr>
                    <td>Mary</td>
                    <td>Moe</td>
                    <td>mary@example.com</td>
                    <td class="data-table-edit">
                        <a class="" href="#"><i class="fa fa-pencil"></i> Edit</a>
                    </td>
                    <td class="data-table-edit">
                        <a class="" href=""><i class="fa fa-pencil"></i> Detail</a>
                    </td>
                    <td class="data-table-delete">
                        <a onclick="if(!confirm('Are you sure?')) return false;" class=" red" href=""><i class="fa fa-trash-o"></i> Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>July</td>
                    <td>Dooley</td>
                    <td>july@example.com</td>
                    <td class="data-table-edit">
                        <a class="" href="#"><i class="fa fa-pencil"></i> Edit</a>
                    </td>
                    <td class="data-table-edit">
                        <a class="" href=""><i class="fa fa-pencil"></i> Detail</a>
                    </td>
                    <td class="data-table-delete">
                        <a onclick="if(!confirm('Are you sure?')) return false;" class=" red" href=""><i class="fa fa-trash-o"></i> Delete</a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection