<?php
    ob_start("ob_gzhandler");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  
<!-- Head meta section part -->
@include('layouts.head-meta-section')

<!-- /head meta section part -->
</head>

<body class="{!! (Session::get('menuClass') != '')?Session::get('menuClass'):'menu-collapse' !!}">
 
<main class="main-wrapper">
    
    <!-- Header part -->
    @include('layouts.header')
    
    <!-- /Header part -->

    <!-- Content part -->
    <div class="admim-content-wrapper">
        
        @yield('content')
    </div>
 
    <!-- /Content part -->
    
    <!-- Footer -->
    @include('layouts.footer')
    
    <!-- /Footer -->
    
</main>
<!-- Service Status Confirm Popup -->
      <div class="popup-container popup-container-sm mfp-hide" id="confirm-popup">
         <h3>Confirm!</h3>
         <p id="popupMsg">Are you sure you want to delete this item?</p>
         <div>
            <button type="button" class="button button-gray popup-modal-dismiss" id="cnclBtn">No</button>
            <button type="button" class="button" id="yesBtn">Yes</button>
         </div>
      </div>
<!-- Service Status Confirm Popup -->

      
<!-- Footer Script Section -->
    @include('layouts.footer-scripts-section')
<!-- Footer Script Section -->
 
<!--    <script type="text/javascript">
        var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Change Password</h3><p> </p><div class="row"><div class="col-la-12"><div class="form-panel"><label>Current Password <span class="error-color">*</span></label><input type="password" class="input-panel" name="old_password" id="oldPassword"><span class="error-message"></span><a class="icon-button button-primary" style="position: absolute; right: 4px; top: 30px; font-size: 20px;" id="showPasswordOld"> <i class="fa fa-eye"></i></a></div></div><div class="col-la-12"><div class="form-panel"><label>New Password <span class="error-color">*</span></label><input type="password" class="input-panel" name="password" id="newPassword"><span class="error-message"></span><a class="icon-button button-primary" style="position: absolute; right: 4px; top: 30px; font-size: 20px;" id="showPasswordNew"> <i class="fa fa-eye"></i></a></div></div><div class="col-la-12"><div class="form-panel"><label>Confirm Password <span class="error-color">*</span></label><input type="password" class="input-panel" name="password_confirmation" id="confirmPassword"><span class="error-message"></span><a class="icon-button button-primary" style="position: absolute; right: 4px; top: 30px; font-size: 20px;" id="showPasswordNewCnfrm"> <i class="fa fa-eye"></i></a></div></div></div></div><div class="alert-button alert-success"><button type="button" class="button" id="changePasswordYes">Save</button></div></div>';
        showPopUp(divElement);
        $(".mfp-bg").css({'opacity':'0.9'});
    </script>
 

 
    <script type="text/javascript"> 
        $.magnificPopup.open({
            items: {
                src: '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3><p class="margin-bottom-0">{!! \Session::get('success') !!}</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss">Ok</button></div></div>',
                type:'inline'
            },
            modal: true
        });
    </script>
 

 
    <script type="text/javascript"> 
        $.magnificPopup.open({
            items: {
                src: '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="error-color">Error</h3><p class="margin-bottom-0">{!! \Session::get('error') !!}</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss">Ok</button></div></div>',
                type:'inline'
            },
            modal: true
        });
    </script>
 
     
        
    <script type="text/javascript">
        var divElement = '<form method="post" id="frm_add_edit" name="frm_add_edit" action="'+base_url+'selectRoleAfterLogin">{{ csrf_field() }}<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Select Role</h3><p>You are assigned with below roles. Kindly choose one to proceed.<br>Later you can switch to other roles from <b>My Profile</b> Section.</p><div class="row"><div class="col-la-12"><div class="form-panel"><label>Assigned Roles <span class="error-color">*</span></label><select class="input-panel" name="currentRole" id="currentRole"> </select><span class="error-message"></span></div></div></div></div><div class="alert-button alert-success"><button type="submit" class="button" id="selectRoleAfterLogin">Select &amp; Continue</button></div></div></form>';
        showPopUp(divElement);
        $(".mfp-bg").css({'opacity':'0.9'});
    </script>-->
 

<style type="text/css">
    .dropdownList {
      position: relative;
      display: inline-block;
    }

    .dropdownList-content {
      display: none;
      position: absolute;
      background-color: #fff;
      min-width: 200px;
      height: auto;
      box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
      z-index: 1;
      right: 0px;
      text-align: left;
      border: 1px solid #e0e0e0;
      border-radius: 5px; 
      padding: 5px;
    }
    .dropdownList-content a {
      padding: 7px 2px 7px 7px;
      text-decoration: none;
      display: block;
      text-align: left !important;
      border-bottom: 1px solid #eee;
    }

    .dropdownList-content a:hover {
        border-bottom: 1px solid #eee;
    }

    .dropdownList-content a:last-child{
        border-bottom: 0;
    }

    .dropdownList-content a span{
      color: #444444;
      text-align: left;
    }

    .show {display: block;}
</style>
</body>
</html>

<?php
    ob_end_flush();
?>