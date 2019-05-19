@extends('admin.layouts.index')

@section('content')
    {{-- new grade --}}
    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <div class="x_panel">
            <div class="x_title">
                <h2>Thêm Voucher</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <form class="form-horizontal" action="{{ route('admin.voucher.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Chủ đề</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" value="{{old('name')}}" placeholder="Chủ đề">
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label col-md-2 col-sm-2 col-xs-12">Input Tags: "10%-20" = 10% 20 cái</label>
                        <div class="col-md-10 col-sm-10 col-xs-12">
                            <input id="tags_1" type="text" name="tag" class="tags form-control" value="10%-20" />
                            <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Create</button>
                            <a href="{{ route('admin.voucher.index') }}" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Quay lại</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end of new class --}}

@endsection()

@section('script')
    <script>
        $(document).ready(function () {

        })
    </script>

@endsection()