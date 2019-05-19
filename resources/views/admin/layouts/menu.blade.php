<div class="col-md-3 left_col">
    @php
        $role = Auth::user()->role_id;
    @endphp
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            @if($role == 1 || $role == 2)
                <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>MyEL!</span></a>
             @endif
            @if($role == 3)
                <a href="{{route('teacher.class.index')}}" class="site_title"><i class="fa fa-paw"></i> <span>MyEL!</span></a>
            @endif
            @if($role == 4)
                <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>MyEL!</span></a>
            @endif
        </div>

        <div class="clearfix"></div>

        <!-- menu profile quick info -->
        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="{{asset('upload')}}/{{Auth::user()->avatar}}" alt="..." class="img-circle profile_img">
            </div>

            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->username }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->

        <br />

        <!-- sidebar menu -->
        @php
        $role = Auth::user()->role_id;
        @endphp
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">

                    {{--route admin va nhan vien--}}
                    @if($role == 1)
                        <li><a><i class="fa fa-cogs"></i>Giao diện<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{route('admin.courses.create')}}">Thêm mới khóa học</a></li>
                                <li><a href="{{route('admin.courses.index')}}">Danh sách khóa học</a></li>
                                <li><a href="{{route('admin.classroom.index')}}">Giao diện phòng học</a></li>
                                <li><a href="{{route('admin.voucher.index')}}">Quản lý Voucher</a></li>

                            </ul>
                        </li>

                        <li><a><i class="fa fa-desktop"></i>Quản lý lớp học<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{route('admin.classes.index')}}">Danh sách lớp học</a></li>
                                <li><a href="{{route('admin.classes.create')}}">Mở lớp học</a></li>
                                <li><a href="{{route('admin.schedule.index')}}">Thời khóa biểu</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-table"></i>Quản lý thi đầu vào <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{route('admin.exam.create')}}">Lập kế hoạch thi test</a></li>
                                <li><a href="{{route('admin.exam.index')}}">Danh sách lịch thi</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-user"></i>Quản lý  nhân viên <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('admin.employee.index') }}">Danh sách tài khoản nhân viên</a></li>
                                <li><a href="{{ route('admin.employee.create') }}">Thêm tài khoản nhân viên</a></li>
                            </ul>
                        </li>

                        <li><a><i class="fa fa-users"></i>Quản lý giảng viên <span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{ route('admin.teachers.index') }}">Danh sách giảng viên</a></li>
                                <li><a href="{{ route('admin.teachers.create') }}">Thêm giảng viên</a></li>
                            </ul>
                        </li>
                    @endif

                    @if($role == 2)
                    <li><a href="{{route('employee.home.index')}}"><i class="fa fa-home"></i>Trang chủ</a>
                    </li>


                    <li><a><i class="fa fa-cogs"></i>Giao diện<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">

                            <li><a href="{{route('employee.courses.index')}}">Danh sách khóa học</a></li>
                            <li><a href="{{route('employee.classes.addUser')}}">Thêm học viên vào lớp</a></li>
                            <li><a href="{{route('employee.user_course.index')}}">Giao diện đóng học phí</a></li>
                            <li><a href="{{route('employee.courses.index')}}">Giao diện chuyển lớp,bảo lưu</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-desktop"></i>Quản lý lớp học<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('employee.classes.index')}}">Danh sách lớp học</a></li>
                            <li><a href="{{route('employee.schedule.index')}}">Thời khóa biểu</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i>Quản lý thi đầu vào <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('employee.exam.index')}}">Danh sách lịch thi</a></li>
                            <li><a href="{{route('employee.exam.create_result')}}">Cập nhật kết quả bài test</a></li>
                            <li><a href="{{route('employee.exam.result')}}">Kết quả thi</a></li>
                            <li><a href="{{route('employee.exam.arrange')}}">Phân loại và xếp lớp</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-table"></i>Quản lý tài chính <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{route('employee.courses.detail')}}">Thống kê doanh thu theo khóa học</a></li>
                            <li><a href="{{route('employee.courses.detail_by_quarter')}}">Thống kê doanh thu theo quý</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-graduation-cap"></i>Quản lý học viên <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('employee.students.index') }}">Danh sách </a></li>
                            <li><a href="{{ route('employee.students.create') }}">Thêm học viên</a></li>
                        </ul>
                    </li>
                    @endif


                    {{--ket thuc cua admin va nhan vien--}}


                    {{--giao dien giang vien--}}
                    @if($role == 3)
                        <li><a><i class="fa fa-cogs"></i>Giao diện<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{route('teacher.class.change_class_session')}}">Giao diện đăng ký nghỉ học</a></li>
                                <li><a href="{{route('notification.notification')}}">Giao diện thông báo</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-desktop"></i>Quản lý lớp học<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{route('teacher.class.index')}}">Danh sách lớp học của bạn</a></li>
                                <li><a href="{{route('admin.schedule.index')}}">Thời khóa biểu</a></li>
                            </ul>
                        </li>
                    @endif
                    {{--ket thuc giao dien giang vien--}}


                    {{--giao dien hoc vien--}}
                    @if($role == 4)

                        <li><a><i class="fa fa-cogs"></i>Giao diện<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{route('notification.notification')}}">Giao diện thông báo</a></li>
                            </ul>
                        </li>
                        <li><a><i class="fa fa-table"></i>Lịch thi thử<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{route('student.exam.create')}}">Đăng ký lịch thi thử</a></li>
                                <li><a href="{{route('student.exam.index')}}">Danh sách lịch thi của bạn</a></li>
                            </ul>
                        </li>

                        <li><a><i class="fa fa-desktop"></i>Quản lý lớp học<span class="fa fa-chevron-down"></span></a>
                            <ul class="nav child_menu">
                                <li><a href="{{route('student.class.index')}}">Danh sách lớp học của bạn</a></li>
                                <li><a href="{{route('admin.schedule.index')}}">Thời khóa biểu</a></li>
                            </ul>
                        </li>
                    @endif
                    {{--ket thuc cua giao dien hoc vien--}}
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
