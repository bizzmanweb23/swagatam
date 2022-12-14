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
                    <h4 class="primary-color">Ticket Details</h4>
                    <div class="equal-height-card ">
                        <div class="item-details margin-bottom-sm itemDetails-active">
                            <form method="post" id="frm_add_edit" name="frm_add_edit" action="{{ action('TicketController@edit') }}" enctype="multipart/form-data">
                                {{csrf_field()}}

                                @if($mode == 'Edit')
                                <input name="id" type="hidden" value="{{ $id }}" >
                                @endif
                                
                                <div class="row ">
                                    <div class="col-la-2 col-me-4 col-sm-6">
                                        <div class="form-panel">
                                            <label>Department</label>
                                            <select class="input-panel" name="department" id="department_id" onchange="categoryAjax(this.value);">
                                                <option value=""> Select </option>

                                                <?php $departments = getDepartments(); ?>
                                                <?php foreach($departments as $department): ?>
                                                    
                                                    <option value="<?php echo $department['id']; ?>"><?php echo $department['short_name']; ?></option>

                                                <?php endforeach; ?>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-la-2 col-me-4 col-sm-6">
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
                                            <select class="input-panel" name="sub_category" id="sub_category_id">
                                                <option value=""> Select </option>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>No. of Cases</label>
                                            <input type="number" name="no_of_cases" id="no_of_cases" min="1" value="1" placeholder="Maximum length 3 digit" class="input-panel">
                                        </div>
                                    </div>

                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Contact No.</label>
                                            <input type="text" class="input-panel" placeholder="Enter 10 digit mobile number" minlength="10" maxlength="10" id="mobile" name="mobile" title="10 digit mobile number">
                                        </div>
                                    </div>

                                    <div class="col-la-6 col-me-4 col-sm-6">
                                        <div class="form-panel">
                                            <label>Description</label>
                                            <textarea class="input-panel" name="description" id="description" rows="3"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-la-6 col-me-6 col-sm-6">
                                        <div class="form-panel file-upload-part ">
                                            <p class="primary-color margin-bottom-sm">File Attachment</p>
                                            <div class="upload-file-container">
                                                <input type="file" class="file-upload" id="file_upload" name="file_upload[]" multiple="">
                                            </div>
                                            <a href="javascript:void(0);" class="link-gray text-decoration upload-file-btn"><i class="material-icons">cloud_upload</i>Click here to select file</a> <small class="error-color">(Max size 10MB, Max 7 files)</small>
                                            <ul class="list-no-bullet file-name-list">
                                            </ul>                                  
                                        </div>
                                        <span class="error-message"></span>
                                    </div>
                                    <div class="clearfix"></div> 
                                    <div class="col-la-4 col-me-4 col-sm-6">                                        
                                        <div class="form-panel">
                                            <button type="submit" class="button button-info " id="form_submits"><i class="material-icons">save</i>Save</button>
                                            <button type="reset" class="button button-gray"><i class="material-icons">not_interested</i>Reset</button>
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
   
    $("#frm_add_edit button[type=reset]").on('click', function(){
        var form = $('#frm_add_edit');
        form.find('input[name=department]').val(0);
        form.find('input[name=category]').val(0);
        form.find('input[name=sub_category]').val(0);
        form.find('input[name=mobile]').val(0);
        form.find('textarea[name=description]').val(0);
    });

    //  Validation
    $("#frm_add_edit").on('submit', function(){

        var dis_form = $(this);
        
        var is_valid = true;
        var has_error ='';

        var regex = /^[0-9\_]+$/;
    
        $("#div_err").hide("slow");

        if(dis_form.find("select[name=department]").val() == ""){
            markAsError(dis_form.find("select[name=department]"),'Description is required!');
            is_valid = false;
        }
        if(dis_form.find("select[name=category]").val() == ""){
            markAsError(dis_form.find("select[name=category]"),'Category is required!');
            is_valid = false;
        }
        if(dis_form.find("select[name=sub_category]").val() == ""){
            markAsError(dis_form.find("select[name=sub_category]"),'Sub category is required!');
            is_valid = false;
        }
        if($("#no_of_cases").val().length > 3){
            markAsError(dis_form.find("input[name=no_of_cases]"),'No. of cases should be 3 digit only!');
            is_valid = false;
        }
        if(dis_form.find("input[name=mobile]").val() == ""){
            markAsError(dis_form.find("input[name=mobile]"),'Mobile is required!');
            is_valid = false;
        }
        if(!regex.test(dis_form.find("input[name=mobile]").val())){
            markAsError(dis_form.find("input[name=mobile]"),'Phone number should be digits only.');
            is_valid = false;
        }
        if(dis_form.find("textarea[name=description]").val() == ""){
            markAsError(dis_form.find("textarea[name=description]"),'Description is required!');
            is_valid = false;
        }
        
        return is_valid ;
    });

    $('input#file_upload').change(function(){
        var files = $('input#file_upload')[0].files;
        var Size = files[0].size/1024/1024; //MB
        var fileSize = parseFloat(Size).toFixed(2);
        if(files.length > 7){
            $('.error-message').text("You can select max 6 files.");
            $('#form_submits').prop("disabled", true); 
            return false;
        }else if(fileSize > 10)
        {
            $('.error-message').text("File size should be less than 10mb.");
            $('#form_submits').prop("disabled", true); 
            return false;     
        }
        else{
            $('.error-message').text("");
            $('#form_submits').prop("disabled", false);
            return true;
        }
    });

    $(document).delegate('.file-close', 'click',function(){
        $('#form_submits').prop("disabled", false);
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
                }
                hideLoader(childLocationElementId);
            }
        });
        
        return true;
    }
}

</script>  

@endsection
