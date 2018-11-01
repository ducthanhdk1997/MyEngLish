<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="{{ asset('/admin_asset/css/styleAdmin.css')}}">
	
	@include('admin.layouts.css')
</head>
<body class="nav-md">
    <div class="container body">
      	<div class="main_container">
        <!-- left_col -->
	        
		@include('admin.layouts.menu')
        <!-- end of left_col -->

        <!-- top navigation -->
		@include('admin.layouts.header')
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->

          <!-- page content -->
          <div class="row" style="padding-top: 60px">
            <!-- page center content -->
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
          @endif
          @include('flash::message')
            @yield('content')
           
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