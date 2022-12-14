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
                            <form method="post" id="frm_add_edit" name="frm_add_edit" action="{{ action('TaskController@ticketCompleteAttachments') }}" enctype="multipart/form-data">
                                {{csrf_field()}}

                                <input name="id" type="hidden" value="{{ $id }}" >
                                
                                <div class="row ">
                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Department</label>
                                            <?php
                                                $table = config( 'app.CUSTOM_CONFIG.DB_TABLES.DEPARTMENT_MASTER');
                                                $where = "id = ".$detail->department_id;
                                                $department = getRowFromTable($table, $where);
                                            ?>
                                            <input type="text" class="input-panel" id="department" name="department" value="{{ $department->long_name }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Category</label>
                                            <?php
                                                $catTable = config( 'app.CUSTOM_CONFIG.DB_TABLES.CATEGORY_MASTER');
                                                $where = "id = ".$detail->category_id;
                                                $category = getRowFromTable($catTable, $where);
                                            ?>
                                            <input type="text" class="input-panel" id="category" name="category" value="{{ $category->name }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>Sub Category</label>
                                            <?php
                                                $where = "id = ".$detail->subcategory_id;
                                                $subcategory = getRowFromTable($catTable, $where);
                                            ?>
                                            <input type="text" class="input-panel" id="subcategory" name="subcategory" value="{{ $subcategory->name }}" disabled>
                                        </div>
                                    </div>

                                    <div class="col-la-2 col-me-3 col-sm-6">
                                        <div class="form-panel">
                                            <label>No. of Cases</label>
                                            <input type="text" name="no_of_cases" id="no_of_cases" value="{{ $detail->no_of_cases }}" class="input-panel" disabled>
                                        </div>
                                    </div>

                                    <div class="col-la-12 col-me-4 col-sm-6">
                                        <div class="form-panel">
                                            <label>Description</label>
                                            <textarea class="input-panel" name="old_description" id="old_description" rows="3" disabled>{{ $detail->description }}</textarea>
                                        </div>
                                    </div>

                                    <div class="col-la-3 col-me-2 col-sm-6">
                                        <div class="form-panel file-upload-part ">
                                            <p class="primary-color">File Attachment</p>
                                            <div class="upload-file-container">
                                                <input type="file" class="file-upload" id="file_upload" name="file_upload[]" multiple="">
                                            </div>
                                            <a href="javascript:void(0);" class="link-gray text-decoration upload-file-btn"><i class="material-icons">cloud_upload</i>Click here to select file</a>
                                            <ul class="list-no-bullet file-name-list">
                                            </ul>                                  
                                        </div> 
                                        <span class="error-message"></span>
                                    </div>

                                    <div class="col-la-3 col-me-2 col-sm-6">
                                        <div class="form-panel">
                                            <label>Ticket Status</label>
                                            <select class="input-panel" name="t_status" id="t_status">
                                                <option value="0">Assigned</option>
                                                <option value="1">Complete</option>
                                            </select>    
                                            <span class="error-message"></span>
                                        </div>
                                    </div>

                                    <div class="col-la-3 col-me-2 col-sm-6 reason-sec" style="display:none;">
                                        <div class="form-panel">
                                            <label>Reason</label>
                                            <select class="input-panel" name="reason" id="reason">
                                                <option value="">-- Select Reason --</option>
                                                <?php echo getReasons(1); ?>
                                            </select>    
                                            <span class="error-message"></span>
                                        </div>
                                    </div>

                                    <div class="col-la-3 col-me-2 col-sm-6 re_description-sec" style="display:none;">
                                        <div class="form-panel">
                                            <label>Complete Description</label>
                                            <textarea class="input-panel" name="description" id="description"></textarea>
                                        </div>
                                    </div>
                                    
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
    });

    $('#t_status').change(function(){
        var status = $(this).val();
        
        if(status == 1){
            $('.reason-sec').show(500);
            $('.re_description-sec').show(500);
            $('#reason').attr("required", true);
        }else{
            $('.reason-sec').hide(500);
            $('.re_description-sec').hide(500);
            $('#reason').removeAttr('required');
        }
    });
    
}); 

</script>  

@endsection
