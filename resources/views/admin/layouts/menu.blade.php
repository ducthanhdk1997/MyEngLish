<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="" alt="..." class="img-circle profile_img">
            </div>

            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->username }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                    <li><a href="{{route('admin.home.index')}}"><i class="fa fa-table"></i>Trang chủ</a>
                    </li>
                    <li><a><i class="fa fa-home"></i>Giao diện<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.courses.create')}}">Thêm mới khóa học</a></li>
                            <li><a href="{{route('admin.courses.index')}}">Danh sách khóa học</a></li>
                            <li><a href="{{route('admin.courses.index')}}">Đăng ký học</a></li>
                            <li><a href="{{route('admin.courses.index')}}">Đặt cọc</a></li>
                            <li><a href="{{route('admin.courses.index')}}">Giao diện chuyển lớp,bảo lưu</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-home"></i>Quản lý khách hàng<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.courses.index')}}">Lưu ghi chú tư vấn</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-desktop"></i>Quản lý lớp học<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.classes.index')}}">Danh sách lớp học</a></li>
                            <li><a href="{{route('admin.classes.create')}}">Mở lớp học</a></li>
                            <li><a href="{{route('admin.classes.create')}}">Thời khóa biểu tuần</a></li>
                            <li><a href="{{route('admin.classes.create')}}">Thời khóa biểu ngày</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i>Quản lý test <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="">Đăng lý làm bài test</a></li>
                            <li><a href="">Xếp lớp test</a></li>
                            <li><a href="">Cập nhật kết quả bài test</a></li>
                            <li><a href="">Phân loại và xếp lớp</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i>Quản lý tài chính <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            {{--<li><a href="{{route('admin.exercise.create')}}">Thu học phí</a></li>--}}
                            {{--<li><a href="{{route('admin.exercise.create')}}">Tính lương</a></li>--}}
                            {{--<li><a href="{{route('admin.exercise.create')}}">Thu</a></li>--}}
                            {{--<li><a href="{{route('admin.exercise.create')}}">Chi</a></li>--}}
                            {{--<li><a href="{{route('admin.exercise.assign')}}">Thống kê doanh thu</a></li>--}}
                        </ul>
                    </li>


                    <li><a><i class="fa fa-table"></i>Quản lý đào tạo<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('admin.classroom.list')}}">Lập kế hoạch giảng dậy</a></li>
                            <li><a href="{{route('admin.classroom.add')}}">Lập kế hoạch thi test</a></li>
                            <li><a href="{{route('admin.classroom.add')}}">Phân công giảng dạy</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-user"></i>Quản lý giảng viên <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admin.teachers.index') }}">Danh sách giảng viên</a></li>
                            <li><a href="{{ route('admin.teachers.create') }}">Thêm giảng viên</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-user"></i>Quản lý học viên <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admin.students.index') }}">Danh sách </a></li>
                            <li><a href="{{ route('admin.students.create') }}">Thêm học viên</a></li>
                            <li><a href="{{ route('admin.students.create') }}">Cập nhật kết quả học tập</a></li>
                            <li><a href="{{ route('admin.students.create') }}">Cập nhật thông tin học viên</a></li>
                        </ul>
                    </li>
                </ul>
            </div>


        </div>
        <!-- /sidebar menu -->

        <!-- /menu footer buttons -->
        <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
        <!-- /menu footer buttons -->
    </div>
</div>
