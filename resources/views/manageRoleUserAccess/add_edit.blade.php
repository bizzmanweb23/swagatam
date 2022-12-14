@extends('layouts.app')

@section('content')

<div class="admin-content-header">
    <h1 class="float-left-sm margin-top-09 primary-color">{{ $heading }}</h1>
    <div class=" float-right-sm margin-bottom-sm align-right">
        <div class=" float-right-sm">
            <a href="{{ $back_url }}" class="button"><i class="material-icons">keyboard_arrow_left</i>Back</a>
        </div>
    </div>

</div>

<!-- Error message -->
@if ($errors->any())
<div class="col-la-12">

    <div class="bg-heading bg-error page-message">
        <ul class="list-no-bullet no-margin">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif
<!-- /Error message -->

<div class="wrapper-fluid">
    <div class="row">
        <div class="col-sm-12">
            <form method="post" id="frm_add_edit" name="frm_add_edit"
                action="{{ action('SamadhanRoleUserAccessController@edit') }}" enctype="multipart/form-data">

                {{csrf_field()}}

                <input name="mode" type="hidden" value="{{$mode}}">

                @if($mode == 'Edit')
                    <input name="hide_department" type="hidden" value="{{$department_id}}">
                    <input name="hide_role" type="hidden" value="{{$role_id}}">
                @endif

                <div class="card">
                    <div class="card-container">
                        
                        <h4 class="primary-color"> User Information </h4>
                        <div class="clearfix"></div>                        
                        <div class="row ">

                            <div class="col-la-3 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Department</label>
                                    <select class="input-panel" name="department" id="department_id" onchange="samadhanRoleAjax();" <?php if($mode =='Edit') { ?> disabled <?php } ?>>
                                        <option value=""> Select </option>

                                        <?php $departments = getDepartments(); ?>
                                        <?php foreach($departments as $department): ?>
                                            
                                            <option value="<?php echo $department['id']; ?>" {!! ($mode == 'Edit')? (($department['id'] == $department_id)? 'selected' : '') : '' !!}><?php echo $department['short_name']; ?></option>

                                        <?php endforeach; ?>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-la-3 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Role</label>
                                    <?php if($mode =='Edit'): ?>
                                        <input type="text" class="input-panel" value="{{ getRoleNameById($role_id) }}" name="role_id" id="role_id" readonly>
                                    <?php else: ?>
                                        <?php $roleCondition = ($mode =='Edit')? '' : 'onchange="selectedUsersAjax();"'; ?>
                                        <select class="input-panel role-values role-sec" name="role_id" id="role_id" <?php echo $roleCondition; ?> >
                                            <option value=""> Select </option>
                                            <?php echo getRole($role_id,$department_id); ?>
                                        </select>

                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php
                                
                                if($mode == "Edit"):
                                    $selected_arr = getRoleUserList(true, $role_id,$department_id);
                                else:
                                    $selected_arr = [];
                                endif;
                            ?>

                            <div class="col-la-3 col-me-3 col-sm-6">
                                <div class="form-panel">
                                    <label>Users</label>
                                    <select name="i_user_id[]" id="i_user_id" multiple class="input-panel chosen-select">
                                    <option value="">Select User</option>
                                        <?php $user_list = getRoleUserList(false, $role_id,$department_id); ?>
                                        @foreach($user_list as $users)

                                            <?php $selected_val = (in_array($users['id'], array_column($selected_arr, 'id')))? 'selected' : ''; ?>

                                            <option value="{{$users['id']}}" {{ $selected_val }}>{{$users['name']}}</option>                                           
                                        @endforeach
                                    </select>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                           
                            <div class="col-la-12 col-me-12 col-sm-12">
                                    <div class="clearfix"></div> 
                                    <label>&nbsp; </label>
                                    <div class="form-panel">
                                        <button type="submit" class="button button-info"><i class="material-icons">save</i>Save</button>
                                        <button type="reset" class="button button-gray"><i class="material-icons">not_interested</i>Reset</button>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('css')
<link href="{{asset('public/js/chosen/chosen.min.css')}}" rel="stylesheet">
<style type="text/css">
.chosen-container {
    width: 100% !important;
}
</style>
@endsection

@section('js')
<script type="text/javascript" src="{{asset('public/js/chosen/chosen.jquery.min.js')}}"></script>
<!-- Javacript form validation -->

