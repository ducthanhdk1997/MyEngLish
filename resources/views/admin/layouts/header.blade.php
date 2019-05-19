<div class="top_nav">
    <div class="nav_menu setfixed-for-top-nav">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="#" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('upload')}}/{{Auth::user()->avatar}}" class="fa fa-angle-down">
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{route('profile',Auth::user())}}"> Profile</a></li>
                        <li>
                            <a href="{{route('logout')}}">
                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>Logout
                            </a>
                        </li>
                    </ul>
                </li>
                @php
                    $notifications = \App\Notification::query()->where('state','=',0)->where('user_id','=',Auth::user()->id)->get();

                @endphp
                <li role="presentation" class="dropdown">
                    @if(Auth::user()->role_id !=1 && Auth::user()->role_id !=2)
                        <a href="#" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-envelope-o"></i>
                            <span class="badge bg-green">{{$notifications->count()}}</span>
                        </a>
                    @endif
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        @if($notifications->count()!=0)
                            @foreach($notifications as $notification)
                                <a href="{{route('notification.show',$notification)}}">
                                    <li><span class="message">{{$notification->title}}</span></li>
                                </a>
                            @endforeach
                        @endif
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>