<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $shareData['system_name'] }}</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="{{ asset('others') }}/{{ $shareData['favicon'] }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/normalize.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/scss/style.css') }}">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body class="bg-dark">
    <div class="sufee-login d-flex align-content-center flex-wrap">
        <div class="container">
            <div class="login-content">
                <div class="login-logo">
                    <a href="{{ url('/')}}">
                        <img class="align-content" src="{{ asset('others') }}/{{ $shareData['front_logo'] }}" alt="">
                    </a>
                </div>
                <br><br>
                <div class="login-form">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Email address</label>

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                required autofocus>

                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" href="{{ old('remember') ? 'checked' : '' }}">
                                Remember Me
                            </label>
                            <label class="pull-right">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Login</button>

                        <br><br>
                        <div class="register-link m-t-15 text-center">
                            <a href="{{ url('auth/google') }}">Login using Google</a> or
                            <a href="{{ route('otp.login') }}">OTP</a>
                        </div>
                        <br>
                        <div class="register-link m-t-15 text-center">
                            <p>Don't have account ? <a href="{{route('register')}}"> Sign Up Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('admin/assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>


</body>

</html>
