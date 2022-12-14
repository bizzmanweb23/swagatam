@extends('layouts.app')

@section('content')
    
<div class="admin-content-header">
    <h1 class="float-left-sm margin-top-09 primary-color">{{ $heading }}</h1>
    <div class=" float-right-sm margin-bottom-sm align-right">
        <div class=" float-right-sm">
            <a href="{{ $back_url }}" class="button button-gray"><i class="material-icons">keyboard_arrow_left</i>Back</a>
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
            <div class="card">
                <div class="card-container clearfix">
                    <h4 class="primary-color">Ticket Forward Details</h4>
                    <div class="equal-height-card ">
                        <div class="item-details margin-bottom-sm itemDetails-active">
                            <form method="post" id="frm_add_edit" name="frm_add_edit" action="{{ action('TaskController@ticketForward') }}" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <input name="id" type="hidden" value="{{ $id }}" >
                                <input type="hidden" name="ticket_id" value="{{$detail->id}}">
								<input type="hidden" name="status_id" value="{{$detail->status}}">
								<input type="hidden" name="ticket_number" value="{{$detail->ticket_number}}">
								<input type="hidden" name="no_of_cases" value="{{$detail->no_of_cases}}">
								<input type="hidden" name="created_by" value="{{$detail->created_by}}">
								<input type="hidden" name="submited_date" value="{{$detail->submited_date}}">
								<input type="hidden" name="ticket_office_id" value="{{$detail->office_id}}">
								<input type="hidden" name="ticket_office_code" value="{{$detail->office_code}}">
								<input type="hidden" name="ticket_office_type" value="{{$detail->office_type}}">
								<input type="hidden" name="escalated_role_tat" value="{{$detail->escalated_role_tat}}">
								<input type="hidden" name="usr_phone_no" value="{{$detail->phone_no}}">
								<input type="hidden" name="assined_record_count" value="{{$assined_record_count}}">
                                
                                <div class="row ">
                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Department</label>
                                            <select class="input-panel" name="department" id="department_id" onchange="categoryAjax(this.value);"  <?php echo($assined_record_count > 0)? 'disabled' : ''; ?>>
                                                <option value=""> Select </option>

                                                <?php $departments = getDepartments(); ?>
                                                <?php foreach($departments as $department): ?>
                                                    <?php
		                                                $selected = ($detail->department_id == $department['id'])? 'selected':'';
		                                            ?>
                                                    <option value="<?php echo $department['id']; ?>" {{$selected }}><?php echo $department['short_name']; ?></option>

                                                <?php endforeach; ?>
                                                
                                            </select>
                                        </div>
                                        <?php if($assined_record_count > 0) { ?>
											<input type="hidden" name="hidden_department_id" value="{{$detail->department_id}}">
										  <?php } ?>
                                    </div>

                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Category</label>
                                            <select class="input-panel" name="category" id="category_id" onchange="subcategoryAjax(this.value);">
                                                <option value=""> Select </option>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Sub Category</label>
                                            <select class="input-panel" name="sub_category" id="sub_category_id" onchange="roleAjax();">
                                                <option value=""> Select </option>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Role</label>
                                            <select class="input-panel" id="dept_role" name="dept_role" onchange="usersByRole(this.value);">
                                                <option value=""> Select </option>
                                                
                                            </select>
                                        </div>
                                    </div>
                                    <?php 
					                    $officeData1 = getOfficeDeatils($detail->office_code);
					                    if($officeData1)
					                    {
					                         $office_location = $officeData1['name'] . " (".$officeData1['username'].")";
					                    }else{
					                        $office_location =  "-";
					                    }
					                ?>
                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Office Location</label>
                                            <input type="text" class="input-panel" id="off_location_code" name="off_location_code" value="{{ $office_location }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Status</label>
                                            <select class="input-panel" name="status" id="status" disabled>
                                                <option value=""> Select </option>
                                                <?php echo $status = getAllTicketStatus($detail->status); ?>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-la-12">
                                        <div class="form-panel">
                                            <label>Description</label>
                                            <textarea class="input-panel" name="description" id="description" rows="3" readonly>{{ $detail->description }}</textarea>
                                        </div>
                                    </div>                                    
                                    <div class="clearfix"></div> 
                                    <div class="col-la-3 col-me-2 col-sm-6">
                                        <div class="form-panel">
                                            <button type="submit" class="button button-info"><i class="material-icons">save</i>Save</button>
                                            <button type="reset" class="button button-gray"><i class="material-icons">not_interested</i>Reset</button>
                                        </div>
                                    </div>
                                    <div class="col-la-12 user-main-sec">
                                        <div class="alert primary-alert" role="alert">
                                            <p class="role-user-sec no-margin"></p> 
                                        </div>                                    	
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')

