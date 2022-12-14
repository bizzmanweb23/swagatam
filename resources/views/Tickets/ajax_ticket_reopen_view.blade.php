@if($details)
<div class="">
    <h3 class="position-center align-center primary-color margin-bottom-3"><u>Ticket Reopen</u></h3>
    
    <div class="row">
        <div class="col-me-12" id="div-branch-exceptions">
            <form method="post" id="frm_ticket_reopen" class="frm_ticket_reopen" name="frm_ticket_reopen" action="" autocomplete="off" enctype="multipart/form-data">
                {{csrf_field()}}
                <input name="ticket_id" id="ticket_id" type="hidden" value="{{ $ticket_id }}" >
                <div class="card">
                    <div class="card-container">
                        <div class="row ">
                            <div class="col-la-12 col-me-4 col-sm-6">
                                <div class="form-panel">
                                    <label>Reason <span class="error-color">*</span></label>
                                    <select class="input-panel" name="reason" id="reason">
                                        <option value="">-- Select Reason --</option>
                                        <?php echo $details; ?>
                                    </select>    
                                    <span class="error-message"></span>
                                </div>
                            </div>

                            <div class="col-la-12 col-me-4 col-sm-6">
                                <div class="form-panel">
                                    <label>Description</label>
                                    <textarea class="input-panel" name="description" id="description"></textarea>
                                </div>
                            </div>

                            <div class="col-la-12 col-me-4 col-sm-6">
                                <div class="form-panel">
                                    <button type="submit" class="button button-info submit-reopen"><i class="material-icons">save</i>Save</button>
                                    <button type="reset" class="button button-gray"><i class="material-icons">not_interested</i>Reset</button>
                                </div>
                            </div>  
                        </div>
                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div>
    <p>No Record Found</p>
</div>
@endif

<script type="text/javascript">   

// Display error
var markAsError = function(selector,msg,animate){
    //$('html, body').animate({scrollTop : 0},800);
    $(selector).next('.error-message').html(msg);    
    $(selector).parents('.form-panel').addClass("error");
    $(selector).on('focus',function(){
        removeAsError($(this));
    });
}

$(document).ready(function() {

    $(".submit-reopen").on('click', function() {
        var is_valid = false;
        var has_error ='';

        if($('#reason').val() == ""){
            markAsError($('#reason'),'Reason is required!');
            is_valid = false;
        }
        
        var obj_branch_exceptions = $('#reason');
        
        // Check reason available
        if(obj_branch_exceptions.val()){
            var ticket_id = $("#ticket_id").val();
            var reason = $('#reason').val();
            var description = $('#description').val();
            
            showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
            
            var ajax_url = base_url + 'ajax/ajax-reopen-saved';
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: ajax_url,
                type: "POST",
                data: { 'ticket_id':ticket_id, 'reason': reason, 'description': description },
                dataType: 'json',
                success: function(data) {
                    if (data.flag=='error') {
                        markAsError(obj_product_code, data.msg);
                        is_valid = false;
                    } else {
                        hideLoader("body");
                        showUIMsg(data.msg);
                        $.magnificPopup.close();
                        window.location.reload();
                    }
                }
            });
        }
        return is_valid;
    });
});

</script>