@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="page-title">
        <div class="title_right pull-right">
            <div class="form-group pull-right top_search">
                <div class="input-group">
                    <div class="input-group">
                        <form action="{{ route('admin.users.search') }}" method="get" style="display: inherit;border-radius: 25px 0 0 25px">
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
            <form action="{{ route('admin.classes.import', $class) }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="">Upload:</label>
                <input type="file" class="form-control" style="width: 400px;display: inline" name="file-excel">
                <button type="submit" class="btn btn-primary" style="margin-bottom: 5px">Submit</button>
            </form>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h2>Danh sách học sinh</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên học viên</th>
                            <th>Email</th>
                            <th>Số điện thoai</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        ?>
                        @foreach($usersClass as $item)
                            <tr style="height: 50px;">
                                <td>{{ $i++ }}</td>
                                <td>{{ optional($item->user)->username }}</td>
                                <td>{{ optional($item->user)->email }}</td>
                                <td>{{ optional($item->user)->phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $usersClass->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()