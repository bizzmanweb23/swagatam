@extends('layouts.app')

@section('content')

<!-- Login wrapper -->
<div class="login-wrapper" style="background-image: url({{asset('public/images/login-bg.jpg')}});">
    <div class="card login-box">
        <div class="card-container align-center">
            <svg height="100" width="100">
                <polygon points="50,25 17,80 82,80" stroke-linejoin="round" style="fill:none;stroke:#f83069;stroke-width:8" />
                <text x="42" y="74" fill="#f83069" font-family="sans-serif" font-weight="900" font-size="42px">!</text>
            </svg>

            <h1  class="font-lighter">Access Denied.</h1>
  

        </div>
    </div>
    

</div>
<!-- /Login wrapper -->

@endsection