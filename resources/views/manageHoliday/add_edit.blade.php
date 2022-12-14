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
                    <h4 class="primary-color">Holiday Details</h4>
                    <div class="equal-height-card ">
                        <div class="item-details margin-bottom-sm itemDetails-active">
                            <form method="post" id="frm_add_edit" name="frm_add_edit" action="{{ action('HolidayController@edit') }}" enctype="multipart/form-data">
                                {{csrf_field()}}

                                @if($mode == 'Edit')
                                <input name="id" type="hidden" value="{{ $id }}" >
                                @endif
                                
                                <div class="row ">
                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Regional</label>
                                            <select class="input-panel" name="ro_office_id" id="ro_office_id">
                                                <option value=""> Select </option>
                                                <?php echo getRoLists(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Holiday Date</label>
                                            <div class="form-panel">
                                                <input type="text" name="holiday_date" id="holiday_date" placeholder="Holiday Date" class="input-panel" data-role="datepicker2" value="" readonly="true" autocomplete="off" />
                                            </div>
                                        </div> 
                                    </div>

                                    <div class="col-la-2 col-me-2 col-sm-6">
                                        <div class="form-panel">
                                            <label>Holiday Name</label>
                                            <input type="text" placeholder="Holiday Name" class="input-panel" name="holiday_name" id="holiday_name" value="" >
                                            <span class="error-message"></span>
                                            
                                        </div>
                                    </div>

                                    <div class="col-la-1 col-me-3 col-sm-6">
                                        <div class="clearfix"></div> 
                                        <label>&nbsp; </label>
                                        <div class="form-panel"><strong>OR</strong></div>
                                    </div>

                                    <div class="col-la-2 col-me-2 col-sm-6">
                                        <div class="form-panel">
                                            <label>Upload Holiday CSV File</label>
                                            <input type="file" class="input-panel file-upload" id="file_upload" name="file_upload">
                                            <span><strong>(Only CSV File Import.)</strong></span>
                                           <label id="file_upload-error" class="error" for="file_upload"></label>                                            
                                        </div>
                                    </div>

                                <!-- </div> -->

                                    
                                    <div class="col-la-3 col-me-2 col-sm-6">
                                        <div class="clearfix"></div> 
                                        <label>&nbsp; </label>
                                        <div class="form-panel">
                                            <button type="submit" id="form_submits" class="button button-info"><i class="material-icons">save</i>Save</button>
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
        form.find('input[name=holiday_date]').val(0);
        form.find('input[name=holiday_name]').val(0);
        form.find('select[name=ro_office_id]').val(0);
    });

    //  Validation
    $("#frm_add_edit").on('submit', function(){
        var dis_form = $(this);

        var is_valid = true;
        var has_error ='';
    
        $("#div_err").hide("slow");

        if(dis_form.find("select[name=ro_office_id]").val() == ""){
            markAsError(dis_form.find("select[name=ro_office_id]"),'Regional is required!');
            is_valid = false;
        }
        if(dis_form.find("input[name=holiday_date]").val() == ""){
            markAsError(dis_form.find("input[name=holiday_date]"),'Holiday Date is required!');
            is_valid = false;
        }
        if(dis_form.find("input[name=holiday_name]").val() == ""){
            markAsError(dis_form.find("input[name=holiday_name]"),'Holiday Name is required!');
            is_valid = false;
        }
        
        return is_valid ;
    });

    $('input#file_upload').change(function(){
        var files = $('input#file_upload')[0].files;
        var Size = files[0].size/1024/1024; //MB
        var fileSize = parseFloat(Size).toFixed(2);
        if(files[0].name.toLowerCase().lastIndexOf(".csv")==-1) 
        {
            alert("Please upload only .csv extention file");
            $('#form_submits').attr("disabled", "disabled");
            return false;
        }
        else if(fileSize > 10)
        {
            $('#file_upload-error').text("File size should be less than 10mb.");
            $('#form_submits').attr("disabled", "disabled");
            return false;     
        }
        else{
            $('#file_upload-error').text("");
            $('#form_submits').removeAttr("disabled");
            return true;
        }
    });

});

$(function() {

    var selected_from_date = '';
    var selected_to_date = '';
            
    $('[data-role="datepicker2"]' ).datepicker({
        showOn: "both",
        buttonText: "<i class='material-icons'>date_range</i>",
        dateFormat: 'dd-mm-yy',
        onSelect : function(date,inst)
                {
                    var selected_date = date.split('-');
                    var cur_date = new Date();
                    var from_date = new Date((selected_date[2]+'-'+selected_date[1]+'-'+selected_date[0]));
                    
                    cur_date = cur_date.getDate()+'-'+cur_date.getMonth()+'-'+cur_date.getFullYear();
                    from_date = from_date.getDate()+'-'+from_date.getMonth()+'-'+from_date.getFullYear(); 
                }
    }); 
}); 

</script>  

@endsection
