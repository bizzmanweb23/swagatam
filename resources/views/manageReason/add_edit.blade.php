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
                    <h4 class="primary-color">Reason Details</h4>
                    <div class="equal-height-card ">
                        <div class="item-details margin-bottom-sm itemDetails-active">
                            <form method="post" id="frm_add_edit" name="frm_add_edit" action="{{ action('ReasonController@edit') }}" enctype="multipart/form-data">
                                {{csrf_field()}}

                                @if($mode == 'Edit')
                                <input name="id" type="hidden" value="{{ $id }}" >
                                @endif
                                
                                <div class="row ">
                                    
                                    <?php
                                        $type = '';
                                        if($mode == 'Edit') $type = $detail->type;
                                    ?>

                                   <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Type</label>
                                            <select class="input-panel" name="reason_type" id="reason_type">
                                                <option value=""> Select </option>

                                               <option value="1" <?php echo ($type == 1)? "selected" : ""; ?>>Complete</option>
                                               <option value="2" <?php echo ($type == 2)? "selected" : ""; ?>>Re-Open</option>
                                               <option value="3" <?php echo ($type == 3)? "selected" : ""; ?>>Re-Initiate</option>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-la-2 col-me-2 col-sm-6">
                                        <div class="form-panel">
                                            <label>Reason</label>
                                            <textarea class="input-panel" name="reason_text" id="reason_text" rows="3">{!! ($mode == 'Edit') ? $detail->reason : '' !!}</textarea>
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
        form.find('select[name=reason_type]').val(0);
        form.find('textarea[name=reason_text]').val(0);
    });

    //  Validation
    $("#frm_add_edit").on('submit', function(){
        var dis_form = $(this);

        var is_valid = true;
        var has_error ='';
    
        $("#div_err").hide("slow");

        if(dis_form.find("select[name=reason_type]").val() == ""){
            markAsError(dis_form.find("select[name=reason_type]"),'Type is required!');
            is_valid = false;
        }
        if(dis_form.find("textarea[name=reason_text]").val() == ""){
            markAsError(dis_form.find("textarea[name=reason_text]"),'Reason is required!');
            is_valid = false;
        }
        
        return is_valid ;
    });
}); 

</script>  

@endsection
