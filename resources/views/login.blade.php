<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

@include('admin.layouts.css')

<!-- Bootstrap -->

</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form action="{{ route('postLogin')}}" method="POST">
                    @csrf
                    <h1>Login Form</h1>
                    @if(count($errors)>0)
                        <div class="alert alert-danger">
                            <strong>Danger!</strong>
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        </div>
                    @endif

                    @if(session('message'))
                        <div class="alert alert-danger">
                            <strong>Danger!</strong>
                            {{session('message')}}
                        </div>
                    @endif
                    <div>
                        <input type="email" class="form-control" placeholder="Email" name="email" />
                    </div>
                    <div>
                        <input type="password" class="form-control" placeholder="Password"  name="password"/>
                    </div>
                    <button type="submit" class="btn btn-default">Login</button>
                    <div class="clearfix"></div>
                </form>
            </section>
        </div>

    </div>
</div>
</body>
</html>
