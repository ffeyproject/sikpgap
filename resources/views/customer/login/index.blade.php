<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Customer</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="{{asset('images/icons/favicon.ico') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/login/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{asset('frontend/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/login/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/login/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/login/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/login/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/login/css/main.css') }}">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="{{asset('frontend/image/logo_gajah.png') }}" alt="IMG">
                </div>

                <form class="login100-form validate-form">
                    <span class="login100-form-title">
                        Customer Login
                    </span>

                    {{-- <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div> --}}

                    {{-- <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div> --}}

                    <div class="container-login100-form-btn">
                        <a class="login100-form-btn" href="{{ route('user.login.google') }}">
                            <img width="30px" style="margin-top:7px; margin-right:8px" alt="Google sign-in"
                                src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/Google_%22G%22_Logo.svg/512px-Google_%22G%22_Logo.svg.png" />
                            Login with Google
                        </a>
                    </div>

                    {{-- <div class="text-center p-t-12">
                        <span class="txt1">
                            Forgot
                        </span>
                        <a class="txt2" href="#">
                            Username / Password?
                        </a>
                    </div> --}}

                    <div class="text-center p-t-136">
                        <a class="txt2" href="/">
                            Back To Home
                            <i class="fa fa-long-arrow-left m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>




    <!--===============================================================================================-->
    <script src="{{asset('frontend/login/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('frontend/login/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{asset('frontend/login/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('frontend/login/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{asset('frontend/login/vendor/tilt/tilt.jquery.min.js') }}"></script>
    <script>
        $('.js-tilt').tilt({
			scale: 1.1
		})
    </script>
    <!--===============================================================================================-->
    <script src="{{asset('js/main.js') }}"></script>

</body>

</html>
