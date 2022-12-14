 <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ url('public/assets/logo-small.png') }}"   >
    <title>Arohan Registration</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="light  ">
<div class="wrapper vh-100  ">
    <div class="">
        <div class="row align-items-center h-100 w-50 mx-auto  ">
            <div class="col-10 mx-auto  ">
                <br><br>
                <div class="align-items-center h-100  align-middle">
                <!-- @if(Session::has('status'))
                    <span class="alert alert-danger text-success error-msg">{{Session::get('status')}}</span>
                  @endif -->
                    <br>
                    <div class="mt-5 h-100">
 
                        <div class="  ">
                            <h3 class="text-info text-center">Registration</h3>
                            <form method="POST" action="{{ route('register') }}">
                                 {{ csrf_field() }}

                                <div class="form-group">
                                    <label for="name"  >{{ __('Name') }}</label>


                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                   @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                                </div>

                                <div class="form-group">
                                    <label for="email" >{{ __('Email Address') }}</label>


                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                   @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                                </div>

                                <div class="form-group">
                                    <label for="password"  >{{ __('Password') }}</label>


                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                                </div>

                                <div class="form-group">
                                    <label for="password-confirm" >{{ __('Confirm Password') }}</label>

                                    <div class=" ">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>

                                <div class="w-50">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-secondary">
                                            {{ __('REGISTER') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="text-center mb-5">
                                    <span>Already have Account ?</span>&nbsp;
                                    <span>
                                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                                </span>
                                </div>

                        </div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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

        $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')}
        });


        $(document).on('click','#rg-btn', function(e){
            e.preventDefault();
            $form = $('#register-form').serialize();

            $.ajax({
                url : '{{ url("register/new") }}',
                method : 'post',
                data : $form,
                success : function(data){
                    toastr.error(data.error);
                    $('.error-msg').html(data.error);
                },
                error: function(response){
                    // $.each(response.responseJSON.errors, function(key,value){
                    //  console.log(value[0]);

                    // }) ;
                    if(response ){
                        //   $('.error-name') .html(response.responseJSON.errors.name);
                        // $('.error-email') .html(response.responseJSON.errors.email);
                        // $('.error-password') .html(response.responseJSON.errors.password);
                    }
                    else {
                        //   $('.error-name') .html('');
                        // $('.error-email') .html('');
                        // $('.error-password') .html('');
                    }

                    // toastr.error(response.responseJSON.errors.name);
                    // toastr.error(response.responseJSON.errors.email);
                    // toastr.error(response.responseJSON.errors.password);

                }

            });
        });

    });
</script>
</body>
</html>
</body>
</html>
