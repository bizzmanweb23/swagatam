<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Swagatam</title>
        <!-- google font-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <!-- this is custom css-->
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    
        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    
        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
		
    </head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 mt-5 pt-5 text-center">
                <div class="adhar-box login-bg">
                    <img src="images/Logo.png" alt="" class="img-fluid" style="width: 200px"> <br>
                    <form action="" method="post">
					<input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
                    <div class="sign-up-form mt-3 w-75 text-center mx-auto" id="phone_number">
                        
                        <input type="text" class="form-control" name="phone_number" placeholder="Enter Your Phone No.">
                    </div>
                    <div class="sign-up-form mt-3 w-75 text-center mx-auto" id="otp">
                        
                        <input type="text" class="form-control" placeholder="Enter OTP">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-reg-submit mt-3" id="getOTP">Get OTP</button>
					</form>
                  </div>
                  
            </div>
        </div>
       
    </div>
</body>
</html>

