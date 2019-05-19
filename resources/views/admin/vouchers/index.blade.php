@extends('admin.layouts.index')

@section('content')

    <div class="post col-md-12 col-sm-12 col-xs-12 padding-r-l-30">
        <a href="{{ route('admin.voucher.create') }}" class="btn btn-primary pull-left">
            <i class="fa fa-plus-circle"> Create</i>
        </a>
        <div class="x_panel">

            <div class="x_title">
                <h2>Danh sách voucher</h2>
                <div class="clearfix"></div>

            </div>


            <div class="form-group">
                <div class="col-xs-3">
                    <form action="" method="get" id="myform" class="form-group">
                        <div class="form-group">
                            <label for="" class="">Chọn khóa học</label>
                            <select name="fil" onchange="submitForm();" id="voucher" class="form-control">
                                @foreach($vouchers as $voucher)
                                    <option value="{{$voucher->id}}" @if(isset($fil)){{$fil == $voucher->id ? "selected" : "" }} @endif>{{$voucher->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    <div class="form-group">
                        <button type="button" class="btn btn-success" id="btnDone">Đánh dấu tất cả là đã dùng</button>
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <table class="table table-hover" id="myTable">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Code</th>
                        <th>Value</th>
                        <th>State</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    ?>
                    @foreach($detailVouchers as $detailVoucher)
                        <tr>
                            <th scope="row">{{ $i++ }}</th>
                            <td>{{ $detailVoucher->code }}</td>
                            <td>{{ $detailVoucher->value }}%</td>
                            @if($detailVoucher->state==0)
                                <td>Chưa dùng</td>
                                <td>
                                    <form action="{{route('admin.voucher.updateDetailVoucher',$detailVoucher)}}" method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-info"
                                                onclick='return confirm("Bạn có chắc chắn rằng Voucher này đã được dùng ? ");'>
                                            <i class="fa fa-remove"></i> Đã dùng
                                        </button>
                                    </form>
                                </td>
                            @else
                                <td>Đã dùng</td>
                            @endif

                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="text-center">
                    {{ $detailVouchers->appends(request()->all())->links()}}
                </div>
            </div>
        </div>
    </div>


    <script>
        function submitForm() {
            $('#myform').submit();
        }
    </script>




@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('#btnDone').click(function () {
                confirm('Bạn có muốn đánh dấu tất cả là đã được đùng ?');
                voucher = $('#voucher').val();
                var url = "http://myenglish.test:8080/admin/voucher/update/"+voucher + '';
                location.replace(url);
            })

        })
    </script>
@endsection()