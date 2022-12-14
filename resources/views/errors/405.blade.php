<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="theme-color" content="#4285f4">     
<meta name="apple-mobile-web-app-status-bar-style" content="#f83069">

<link rel="shortcut icon" href="{{asset('public/images/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{asset('public/images/favicon.ico')}}" type="image/x-icon">

    <title>{!! getCompanyDetails(1)->s_company_name !!}</title>
    <!-- sScreen -->
    <link href="{{asset('public/css/style.css')}}" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries,  Respond.js doesn't work local-->
    <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<!-- Login wrapper -->
<div class="login-wrapper" style="background-image: url({{asset('public/images/login-bg.jpg')}});">
    <div class="card login-box">
        <div class="card-container align-center">
            <svg height="100" width="100">
                <polygon points="50,25 17,80 82,80" stroke-linejoin="round" style="fill:none;stroke:#f83069;stroke-width:8" />
                <text x="42" y="74" fill="#f83069" font-family="sans-serif" font-weight="900" font-size="42px">!</text>
            </svg>

            <h1  class="font-lighter">Check you database connection string</h1>
        
        </div>
    </div>
    

</div>
<!-- /Login wrapper -->


<!-- jQuery plugins -->
<script src="{{asset('public/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('public/js/jquery-migrate-3.0.1.min.js')}}"></script>
<!-- sScreen -->
<script src="{{asset('public/js/sScreen.js')}}"></script>
<!-- script -->
</body>
</html>
