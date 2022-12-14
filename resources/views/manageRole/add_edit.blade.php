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
                    <h4 class="primary-color">Role Details</h4>
                    <div class="equal-height-card ">
                        <div class="item-details margin-bottom-sm itemDetails-active">
                            <form method="post" id="frm_add_edit" name="frm_add_edit" action="{{ action('SamadhanRoleController@edit') }}" enctype="multipart/form-data">
                                {{csrf_field()}}

                                @if($mode == 'Edit')
                                <input name="id" type="hidden" value="{{ $id }}" >
                                @endif
                                
                                <div class="row ">
                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Department</label>
                                            <select class="input-panel" name="department" id="department" onchange="categoryAjax(this.value);">
                                                <option value=""> Select </option>

                                                <?php $departments = getDepartments(); ?>
                                                <?php foreach($departments as $department): ?>
                                                    
                                                    <option value="<?php echo $department['id']; ?>" {!! ($mode == 'Edit')? (($department['id'] == $detail->department_id)? 'selected' : '') : '' !!}><?php echo $department['short_name']; ?></option>

                                                <?php endforeach; ?>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <?php
                                        $offType = '';
                                        if($mode == 'Edit') $offType = $detail->type;
                                    ?>

                                   <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Type</label>
                                            <select class="input-panel" name="off_type" id="off_type">
                                                <option value=""> Select </option>

                                                <option value="BRANCH" <?php echo ($offType == 'BRANCH')? 'selected':''; ?>>BRANCH</option>
                                                <option value="REGIONAL" <?php echo ($offType == 'REGIONAL')? 'selected':''; ?>>REGIONAL</option>
                                                <option value="ZONAL" <?php echo ($offType == 'ZONAL')? 'selected':''; ?>>ZONAL</option>
                                                <option value="HEAD" <?php echo ($offType == 'HEAD')? 'selected':''; ?>>HEAD</option>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-la-2 col-me-2 col-sm-6">
                                        <div class="form-panel">
                                            <label>Role Name <span class="error-color">*</span></label>
                                            <input type="text" placeholder="Role Name" class="input-panel" name="role_name" maxlength="100" value="{!! ($mode == 'Edit') ? $detail->role_name : '' !!}" >
                                            <span class="error-message"></span>
                                            
                                        </div>
                                    </div>
                                <!-- </div> -->

                                    <div class="col-la-3 col-me-2 col-sm-6">
                                        <div class="clearfix"></div> 
                                        <label>&nbsp; </label>
                                        <div class="form-panel">
                                            <button type="submit" class="button button-info"><i class="material-icons">save</i>Save</button>
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
        form.find('input[name=role_name]').val(0);
        form.find('select[name=off_type]').val(0);
        form.find('select[name=department]').val(0);
    });

    //  Validation
    $("#frm_add_edit").on('submit', function(){
        var dis_form = $(this);

        var is_valid = true;
        var has_error ='';
    
        $("#div_err").hide("slow");

        if(dis_form.find("select[name=department]").val() == ""){
            markAsError(dis_form.find("select[name=department]"),'Department is required!');
            is_valid = false;
        }
        if(dis_form.find("select[name=off_type]").val() == ""){
            markAsError(dis_form.find("select[name=off_type]"),'Type is required!');
            is_valid = false;
        }
        if(dis_form.find("input[name=role_name]").val() == ""){
            markAsError(dis_form.find("input[name=role_name]"),'Role Name is required!');
            is_valid = false;
        }
        var format = /[!@#$%^&*()+\=\[\]{};':"\\|,.<>\/?]+/;

        if(format.test(dis_form.find("input[name=role_name]").val())){
            markAsError(dis_form.find("input[name=role_name]"),'Special characters not allowed in Role Name!');
            is_valid = false;
        }
        
        return is_valid ;
    });
}); 

</script>  

@endsection
