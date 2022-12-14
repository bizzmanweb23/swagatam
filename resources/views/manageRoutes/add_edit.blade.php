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
                    <h4 class="primary-color">Route Details</h4>
                    <div class="equal-height-card ">
                        <div class="item-details margin-bottom-sm itemDetails-active">
                            <form method="post" id="frm_add_edit" name="frm_add_edit" action="{{ action('SamadhanRoutesController@edit') }}" enctype="multipart/form-data" <?php if($mode != 'Edit') { ?>onsubmit="return check();"<?php } ?>>
                                {{csrf_field()}}

                                <input type="hidden" name="mode" value="{{ $mode }}"> 

                                @if($mode == 'Edit')
                                <input name="hide_department_id" type="hidden" value="{{ $department_id }}">
                                <input name="hide_category_id" type="hidden" value="{{ $category_id }}" >
                                <input name="hide_subcategory_id" type="hidden" value="{{ $subcategory_id }}" >
                                @endif
                                
                                <div class="row ">
                                    <div class="col-la-4 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Department</label>
                                            <select class="input-panel" name="department" id="department_id" onchange="categoryAjax(this.value);samadhanRoleAjax();" <?php if($mode =='Edit') { ?> disabled <?php } ?>>
                                                <option value=""> Select </option>

                                                <?php $departments = getDepartments(); ?>
                                                <?php foreach($departments as $department): ?>
                                                    
                                                    <option value="<?php echo $department['id']; ?>" {!! ($mode == 'Edit')? (($department['id'] == $department_id)? 'selected' : '') : '' !!}><?php echo $department['short_name']; ?></option>

                                                <?php endforeach; ?>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-la-4 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Category</label>
                                            <select class="input-panel" name="category" id="category_id" onchange="subcategoryAjax(this.value);" <?php if($mode =='Edit') { ?> disabled <?php } ?>>
                                                <option value=""> Select </option>
                                                @if($mode == 'Edit')

                                                    {!! getCategorySubcategoryOptions(0, $category_id, $department_id) !!}

                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-la-4 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Sub Category</label>
                                            <select class="input-panel" name="sub_category" id="sub_category_id" <?php if($mode =='Edit') { ?> disabled <?php } ?>>
                                                <option value=""> Select </option>
                                                @if($mode == 'Edit')

                                                    {!! getCategorySubcategoryOptions($category_id, $subcategory_id, $department_id) !!}

                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row main-clone-orders">

                                    <?php $role_array = array(); $rankArray = array(); ?>
                                    <?php if($mode == 'Edit'): ?>

                                    <?php $rw_count = 0; ?>
                                    <?php foreach($detail as $val): ?>

                                    <?php $role_array[] = trim($val->role_id); $rankArray[] = trim($val->rank_order); ?>
                       
                                    <input type="hidden" name="edit_id[]" value="<?php echo $val->id; ?>">

                                    <div class="clone-orders <?php echo ($rw_count != 0)? 'clone-copy': '' ?>">
                                        <div class="col-la-3 col-me-3 col-sm-6">
                                            <div class="form-panel">
                                                <label>Role</label>
                                                <select class="input-panel role-values role-sec" name="role_id[]" onchange="selectedRoles(this);">
                                                    <option value=""> Select </option>
                                                    <?php echo getRole($val->role_id,$department_id); ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-la-3 col-me-3 col-sm-6">
                                            <div class="form-panel">
                                                <label>Rank</label>
                                                <select class="input-panel rank-values rank-sec" name="rank_id[]" onchange="selectedRank(this);">
                                                    <option value=""> Select </option>
                                                    <?php
                                                        foreach(range(1,15) as $i)
                                                        { 
                                                            $Selected = ($val->rank_order == $i)? 'selected':'';
                                                            echo "<option value='".$i."'  ".$Selected.">".$i."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <?php
                                
                                            $tat_data = explode('.',$val->tat);
                                        ?>

                                        <div class="col-la-2 col-me-3 col-sm-6">
                                            <div class="form-panel">
                                                <label>TAT</label>
                                                <input type="number" class="input-panel tat-sec tat-sec-hr" name="tat_hr[]" title="Set TAT (Turn Around Time)" id="tat_hr" placeholder="Hour" value="<?php echo $tat_data[0]; ?>" min="1">
                                            </div>
                                        </div>
                                        <div class="col-la-2 col-me-3 col-sm-6">
                                            <div class="form-panel">
                                                <label>&nbsp;</label>
                                                <input type="number" class="input-panel tat-sec tat-sec-min" placeholder="Minute" name="tat_min[]" title="Set TAT (Turn Around Time)" id="tat_min" value="<?php echo $tat_data[1]; ?>" min="0">
                                            </div>
                                        </div>
                                    </div>

                                    <?php $rw_count++; ?>

                                    <?php endforeach; ?>

                                    <?php else: ?>

                                    <div class="clone-orders">
                                        <div class="col-la-3 col-me-3 col-sm-6">
                                            <div class="form-panel">
                                                <label>Role</label>
                                                <select class="input-panel role-values role-sec" name="role_id[]" onchange="selectedRoles(this);">
                                                    <option value=""> Select </option>
                                                    
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-la-3 col-me-3 col-sm-6">
                                            <div class="form-panel">
                                                <label>Rank</label>
                                                <select class="input-panel rank-values rank-sec" name="rank_id[]" onchange="selectedRank(this);">
                                                    <option value=""> Select </option>
                                                    <?php
                                                        foreach(range(1,15) as $i)
                                                        {
                                                            echo "<option value='".$i."'>".$i."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-la-2 col-me-3 col-sm-6">
                                            <div class="form-panel">
                                                <label>TAT</label>
                                                <input type="number" class="input-panel tat-sec tat-sec-hr" name="tat_hr[]" title="Set TAT (Turn Around Time)" id="tat_hr" placeholder="Hour" value="" min="1">
                                            </div>
                                        </div>
                                        <div class="col-la-2 col-me-3 col-sm-6">
                                            <div class="form-panel">
                                                <label>&nbsp;</label>
                                                <input type="number" class="input-panel tat-sec tat-sec-min" placeholder="Minute" name="tat_min[]" title="Set TAT (Turn Around Time)" id="tat_min" value="" min="0">
                                            </div>
                                        </div>
                                    </div>

                                    <?php endif; ?>

                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="clearfix"></div> 
                                        <label>&nbsp; </label>
                                        <div class="form-panel">
                                            <button type="button" style="margin:0px;" class="button btn-primary add-more" id="add_more"><i style="margin-right:0px;" class="fas fa-plus" aria-hidden="true"></i></button>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">    
                                    <div class="col-la-12 col-me-12 col-sm-12">
                                        <div class="clearfix"></div> 
                                        <label>&nbsp; </label>
                                        <div class="form-panel">
                                            <button type="submit" class="button button-info"><i class="material-icons">save</i>Save</button>
                                            <button type="reset" class="button button-gray"><i class="material-icons">not_interested</i>Reset</button>
                                        </div>
                                    </div>  
                                </div>
                                <input type="hidden" name="selected_role" class="selected-role" id="selected_role" value="<?php echo implode(',',$role_array); ?>">
                                <input type="hidden" name="selected_rank" class="selected-rank" id="selected_rank" value="<?php echo implode(',',$rankArray); ?>">
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
        form.find('select[name=department]').val(0);
        form.find('select[name=category]').val(0);
        form.find('select[name=sub_category]').val(0);
    });

    //  Validation
    $("#frm_add_edit").on('submit', function(){
        var dis_form = $(this);

        var is_valid = true;
        var has_error ='';
    
        $("#div_err").hide("slow");

        var err = 0;
        
        $( ".tat-sec-min" ).each( function( index, element ){    
            if($(this).val() == "")
            {
                var $msg ='Tat Minute is required!';
                viewMessage($msg);
                err = 1;
                return false;
            }
            if($(this).val() > 59)
            {
                var $msg ='Minute must be less than 60';
                viewMessage($msg);
                err = 1;
                return false;
            }    
        });
        $( ".tat-sec-hr" ).each( function( index, element ){    
            if($(this).val() == "" || $(this).val() == "0")
            {
                var $msg ='TAT Hour is required!';
                viewMessage($msg);
                err = 1;
                return false;
            }
            if($(this).val() > 999)
            {
                var $msg ='Invalid TAT Hour!';
                viewMessage($msg);
                err = 1;
                return false;
            }
            
        });
        $( ".rank-sec" ).each( function( index, element ){    
            if($(this).val() == "")
            {
                var $msg ='Rank is required!';
                viewMessage($msg);
                err = 1;
                return false;
            }
        });
        $( ".role-sec" ).each( function( index, element ){
            if($(this).val() == "")
            {
                var $msg ='Role is required!';
                viewMessage($msg);
                err = 1;
                return false;
            }
        });

        var selectedRoles = $('.selected-role')?.val()?.split(",");
        var selectedRanks = $('.selected-rank')?.val()?.split(",");

        if(selectedRoles && Array.isArray(selectedRoles)){
            var uniqueRoles = selectedRoles.filter((v, i, a) => a.indexOf(v) === i);
            if(selectedRoles.length != uniqueRoles.length){
                var $msg = "Duplicate role selected!";
                viewMessage($msg);
                err = 1;
            }
        }

        if(selectedRanks && Array.isArray(selectedRanks)){
            var uniqueRanks = selectedRanks.filter((v, i, a) => a.indexOf(v) === i);
            if(selectedRanks.length != uniqueRanks.length){
                var $msg = "Duplicate rank selected!";
                viewMessage($msg);
                err = 1;
            }
        }

        if(dis_form.find("select[name=department]").val() == ""){
            var $msg = "Department is required!";
            viewMessage($msg);
            is_valid = false;
        }
        else if(dis_form.find("select[name=category]").val() == ""){
            var $msg = "Category is required!";
            viewMessage($msg);
            is_valid = false;
        }
        else if(dis_form.find("select[name=sub_category]").val() == ""){
            var $msg = "Subcategory is required!";
            viewMessage($msg);
            is_valid = false;
        }
        else if(err == 1){ is_valid = false; }
        else{ is_valid = true; }
  
        return is_valid ;
    });


    //var data_fo = $('.clone-orders').first().html();
    var sd = '<div class="col-la-2 col-me-3 col-sm-6"><div class="clearfix"></div><label>&nbsp; </label><div class="form-panel"><button style="margin:0px;" type="button" class="button btn-primary remove-add-more"><i style="margin-right:0px;" class="fas fa-minus" aria-hidden="true"></i></button></div></div>';
    var max_fields = 15; //maximum input boxes allowed
    var wrapper = $(".main-clone-orders"); //Fields wrapper
    var add_button = $(".add-more"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click 
      e.preventDefault();   
      if(x < max_fields){
        x++;  
        var partnerClone = $('.clone-orders').first().clone(); 
        $(sd).appendTo(partnerClone);  
        $(wrapper).append(partnerClone);  
        $(wrapper).find('.clone-orders').last().addClass('clone-copy'); 
        $(wrapper).find('.clone-copy .tat-sec-hr').last().val('');   
        $(wrapper).find('.clone-copy .tat-sec-min').last().val('');   
        $(wrapper).find('.clone-copy .rank-sec').last().val('');   
        $(wrapper).find('.clone-copy .role-sec').last().val('');   
      }
    });

    $(wrapper).on("click",".remove-add-more", function(e){ //user click on remove text
        e.preventDefault();
        $(this).parents('.clone-orders').remove();
        $(this).remove();
        /* Set Role Values in hidden field */
        var allVals = [];
        $('.main-clone-orders .role-values').each(function () {
           if($(this).val() != '') 
                allVals.push($(this).val());
        });
        $('.selected-role').val(allVals);
        
        /* Set Rank Values in hidden field */
        var allRankVals = [];
        $('.main-clone-orders .rank-values').each(function () {
           if($(this).val() != '') 
                allRankVals.push($(this).val());
        });  
        $('.selected-rank').val(allRankVals);
        
        x--;
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

function samadhanRoleAjax()
{

    var departmentId = $('#department_id').val();
    var selectedRole = $('.selected-role').val();

    var childLocationElementId = ".selected-role";
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

   /* selected role saved in hidden fields */
function selectedRoles(data)
{
    var allVals = [];
    var array = $('.selected-role').val().split(",");
    if(jQuery.inArray(data.value, array) != -1) {
        var $msg = "This role aleady selected.Please choose another one.";
        viewMessage($msg);
        
        // allVals.push(data.value);
        // $('.selected-role').val(allVals);
        
        $(data).val('');
        return false;
    }
    $('.main-clone-orders .role-values').each(function () {
       if($(this).val() != '') 
            allVals.push($(this).val());
    });  
    $('.selected-role').val(allVals);
}
function selectedRank(data)
{
    var allRankVals = [];
    var array = $('.selected-rank').val().split(",");
    if(jQuery.inArray(data.value, array) != -1) {
        var $msg = "This rank aleady selected.Please choose another one.";
        viewMessage($msg);
        
        // allRankVals.push(data.value);
        // $('.selected-rank').val(allRankVals);
        
        $(data).val('');
        return false;
    }
    $('.main-clone-orders .rank-values').each(function () {
       if($(this).val() != '') 
            allRankVals.push($(this).val());
    });  
    $('.selected-rank').val(allRankVals);
}

/* check duplicate routes */
 function check()
{
    var department = $('#department_id').val();
    var category = $('#category_id').val();
    var subcategory = $('#sub_category_id').val();

    if(department == ""){
        var $msg = 'Department is required!';
        viewMessage($msg);
        return false;
    }
    if(category == ""){
        var $msg = 'Category is required!';
        viewMessage($msg);
        return false;
    }
    if(subcategory == ""){
        var $msg ='Subcategory is required!';
        viewMessage($msg);
        return false;
    }
    var err = 0;
    $( ".role-sec" ).each( function( index, element ){
        if($(this).val() == "")
        {
            var $msg ='Role is required!';
            viewMessage($msg);
            err = 1;
            return false;
        }
    });
    $( ".rank-sec" ).each( function( index, element ){    
        if($(this).val() == "")
        {
            var $msg ='Rank is required!';
            viewMessage($msg);
            err = 1;
            return false;
        }
    });
    $( ".tat-sec-hr" ).each( function( index, element ){    
        if($(this).val() == "" || $(this).val() == "0")
        {
            var $msg ='TAT Hour is required!';
            viewMessage($msg);
            err = 1;
            return false;
        }
        if($(this).val() > 999)
        {
            var $msg ='Invalid TAT Hour!';
            viewMessage($msg);
            err = 1;
            return false;
        }
        
    });
    $( ".tat-sec-min" ).each( function( index, element ){    
        if($(this).val() == "")
        {
            var $msg ='Tat Minute is required!';
            viewMessage($msg);
            err = 1;
            return false;
        }
        if($(this).val() > 59)
        {
            var $msg ='Minute must be less than 60';
            viewMessage($msg);
            err = 1;
            return false;
        }
        
    });
    if(err == 1) return false;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: base_url + "ajax/ajax-routes-check",
        type: "post",
        data: { 'department_id': department, 'category_id': category ,'subcategory_id': subcategory },
        dataType: "json",
        success: function(response) {
            if(response != 0)
            {
                var $msg = "Error! This route alredy taken.";
                viewMessage($msg);

                return false;
            }
            else{
                document.frm_add_edit.submit();
            }
        }
    });
    return false;
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
