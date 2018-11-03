<div class="top_nav">
	<div class="nav_menu setfixed-for-top-nav">
		<nav>
		  <div class="nav toggle">
		    <a id="menu_toggle"><i class="fa fa-bars"></i></a>
		  </div>

		  <ul class="nav navbar-nav navbar-right">
		    <li class="">
		      <a href="#" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		        <img src="{{asset('admin_asset/images/img.jpg')}}" fa fa-angle-down"></span>
		      </a>
		      <ul class="dropdown-menu dropdown-usermenu pull-right">
		        <li><a href="#"> Profile</a></li>
		        <li>
					<a onclick="document.getElementById('logout-form').submit()">
						<span class="glyphicon glyphicon-off" aria-hidden="true"></span>Logout
					</a>
				</li>
		      </ul>
		    </li>

		    <li role="presentation" class="dropdown">
		      <a href="#" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
		        <i class="fa fa-envelope-o"></i>
		        <span class="badge bg-green">6</span>
		      </a>
		      <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
		      	<li>
		          <a>
		            <span class="image"><img src="{{asset('admin_asset/images/img.jpg')}}" alt="Profile Image" /></span>
		            <span>
		              <span>John Smith</span>
		              <span class="time">3 mins ago</span>
		            </span>
		            <span class="message">
		              Film festivals used to be do-or-die moments for movie makers. They were where...
		            </span>
		          </a>
		        </li>
		        <li>
		          <div class="text-center">
		            <a>
		              <strong>See All Alerts</strong>
		              <i class="fa fa-angle-right"></i>
		            </a>
		          </div>
		        </li>
		      </ul>
		    </li>
		  </ul>
		</nav>
	</div>
</div>