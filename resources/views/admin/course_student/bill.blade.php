<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/admin_asset/css/styleAdmin.css')}}">

    @include('admin.layouts.css')
</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container" style="background-color: white">
        <!-- left_col -->

    <!-- end of left_col -->

        <!-- top navigation -->

    <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main" style="background-color: white">
            <!-- top tiles -->

            <!-- page content -->
            <div class="row">
                <!-- page center content -->
                <div class="post col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <h3 style="text-align: center">HÓA ĐƠN</h3>
                            <h5 style="text-align: center">Liên 2: giao khách hàng</h5>
                            @php( $date = \Carbon\Carbon::now()->toDateString())
                            <h5 style="text-align: center">Ngày: {{$date}} </h5>
                            <div style="margin-left: 70px">
                                <h5>Đơn vị: Trung tâm ngoại ngữ MYEL</h5>
                                <h5>Địa chỉ: Trường đại học giao thông vận tải.</h5>
                                <h5>Số điện thoại: 0326196129</h5>
                                <h5>Email: nguyenthanhat1997@gmail.com</h5>
                            </div>
                            <hr>
                            <div style="margin-left: 70px">
                                <h5>Họ và tên khách hàng: {{$user_course->user->username}}</h5>
                                <h5>Email: {{$user_course->user->email}}</h5>
                                <h5>Số điện thoại: {{$user_course->user->phone}}</h5>
                                <h5>Nội dung thanh toán: {{$user_course->course->name}}</h5>
                                <h5>Số tiền: {{$user_course->course->price}}</h5>
                                @if($user_course->voucher !=null)
                                    <h5>Mã giảm giá: {{$user_course->voucher->value}} </h5>
                                @else
                                    <h5>Mã giảm giá: Không có </h5>
                                @endif
                                <h5>Thành tiền: {{$user_course->total_amount}}</h5>
                            </div>
                            <hr>
                            <div style="margin-left: 100px">
                                <div style="float: right; margin-right: 100px;">
                                    <h2>Người thu</h2>
                                    <h5>(Ký, ghi rõ họ tên)</h5>
                                </div>
                                <div style="float:  left">
                                    <h2>Người nộp</h2>
                                    <h5>(Ký, ghi rõ họ tên)</h5>
                                </div>
                            </div>

                            <hr style="margin-top: 145px;">
                            <h3 style="text-align: center;">HÓA ĐƠN</h3>
                            <h5 style="text-align: center">Liên 1</h5>
                            @php( $date = \Carbon\Carbon::now()->toDateString())
                            <h5 style="text-align: center">Ngày: {{$date}} </h5>
                            <div style="margin-left: 70px">

                                <h5>Đơn vị: Trung tâm ngoại ngữ MYEL</h5>
                                <h5>Địa chỉ: Trường đại học giao thông vận tải.</h5>
                                <h5>Số điện thoại: 0326196129</h5>
                                <h5>Email: nguyenthanhat1997@gmail.com</h5>
                            </div>
                            <hr>
                            <div style="margin-left: 70px">
                                <h5>Họ và tên khách hàng: {{$user_course->user->username}}</h5>
                                <h5>Email: {{$user_course->user->email}}</h5>
                                <h5>Số điện thoại: {{$user_course->user->phone}}</h5>
                                <h5>Nội dung thanh toán: {{$user_course->course->name}}</h5>
                                <h5>Số tiền: {{$user_course->course->price}}</h5>
                                @if($user_course->voucher !=null)
                                    <h5>Mã giảm giá: {{$user_course->voucher->value}} </h5>
                                @else
                                    <h5>Mã giảm giá: Không có </h5>
                                @endif
                                <h5>Thành tiền: {{$user_course->total_amount}}</h5>
                            </div>
                            <hr>
                            <div style="margin-left: 100px">
                                <div style="float: right; margin-right: 100px;">
                                    <h2>Người thu</h2>
                                    <h5>(Ký, ghi rõ họ tên)</h5>
                                </div>
                            </div>
                            <hr style="margin-top: 130px">
                        </div>




                    </div>
                </div>

            <!-- end of page center content -->
            </div>
            <!-- and of page center content -->
            <br />
        </div>

        <!-- /page content -->


        <!-- footer content -->

        <!-- /footer content -->
    </div>
</div>
@include('admin.layouts.js')
<script src="{{asset('admin_asset/js/IndexAdmin/indexAdmin.js')}}"></script>
@yield('script')

</body>
</html>


