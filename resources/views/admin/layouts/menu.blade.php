<div class="col-md-3 left_col" style="position: fixed;">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="#" class="site_title"><i class="fa fa-paw"></i> <span>TOEIC cho bạn!</span></a>
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

        <br/>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Danh mục</h3>
                <ul class="nav side-menu">

                    <li><a><i class="fa fa-home"></i>Quản lý trình độ <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{asset('admin/grade/list')}}">Danh sách trình độ</a></li>
                            <li><a href="{{asset('admin/grade/add')}}">Thêm trình độ</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-home"></i>Quản lý khóa học<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{asset('admin/course/list')}}">Danh sách khóa học</a></li>
                            <li><a href="{{asset('admin/course/add')}}">Thêm mới khóa học</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-desktop"></i>Quản lý lớp học<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{asset('admin/class/list')}}">Danh sách lớp học</a></li>
                            <li><a href="{{asset('admin/class/add')}}">Mở lớp học</a></li>
                            <li><a href="{{asset('admin/class/adduser')}}">Thêm học viên</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i>Quản lý bài tập <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{asset('admin/exercise/add')}}">Thêm bài tập</a></li>
                            <li><a href="{{asset('admin/exercise/assign')}}">Giao bài tập cho lớp</a></li>
                            <li><a href="{{asset('admin/exercise/list')}}">Danh sách bài tập</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-table"></i>Quản lý phòng học<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{asset('admin/classroom/list')}}">Danh sách phòng</a></li>
                            <li><a href="{{asset('admin/classroom/add')}}">Thêm phòng học</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-user"></i>Quản lý giảng viên <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admin.users.index') }}">Danh sách</a></li>
                            <li><a href="{{ route('admin.users.create') }}">Thêm giảng viên</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-user"></i>Quản lý học viên <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('admin.students.index') }}">Danh sách </a></li>
                            <li><a href="{{ route('admin.students.create') }}">Thêm học viên</a></li>
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
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="#">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>
    </div>
</div>