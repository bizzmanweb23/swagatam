<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ url('public/assets/logo-small.png')}}">
    <title>Arohan login</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ url('public/assets/css/simplebar.css') }}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ url('public/assets/css/feather.css') }}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{ url('public/assets/css/daterangepicker.css') }}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{ url('public/assets/css/app-light.css') }}" id="lightTheme"  >
    <link rel="stylesheet" href="{{ url('public/assets/css/app-dark.css') }}" id="darkTheme" disabled>
</head>
<body class="light  ">
<div class="wrapper vh-100">
    <div class="row align-items-center h-100 w-50 mx-auto">
        <div class="col-10 mx-auto  ">
            <div class=" align-items-center h-100">
            <div class="">
 
                <div class=" ">
                    <h3 class="text-info text-center ">Login</h3>
                    <form method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div  >
                            <div class="form-group">
                                <label for="email"  >{{ __('Email Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div  >
                            <div  class="form-group">
                                <label for="password"  >{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                               @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group" >
                            <div  >
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group  ">
                            <div class=" ">
                                <button type="submit" class="btn btn-secondary">
                                    {{ __('LOGIN') }}
                                </button>


                            </div>
                            <div class="text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                                <a href="{{ route('register') }}" class="  text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ url('public/assets/js/jquery.min.js') }}"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/simplebar.min.js"></script>
<script src='js/daterangepicker.js'></script>
<script src='js/jquery.stickOnScroll.js'></script>
<script src="js/tinycolor-min.js"></script>
<script src="js/config.js"></script>
<script src="js/apps.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag()
    {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-56159088-1');
</script>
<script type="text/javascript">
    $(document).ready(function(){

        $('#login-form').on('submit',function(e){
            e.preventDefault();
            $input = $(this).serialize();
            $.ajax({
                url: '{{ url("login") }}',
                type : 'post',
                data : $input,
                success: function(data){

                },
                error: function(data){

                }
            });
        });
    });
</script>
</body>
</html>
</body>
</html>