<script type="text/javascript">
$(document).ready(function() {



    $("#frm_add_edit button[type=reset]").on('click', function(){
        var form = $('#frm_add_edit');
        form.find('input[name=department]').val(0);
        form.find('input[name=role_id]').val(0);
        $('#i_user_id').val('');
    });

    //  Validation
    $("#frm_add_edit").on('submit', function(){
        var is_valid = true;

        if(document.getElementById("department_id").value == ""){
            var $msg ='Department is required!';
            viewMessage($msg);
            is_valid = false;
        }
        if(document.getElementById("role_id").value == ""){
            var $msg ='Role is required!';
            viewMessage($msg);
            is_valid = false;
        }
        if((document.getElementById("i_user_id").value).length == 0){
            var $msg ='Users is required!';
            viewMessage($msg);
            is_valid = false;
        }
        
        return is_valid ;
    });


$('.chosen-select-user').chosen();
$('.chosen-select').chosen();
//$(".chosen-select").trigger("chosen:open");

    $(".chosen-select").on('change', function (event,el) {

      var selected_element = $(".chosen-select option[value='"+el.selected+"']");

      var selected_value  = selected_element.val();
      var parent_optgroup = selected_element.closest('optgroup').attr('label');

      if (typeof parent_optgroup == 'undefined') {
        parent_optgroup = ''
      }else{
        parent_optgroup = parent_optgroup+' - ';
      }
      
      selected_element.text(parent_optgroup+selected_element.text()).trigger("chosen:updated");
    });

    
    $.each($('.chosen-select :selected'), function(){            
        var selected_element = $(this);

        var selected_value  = selected_element.val();
        var parent_optgroup = selected_element.closest('optgroup').attr('label');

        if (typeof parent_optgroup == 'undefined') {
          parent_optgroup = ''
        }else{
          parent_optgroup = parent_optgroup+' - ';
        }
        
        selected_element.text(parent_optgroup+selected_element.text()).trigger("chosen:updated");
    });


});

function samadhanRoleAjax()
{

    var departmentId = $('#department_id').val();
    var selectedRole = $('.role-sec').val();

    var childLocationElementId = ".role-sec";
    showLoader(childLocationElementId, 'position:absolute; top: 25px; right: 1px;');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
    url: base_url + "ajax/ajax-samadhan-roles",
    type: "post",
    data: {'department_id': departmentId, 'roles': selectedRole },
    dataType: "json",    
    success: function(response) {
            
            $('.role-values').empty();
            $('.role-values').append($('<option>').text('-- Select Role --').attr('value', ""));
            $.each(response, function(i, obj){
                $('.role-values').append($('<option>').text(obj.name).attr('value', obj.id));
            });

            hideLoader(childLocationElementId);
        }
    });
    
} 

function selectedUsersAjax()
{

    var departmentId = $('#department_id').val();
    var selectedRole = $('.role-sec').val();

    var childLocationElementId = "#i_user_id";
    showLoader(childLocationElementId, 'position:absolute; top: 25px; right: 1px;');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
    url: base_url + "ajax/ajax-samadhan-role-users",
    type: "post",
    data: {'department_id': departmentId, 'role_id': selectedRole },
    dataType: "json",    
    success: function(response) {
            $('.chosen-select').chosen();
            $.each(response, function(i, obj){
                console.log(obj);
                $(".chosen-select option[value='"+obj+"']").attr('selected', 'selected');
            });
            hideLoader(childLocationElementId);

            $(".chosen-select").on('change', function (event,el) {

              var selected_element = $(".chosen-select option[value='"+el.selected+"']");

              var selected_value  = selected_element.val();
              var parent_optgroup = selected_element.closest('optgroup').attr('label');

              if (typeof parent_optgroup == 'undefined') {
                parent_optgroup = ''
              }else{
                parent_optgroup = parent_optgroup+' - ';
              }
              
              selected_element.text(parent_optgroup+selected_element.text()).trigger("chosen:updated");
            });

            
            $.each($('.chosen-select :selected'), function(){            
                var selected_element = $(this);

                var selected_value  = selected_element.val();
                var parent_optgroup = selected_element.closest('optgroup').attr('label');

                if (typeof parent_optgroup == 'undefined') {
                  parent_optgroup = ''
                }else{
                  parent_optgroup = parent_optgroup+' - ';
                }
                
                selected_element.text(parent_optgroup+selected_element.text()).trigger("chosen:updated");
            });
        }
    });
    
} 

/* Message Show */    
function viewMessage(e)
{
    
    var ret = false;
    var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i>Alert</h3><p class="margin-bottom-0">'+e+'</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss" id="yes_restore">Close</button></div></div>';
    showPopUp(divElementSuccess);
    return ret;
}   

</script>


@endsection