<script type="text/javascript">  
$(document).ready(function(){
    $('.user-main-sec').hide();
    categoryAjax(<?php echo $detail->department_id; ?>, <?php echo $detail->category_id; ?>);
    subcategoryAjax(<?php echo $detail->category_id; ?>, <?php echo $detail->subcategory_id; ?>);
   
    $("#frm_add_edit button[type=reset]").on('click', function(){
        var form = $('#frm_add_edit');
        form.find('input[name=department]').val(0);
        form.find('input[name=category]').val(0);
        form.find('input[name=sub_category]').val(0);
        form.find('input[name=mobile]').val(0);
        form.find('textarea[name=description]').val(0);
    });
    
}); 
function categoryAjax(DEPARTMENT_ID, CAT_ID = '')
{
    var departmentId = DEPARTMENT_ID;
    if(departmentId == '')
    {
       return false;
    }
    var childLocationElementId = "#category_id";
    showLoader(childLocationElementId, 'position:absolute; top: 25px; right: 1px;');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
    url: base_url + "ajax/category",
    type: "POST",
    data: {'department_id': departmentId, 'mode': 'cat' },
    dataType: "json",  
    success: function(response) {
            var selected = '';
            $('#category_id, #sub_category_id').empty();
            $('#category_id, #sub_category_id').val('');
            $('#category_id, #sub_category_id').append($('<option>').text('--Select--').attr('value', ""));
            $.each(response, function(i, obj){
                $('#category_id').append($('<option>').text(obj.name).attr('value', obj.id));
            });
            if(CAT_ID != '')
            {
                $('#category_id').val(CAT_ID);
                roleAjax();
            }
            
           hideLoader(childLocationElementId); 
           
        }
    });
    
}

function subcategoryAjax(CAT_ID, SUBCAT_ID = '')
{
    var department_id = $('#department_id').val();
    var category_id = CAT_ID;
    
    if(department_id == '' && category_id == '')
    {
       return false;
    }
    else{

        var childLocationElementId = "#sub_category_id";
        showLoader(childLocationElementId, 'position:absolute; top: 25px; right: 1px;');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        $.ajax({
            url: base_url + "ajax/category",
            type: "POST",
            data: { 'department_id': department_id, 'category_id': category_id ,'mode': 'subcat' },
            dataType: "json",
            success: function(response) {
                var selected = '';
                $('#sub_category_id').empty();
                $('#sub_category_id').val('');
                $('#sub_category_id').append($('<option>').text('--Select--').attr('value', ""));
                $.each(response, function(i, obj){
                    $('#sub_category_id').append($('<option>').text(obj.name).attr('value', obj.id));
                });
                if(SUBCAT_ID != '')
                {
                    $('#sub_category_id').val(SUBCAT_ID);
                    roleAjax();
                }
                hideLoader(childLocationElementId);
               
            }
        });
        
        return true;
    }
}

function roleAjax()
{
    var department_id =  $.trim($('#department_id').val());
    var category_id =  $.trim($('#category_id').val());
    var subcategory_id =  $.trim($('#sub_category_id').val());
    
    if(department_id == '' || category_id == '' || subcategory_id == '')
    {
       return false;
    }
    else{

    	var childLocationElementId = "#dept_role";
        showLoader(childLocationElementId, 'position:absolute; top: 25px; right: 1px;');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        $.ajax({
            url: base_url + "ajax/forward-ajax-roles",
            type: "POST",
            data: { 'department_id': department_id, 'category_id': category_id, 'subcategory_id': subcategory_id },
            dataType: "json",
            success: function(response) {
                    var selected = '';
                   $('#dept_role').empty();
                    $('#dept_role').val('');
                    $('#dept_role').append($('<option>').text('--Select--').attr('value', ""));
                    $.each(response, function(i, obj){
                        $('#dept_role').append($('<option>').text(obj.name).attr('value', obj.id));
                    });
                    hideLoader(childLocationElementId);
                }
        });
        
        return true;
    }
}

/* get User according roles */
function usersByRole(val)
{

	var childLocationElementId = "#dept_role";
    showLoader(childLocationElementId, 'position:absolute; top: 25px; right: 1px;');
	
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: base_url + "ajax/userajax-details",
        type: "POST",
        data: { 'role_id': val },
        dataType: "json",
        success: function(response) {
            if(response)
            {
               $('.user-main-sec').show();
               $('.role-user-sec').text('');
               $.each(response, function(i, obj){
                    $('.role-user-sec').append(obj.name + " &nbsp;&nbsp;");
                });
                $('.role-user-sec').css('line-height','2em');    
            }
            else{
               $('.role-user-sec').html(''); 
            }
            hideLoader(childLocationElementId);
        }
    });
}

</script>  

@endsection
