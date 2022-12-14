<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="theme-color" content="#4285f4">     
<meta name="apple-mobile-web-app-status-bar-style" content="#f83069">

<link rel="shortcut icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{asset('images/favicon.ico')}}" type="image/x-icon">

<title> s_company_name  </title>

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600" rel="stylesheet">


<!-- Custom scrollbar -->
<link href="{{asset('components/custom-scrollbar/jquery.mCustomScrollbar.min.css')}}" rel="stylesheet">




<link href="{{asset('js/chosen/chosen.min.css')}}" rel="stylesheet">

<link href="{{asset('dist/easy-autocomplete.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('externalCSS/jquery.tagsinput-revisited.css')}}" rel="stylesheet" type="text/css">

<link href="{!! asset('css/style.css?v=1.1') !!}" rel="stylesheet">


<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries,  Respond.js doesn't work local-->
<!--[if lt IE 9]>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

    <meta name="csrf-token" content="{{ csrf_token() }}">
