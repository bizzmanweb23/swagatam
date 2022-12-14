@extends('layouts.app')
@section('content')
<div class="admin-content-header">
	<h3 class="float-left-sm primary-color">{{ $heading?? 'Jobs Posting' }}</h3>
</div>

<div class="wrapper-fluid">
	<div class="row">
		<div class="col-la-2 col-me-6 col-sm-6">
			<div class="form-panel">
				<label class="hidden-es">&nbsp;</label>
				<div class="clearfix"></div>
				<a href="{{ route('add-job-form') }}" class="add-new-btn button button-info">Add New Job</a>
 			</div>
		</div>
	</div>
<section>
<form  id="search_form">{{ csrf_field() }}
<div class="row">
    <div class="col-la-12 col-me-12 col-sm-12">
        <div class="card">
            <div class="card-container clearfix">
                <div class="row">
                    <div class="col-la-2 col-me-3 col-sm-6">
                        <div class="form-panel">
                            <label for="statusSearch">Select Zone</label>
                            <div class="form-panel">
                                <select name="jobZone" id="zoneSearch" class="zone input-panel chosen-select">
																	<option value="">-- Select Zone --</option>
																	<option value="30001">Zone 1</option>
																	<option value="30002">Zone 2</option>
																	<option value="30003">Zone 3</option>
																	<option value="30004">Zone 4</option>
                                </select>
                                <span class="error-message"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-la-2 col-me-3 col-sm-6">
                        <div class="form-panel">
                            <label for="regionSearch">Region</label>

                            <div class="form-panel">
                                <select name="jobRegion" id="regionSearch" class="region input-panel select_custom_rgn"  >
																	<option value="4001">Region 1</option>
																	<option value="4002">Region 2</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-la-2 col-me-3 col-sm-6">
                        <div class="form-panel">
                            <label for="branchSearch">Branch</label>

                            <div class="form-panel">
                                <select name="jobBranch" id="branchSearch" class="branch input-panel select_custom_brnch"  >
																	<option value="30101">Amtala 1</option>
																	<option value="30102">Maheshtala</option>		
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-la-2 col-me-6 col-sm-6">
                        <div class="form-panel">
                            <label class="hidden-es">&nbsp;</label>
                            <div class="clearfix"></div>
                            <button type="button" search="2" id="search-form-btn" name="btn_submit" class="button button-info"><i class="material-icons">search</i> Search</button>
                            <span class="error-message"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
</section>
<div class="row">
<div class="col-la-12">
    <div class="card table-card">
            <div class="card-container clearfix">
            <h4 class="primary-color">Manage List</h4>
            <div class="table-responsive">
            <table class="table-border no-margin table-head-color manage-aircraft-table table-odd-even">
            <thead>
            <tr>
            <th class="align-center text-nowrap">Code</th>
            <th class="align-center text-nowrap">Title</th>
            <th class="align-center text-nowrap">Zone</th>
            <th class="align-center text-nowrap">Branch</th>
            <th class="align-center text-nowrap">Region</th>
            <th class="align-center text-nowrap">Validity Date</th>
            <th class="align-center text-nowrap">Effective Date</th>
            <th class="align-center text-nowrap">Created By</th>
            <th class="align-center text-nowrap">Updated By</th>
            <th class="align-center text-nowrap">Description</th>
            <th class="align-center text-nowrap">Action</th>
            </tr>
            </thead>
            <tbody class="table-body">

            </tbody>
            </table>
            </div>
            <div class="clearfix"></div>
            @include('pages.partials.sample-pagination-html')
            </div>
    </div>
</div>
</div>
</div>
@include('layouts.delete_confirmation_modal')
@endsection

@section('js')
<script src="{{asset('js/chosen/chosen.jquery.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function()
{

	//table data
  $('.data-table').empty();
  	$.ajax({
      url : '{{ url("get/data") }}',
      method : 'get',
      dataType : 'json',
      success : function(data){
      		$.each(data.data, function(key , value){
      		$row = '<tr>';
              $row += '<td class="align-left text-wrap">'+value.job_code+'</td>';
              $row += '<td class="align-left text-wrap">'+value.job_title+'</td>';
              $row += '<td class="align-left text-wrap">'+value.job_zone+'</td>';
              $row += '<td class="align-left text-wrap">'+value.s_office_name+'</td>';
              $row += '<td class="align-left text-wrap">'+value.s_office_name+'</td>';
              $row += '<td class="align-left text-wrap">'+value.job_validity_date+'</td>';
              $row += '<td class="align-left text-wrap">'+value.job_effective_date+'</td>';
              $row += '<td class="align-left text-wrap">'+value.job_created_by+'</td>';
              $row += '<td class="align-left text-wrap">'+value.job_updated_by+'</td>';
              $row += '<td class="align-left text-wrap">'+value.job_description+'</td>';
              $row += '<td class="align-center action-tooltip tooltip-width">';
              $row += '<div class="dropdownList">';
              $row += '<a onclick="openMenuList(this)"><i class="fa fa-bars dropbtn" aria-hidden="true"></i></a>';
              $row += '<div class="dropdownList-content">';
              $row += '<a href="javascript:void(0)" class="edit-job icon-button button-primary" value="'+value.job_id+'" id="edit_btn" ><i class="fas fa-edit"></i><span> Edit</span></a>';
              $row += '<a href="javascript:void(0)" class="deletepopup icon-button button-primary" value="'+value.job_id+'"><i class="fas fa-trash"></i><span >  Delete</span></a>';
              $row += '<a href="javascript:void(0)" class="view-job icon-button button-primary" value="'+value.job_id+'" ><i class="fas fa-eye"></i><span> View</span></a>';
              $row += '</div></div></td></tr>';
              $('.table-body').append($row);
        			});
        }
    });

	$('#search-form-btn').on('click', function(){
		$.ajax({
               url : "{{ url('search/job') }}",
               type : "post",
               dataType : 'json',
               data : $('#search_form').serialize(),
               success : function(data){
								 $('.table-body').empty();
								console.log(data);
								 $.each(data, function(key , value){
										 $row = '<tr>';
										 $row += '<td class="align-left text-wrap">'+value.job_code+'</td>';
										 $row += '<td class="align-left text-wrap">'+value.job_title+'</td>';
										 $row += '<td class="align-left text-wrap">'+value.job_zone+'</td>';
										 $row += '<td class="align-left text-wrap">'+value.s_office_name+'</td>';
										 $row += '<td class="align-left text-wrap">'+value.s_office_name+'</td>';
										 $row += '<td class="align-left text-wrap">'+value.job_validity_date+'</td>';
										 $row += '<td class="align-left text-wrap">'+value.job_effective_date+'</td>';
										 $row += '<td class="align-left text-wrap">'+value.job_created_by+'</td>';
										 $row += '<td class="align-left text-wrap">'+value.job_updated_by+'</td>';
										 $row += '<td class="align-left text-wrap">'+value.job_description+'</td>';
										 $row += '<td class="align-center action-tooltip tooltip-width">';
										 $row += '<div class="dropdownList">';
										 $row += '<a onclick="openMenuList(this)"><i class="fa fa-bars dropbtn" aria-hidden="true"></i></a>';
										 $row += '<div class="dropdownList-content">';
										 $row += '<a href="javascript:void(0)" class="edit-job icon-button button-primary" value="'+value.job_id+'" id="edit_btn" ><i class="fas fa-edit"></i><span> Edit</span></a>';
										 $row += '<a href="javascript:void(0)" class="deletepopup icon-button button-primary" value="'+value.job_id+'"><i class="fas fa-trash"></i><span >  Delete</span></a>';
										 $row += '<a href="javascript:void(0)" class="view-job icon-button button-primary" value="'+value.job_id+'" ><i class="fas fa-eye"></i><span> View</span></a>';
										 $row += '</div></div></td></tr>';
										 $('.table-body').append($row);
								 });

               } ,
               error : function(data){
								  $('.table-body').empty();
										 $error = '<tr><td colspan="11" class="align-left text-wrap text-center"><span class="px-auto">No Record Found</span></td></tr>';
                     $('.table-body').append($error);
               }
            });
  });

$(document).on('click','.edit-job', function(){
    $id = $(this).attr('value');
    $url = '{{ url("/") }}'+'/edit/job/'+$id;
    window.location.replace($url);
});

$(document).on('click','.deletepopup', function () {
            $delId  = $(this).attr('value');
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm!</h3><p class="margin-bottom-0">Are you sure you want to Delete?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="no_cancel">No</button><button type="button" class="button popup-modal-dismiss" id="yes_delete">Yes</button></div></div>';
            showPopUp(divElementSuccess);

            $('#yes_delete').click(function(){
            //window.location.replace( url );
                $.ajax({
                    url : '{{ url("delete/job" ) }}',
                    type : 'get',
                    data : {id :$delId },
                    success : function(data){
                         document.location.href = "{{ url('jobs') }}";
                    },
                    error : function(data){
                    alert('falire');
                    }

                });
            });
});

$(document).on('click','.view-job', function(){
    $id = $(this).attr('value');
    $url = '{{ url("/") }}'+'/view/job/'+$id;
    window.location.replace($url);
});
$(document).on('click','.go-back',function(){
    document.location.href = '{{ url("jobs") }}';
});

$(document).on('click','.save-job-btn', function(data){
    $job = $('#save_job_form').serialize();
  	$.ajax({
      url : '{{ url("store/job") }}',
      method : 'post',
      data : $job,
      success : function(response){
         $.magnificPopup.open({
                items: {
                            src: '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Job Added successfully </h3><p class="margin-bottom-0">{!! \Session::get('success') !!}</p></div><div class="alert-button alert-success"><button type="button" class="yes-updated button popup-modal-dismiss">Ok</button></div></div>',
                            type:'inline' ,
                        },
                        modal: true ,
                    });
                    $('.yes-updated').click(function(){
                        document.location.href = "{{ url('jobs') }}";
                    });
                },
                error : function(response){
                    $.each(response.responseJSON.errors, function(key, value){

                    });
                }
            });
        });
        //	Delete Insurance Fees
        $('.deletepopup').on('click', function () {
            var ret = false;
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm!</h3><p class="margin-bottom-0">Are you sure you want to Delete?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="no_cancel">No</button><button type="button" class="button popup-modal-dismiss" id="yes_delete">Yes</button></div></div>';
            showPopUp(divElementSuccess);

            var url = $(this).attr('href');
            $('#yes_delete').click(function(){
                window.location.replace( url );
            });
            return ret;
        });
});



</script>

<script type="text/javascript">

        $(".chosen-select").chosen();

        $(function() {
            $('.select_custom_brnch').multiselect({
                columns  : 1,
                search   : true,
                selectAll: true,
                texts    : {
                    placeholder: ' -- Select Branch -- ',
                    search     : 'Search Here'
                },
                minHeight: '150px',
                onControlClose: function( element ){
                }
            });
            $('.select_custom_rgn').multiselect({
                columns  : 1,
                search   : true,
                selectAll: true,
                texts    : {
                    placeholder: ' -- Select Region -- ',
                    search     : 'Search Here'
                },
                minHeight: '150px',
                onControlClose: function( element ){
                }
            });
            $('.select_custom_zone').multiselect({
                columns  : 1,
                search   : true,
                selectAll: true,
                texts    : {
                    placeholder: ' -- Select Zone -- ',
                    search     : 'Search Here'
                },
                minHeight: '150px',
                onControlClose: function( element ){
                }
            });
        });

        var saveSubmitFlag 	= false;

        $(function() {

            $('#forFromDateSearch' ).datepicker({
                showOn: "both",
                buttonText: "<i class='material-icons'>date_range</i>",
                dateFormat: 'dd-mm-yy',
                maxDate: '',
                onSelect : function(date,inst)
                {
                    var date2 = $('#forFromDateSearch').datepicker('getDate');
                    date2.setDate(date2.getDate() + 0);
                    $('#forToDateSearch').datepicker('setDate', date2);
                    //sets minDate to dt1 date + 1
                    $('#forToDateSearch').datepicker('option', 'minDate', date2);

                    var dt = new Date($('#forFromDateSearch').datepicker('getDate'));
                    // GET THE MONTH AND YEAR OF THE SELECTED DATE.
                    var month = dt.getMonth(),
                        year = dt.getFullYear();

                    // GET THE FIRST AND LAST DATE OF THE MONTH.
                    var FirstDay = new Date(year, month, 1);
                    var LastDay = new Date(year, month + 1, 0);
                    //sets minDate to dt1 date + 1
                    $('#forToDateSearch').datepicker('option', 'maxDate', LastDay);
                    $('#forToDateSearch').datepicker('setDate', LastDay);
                }
            });

            $('#forToDateSearch' ).datepicker({
                showOn: "both",
                buttonText: "<i class='material-icons'>date_range</i>",
                dateFormat: 'dd-mm-yy',
                maxDate: '',
                onSelect : function(date,inst)
                {
                }
            });

        });



        $(document).ready(function(){
            var user_access_type = "";
            var pageName = "";

            $('select[id^="change_application_status_"]').on('change',function(){
                $.magnificPopup.open({
                    items: {
                        src: '#status-confirm-popup'
                    },
                    type: 'inline',
                    midClick: true,
                    mainClass: 'my-mfp-zoom-in',
                    modal: true
                });
                var groupCode = $(this).attr("data-groupCode");
                var centerCode = $(this).attr("data-centerCode");
                var applicationStatus = $(this).val();

                if(applicationStatus == 'Rejected by BQH'){
                    $("#rejectReasonDiv").show();
                }else{
                    $("#rejectReasonDiv").hide();
                }
                $("#bqhStatText").text(applicationStatus);
                $('#yes_submit_form').val(applicationStatus);
                $('#yes_submit_form').attr("data-group",groupCode);
                $('#cancel_confirm').attr("data-group",groupCode);
                $('#yes_submit_form').attr("data-center",centerCode);
            });

            $("#btn_reset_search").click(function(){
                $("#frm_reset_search").submit();
            });

            $('#zoneSearch').on('change',function(){
                load_region_by_zone();
            });
            $('#regionSearch').on('change',function(){
                load_branch_by_region($('#regionSearch'));
            });
            if($('#zoneSearch').val()){
                load_region_by_zone();
            }

            if(user_access_type == 'REGION')
            {
                if($('#regionSearch').val()){
                    load_branch_by_region($('#regionSearch'));
                }
            }

            // forFromDateSearch  zoneSearch

            $('#searchForm').on('submit',function(){

                var b_valid = true;
                if (pageName.indexOf('/ManageArchivedApplication') !== -1)
                {
                    if( $('#forFromDateSearch').val() == '' || $('#forFromDateSearch').val() == null ){
                        markAsError($('#forFromDateSearch'),'This field is required!',1);
                        b_valid = false;
                    }
                }
                else
                {
                    if( $('#forFromDateSearch').val() == '' || $('#forFromDateSearch').val() == null ){
                        markAsError($('#forFromDateSearch'),'This field is required!',1);
                        b_valid = false;
                    }
                }


                return b_valid;
            });


            $('.viewTransactionDetail').on('click', function(){
                var groupCode = $(this).attr("data-groupCode");
                var transactionID = $(this).attr("data-ID");
                var h_extension = $('#h_extension').val(); // paas extension
                showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

                $("body").addClass('only-read-view');

                $.ajax({
                    url: base_url+"unapproved-application/ajax_view_details_archived",
                    type: "POST",
                    data: {
                        groupCode: groupCode,
                        transactionID: transactionID,
                        h_extension:h_extension
                    },
                    dataType: 'html',
                    beforeSend: function() {},
                    success: function(data) {
                        hideLoader("body");
                        $("body").removeClass('only-read-view');
                        var divElement = '';
                        divElement += data;
                        showPopUp(divElement);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                    }
                });
            });

            $('.recbcheck').on('click', function(){
                $.magnificPopup.open({
                    items: {
                        src: '#recbcheck-confirm-popup'
                    },
                    type: 'inline',
                    midClick: true,
                    mainClass: 'my-mfp-zoom-in',
                    modal: true
                });
                var groupCode = $(this).attr("data-groupCode");
                var transactionID = $(this).attr("data-ID");
                $('#yes_submit_form_recbcheck').attr("data-group",groupCode);
                $('#yes_submit_form_recbcheck').attr("data-ID",transactionID);
                $('#cancel_confirm_recbcheck').attr("data-group",groupCode);
                $('#cancel_confirm_recbcheck').attr("data-ID",transactionID);
            });

            $('.confirm_teleVerification').on('click', function(){
                $.magnificPopup.open({
                    items: {
                        src: '#approve-confirm-tele-verification-popup'
                    },
                    type: 'inline',
                    midClick: true,
                    mainClass: 'my-mfp-zoom-in',
                    modal: true
                });
                var groupCode = $(this).attr("data-groupCode");
                var transactionID = $(this).attr("data-ID");
                $('#yes_submit_form_approve_tele_verification').attr("data-group",groupCode);
                $('#yes_submit_form_approve_tele_verification').attr("data-ID",transactionID);
                $('#cancel_confirm_approve_tele_verification').attr("data-group",groupCode);
                $('#cancel_confirm_approve_tele_verification').attr("data-ID",transactionID);
            });

            $('.uploadNocDoc').on('click', function(){
                var transactionID = $(this).attr("data-ID");
                showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

                $("body").addClass('only-read-view');

                $.ajax({
                    url: base_url+"manage-applications/uploadNocDocView",
                    type: "POST",
                    data: {
                        transactionID: transactionID
                    },
                    dataType: "json",
                    beforeSend: function() {},
                    success: function(data) {
                        hideLoader("body");
                        $("body").removeClass('only-read-view');
                        var dispData = data[0];

                        var divElement = '<div class="order-details-center"><div class="popup-container popup-container-la"><h3 class="position-center align-center primary-color"><u>NOC Documents</u></h3><div class="clearfix"></div>';

                        divElement += '<div class="row" style="padding-top:35px;"><div class="col-me-12"><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody><tr><td class="font-bold text-nowrap sort-highlight">Branch</td><td class="text-nowrap">'+dispData.s_branch_name+' ('+dispData.s_branch_code+')</td><td class="font-bold text-nowrap sort-highlight">Center</td><td class="text-nowrap">'+((dispData.s_center_code != null)?dispData.s_center_name+' ('+dispData.s_center_code+')':'-')+'</td><td class="font-bold text-nowrap sort-highlight">Group</td><td class="text-nowrap">'+((dispData.s_group_code != null)?dispData.s_group_name+' ('+dispData.s_group_code+')':'-')+'</td></tr></tbody></table></div></div>';

                        var application_status = '';
                        if(dispData.s_application_status == '' || dispData.s_application_status == null){
                            if(dispData.i_last_step_saved == 8)
                            {
                                application_status = 'Disbursement Done';
                            }
                            else if(dispData.i_last_step_saved == 7)
                            {
                                application_status = 'GRT Done';
                            }
                            else if(dispData.i_last_step_saved == 6)
                            {
                                application_status = 'Cross Verification Done';
                            }
                            else if(dispData.i_last_step_saved == 5)
                            {
                                application_status = 'CGT 2 Done';
                            }
                            else if(dispData.i_last_step_saved == 4)
                            {
                                application_status = 'CGT 1 Done';
                            }
                            else if(dispData.i_last_step_saved == 3)
                            {
                                application_status = 'Group Formation Done';
                            }
                            else if(dispData.i_last_step_saved == 2)
                            {
                                application_status = 'Neighbour Feedback Done';
                            }
                            else if(dispData.i_last_step_saved == 1)
                            {
                                application_status = 'LAF Done';
                            }
                            else
                            {
                                application_status = '-';
                            }
                        }else{
                            application_status = dispData.s_application_status;
                        }

                        divElement += '<div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-0">Application Data</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody><tr><td class="font-bold text-nowrap sort-highlight">Application Date</td><td class="text-nowrap">'+dispData.dt_created_at.split(' ')[0].split('-')[2]+'-'+dispData.dt_created_at.split(' ')[0].split('-')[1]+'-'+dispData.dt_created_at.split(' ')[0].split('-')[0]+'</td><td class="font-bold text-nowrap sort-highlight">Application ID</td><td class="text-nowrap">'+dispData.s_transaction_id+'</td><td class="font-bold text-nowrap sort-highlight">Application Status</td><td class="text-nowrap">'+application_status+'</td></tr></tbody></table></div></div>';


                        // if(dispData.s_cb_fail_reason == 'Borrower has active loan from 3 Lender'){
                        //     dispData.s_cb_fail_reason = 'NOC submitted against more than 3 lender';
                        // }else if(dispData.s_cb_fail_reason == 'Borrower has more than one Active MFIs Except Arohan.'){
                        //     dispData.s_cb_fail_reason = 'NOC submitted against more than one MFI';
                        // }else if(dispData.s_cb_fail_reason == 'Overdue amount is greater than Rs. 100/-'){
                        //     dispData.s_cb_fail_reason = 'NOC submitted against Overdue';
                        // }else if(dispData.s_cb_fail_reason == 'Borrower Defaulted in One or more MFIs.'){
                        //     dispData.s_cb_fail_reason = 'NOC submitted against default';
                        // }else if(dispData.s_cb_fail_reason == 'Total outstanding is higher than Loan limit'){
                        //     dispData.s_cb_fail_reason = 'NOC submitted against less eligibility from loan amount.';
                        // }

                        divElement += '<form id="formNocUpload" method="POST" enctype="multipart/form-data"><input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"><input type="hidden" name="transactionId" value="'+dispData.s_transaction_id+'"><input type="hidden" name="customerId" value="'+dispData.s_customer_id+'"><div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-es">Supporting Documents </h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                        divElement += '<tr><td class="font-bold text-nowrap sort-highlight">Loan Override Reason (Borrower)</td><td colspan="7">'+((dispData.s_cb_fail_reason == '' || dispData.s_cb_fail_reason == null)?'-':dispData.s_cb_fail_reason)+'</td></tr>';
                        divElement += '<tr><td class="font-bold text-nowrap sort-highlight">Loan Override Reason (Co-Borrower)</td><td colspan="7">'+((dispData.s_coborrower_cb_fail_reason == '' || dispData.s_coborrower_cb_fail_reason == null)?'-':dispData.s_coborrower_cb_fail_reason)+'</td></tr>';


                        if(dispData.i_is_noc_approved_by_bh != '1'){
                            divElement += '<tr><td class="" colspan="2">';
                            divElement += '<div class="col-sm-12"><div class="file-upload-part"><div class="upload-file-container"><input type="file" class="file-upload" name="nocDoc1" id="nocDoc1" accept="image/*"></div><a href="javascript:void(0);" class="link-gray text-decoration upload-file-btn"><i class="material-icons">cloud_upload</i>Upload Document 1 </a><ul class="list-no-bullet file-name-list" style="margin: 0 0 1rem;"></ul></div></td>';

                            divElement += '<td class="" colspan="2">';
                            divElement += '<div class="col-sm-12"><div class="file-upload-part"><div class="upload-file-container"><input type="file" class="file-upload" name="nocDoc2" id="nocDoc2" accept="image/*"></div><a href="javascript:void(0);" class="link-gray text-decoration upload-file-btn"><i class="material-icons">cloud_upload</i>Upload Document 2</a><ul class="list-no-bullet file-name-list" style="margin: 0 0 1rem;"></ul></div></td>';

                            divElement += '<td class="" colspan="3">';
                            divElement += '<div class="col-sm-12"><div class="file-upload-part"><div class="upload-file-container"><input type="file" class="file-upload" name="nocDoc3" id="nocDoc3" accept="image/*"></div><a href="javascript:void(0);" class="link-gray text-decoration upload-file-btn"><i class="material-icons">cloud_upload</i>Upload Document 3</a><ul class="list-no-bullet file-name-list" style="margin: 0 0 1rem;"></ul></div></div></td>';
                            divElement += '</tr>';

                            divElement += '<tr><td class="text-nowrap" colspan="8">';
                            divElement += '<div class="col-sm-12"><div class="form-panel"><button type="button" id="uploadNoc" name="uploadNoc" class="button button-sm button-info"><i class="material-icons" style="top: 2px;">save</i>Save</button></div></div></td>';
                            divElement += '</tr>';
                        }


                        var docPath = dispData.s_noc_doc_path;
                        var uploadedFileCnt = 0;
                        if(docPath != '' && docPath != null && docPath != '||'){
                            divElement += '<tr>';
                            docPathSplit = docPath.split('|');
                            var modhtml = '';
                            for (var i = 0; i <= 2; i++) {
                                modhtml += '<td class="font-bold text-nowrap sort-highlight">Document '+(i+1)+'</td><td class="text-nowrap" style="width: 25%;"">'+((i in docPathSplit && (docPathSplit[i] != ''))?'<a data-fileName="'+docPathSplit[i]+'" href="'+base_url+docPathSplit[i]+'" target="_blank">'+docPathSplit[i].substring(docPathSplit[i].lastIndexOf('/') + 1)+'</a>'+((dispData.i_is_noc_approved_by_bh != '1')?'<a href="javascript:void(0);"" class="icon-button button-red file-close dltNocDocs" style="padding: 0;" data-fileName="'+docPathSplit[i]+'"><i class="material-icons">close</i></a>':''):'-')+'</td>';
                                if(docPathSplit[i] != ''){
                                    uploadedFileCnt++;
                                }
                            }
                            modhtml = modhtml.replace(/,\s*$/, "");
                            divElement += modhtml;
                            divElement += '</tr>';

                            @if(Session::get('roleId') == '13' || Session::get('userType') == 'super_admin')
                            if(dispData.i_is_noc_approved_by_bh != '1'){
                                divElement += '<tr id="apprveNocTr"><td class="text-nowrap" colspan="8">';
                                divElement += '<div class="col-sm-12"><div class="form-panel margin-top-es"><button type="button" data-nocId="'+dispData.s_transaction_id+'" id="approveNoc" name="approveNoc" class="button button-sm button-info"><i class="material-icons" style="top: 2px;">save</i>Approve</button></div></div></td>';
                                divElement += '</tr>';
                            }
                            @endif
                        }
                        //else{
                        //     divElement += '<tr><td class="text-nowrap" colspan="8"><div class="col-sm-12">No documents uploaded yet.</div></td></tr>';
                        // }
                        divElement += '</tbody></table></div></div></form>';

                        divElement += '<button title="Close" type="button" class="mfp-close">×</button>';

                        showPopUp(divElement);


                        $('.upload-file-btn').click(function(){
                            $(this).parents('.file-upload-part').find('.file-upload').trigger('click');
                        });


                        $(".file-upload").change(function(e) {
                            $(this).parents(".file-upload-part").find(".file-name-list").empty();
                            var fp = $(this);
                            $("#errorMsg").remove();
                            var lg = fp[0].files.length; // get length
                            var items = fp[0].files;
                            var fragment = "";
                            if (lg > 0) {
                                for (var i = 0; i < lg; i++) {
                                    var fileName = items[i].name; // get file name
                                    var fileSize = items[i].size; // get file size
                                    var fileType = items[i].type; // get file type
                                    fragment += "<li><strong>Attachment: </strong>" + fileName + "(" + fileSize + " bytes) - <strong> Type: </strong>" + fileType + "<a href='javascript:void(0);' class='icon-button button-red file-close'><i class='material-icons'>close</i></a></li>";
                                }
                                $(this).parents(".file-upload-part").find(".file-name-list").append(fragment);
                            }
                        });

                        $('#approveNoc').click(function(){
                            var transId = $(this).attr('data-nocid');
                            $("#scndCnfrmPopup").remove();
                            $("#scndBg").remove();
                            var divElement = '<div class="mfp-bg mfp-ready" id="scndBg"></div><div  id="scndCnfrmPopup" style="position:fixed; z-index:9999; top: 40%; left: 35%;" class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm</h3><p class="margin-bottom-0">Are you sure you want to approve NOC for this application?</p></div><div class="alert-button"><button type="button" class="button button-gray" id="confrmNoDoc">No</button><button type="button" class="button" id="confrmYesDoc" data-transId="'+transId+'">Yes</button></div></div>';
                            $(".order-details-center").after(divElement);

                            $('#confrmNoDoc').click(function(){
                                $("#scndCnfrmPopup").remove();
                                $("#scndBg").remove();
                            });

                            $('#confrmYesDoc').click(function(){
                                $("#scndCnfrmPopup").remove();
                                $("#scndBg").remove();
                                showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
                                $(".popup-container").addClass('only-read-view');
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $.ajax({
                                    url: base_url+"approveNoc",
                                    type:"POST",
                                    data: {
                                        transactionId: $(this).attr('data-transId')
                                    },
                                    dataType: "json",
                                    success:function(data){
                                        hideLoader("body");
                                        $(".popup-container").removeClass('only-read-view');
                                        if(data.status != 'error'){
                                            var msgHdng = '<h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3>';
                                        }else{
                                            var msgHdng = '<h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3>';
                                        }

                                        var urlString = window.location.href.replace(base_url,'');
                                        var divElementSuccess = '<div class="mfp-bg mfp-ready" id="scndBg"></div><div id="nocDeleteSuccPopup" style="position:fixed; z-index:9999; top: 40%; left: 35%;" class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" id="okbtnNocDoc" onclick="sortData(\''+base_url+urlString+'\')">Ok</button></div></div>';
                                        $(".order-details-center").after(divElementSuccess);


                                        // $("#okbtnNocDoc").click(function(){
                                        //     $("#scndBg").remove();
                                        //     $("#nocDeleteSuccPopup").remove();
                                        // });
                                    }
                                });
                            });
                        });

                        $('.dltNocDocs').click(function(){
                            var fileName = $(this).attr('data-fileName');
                            $("#scndCnfrmPopup").remove();
                            $("#scndBg").remove();
                            var divElement = '<div class="mfp-bg mfp-ready" id="scndBg"></div><div  id="scndCnfrmPopup" style="position:fixed; z-index:9999; top: 40%; left: 35%;" class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm</h3><p class="margin-bottom-0">Are you sure you want to delete this document?</p></div><div class="alert-button"><button type="button" class="button button-gray" id="confrmNoDoc">No</button><button type="button" class="button" id="confrmYesDoc" data-fileName="'+fileName+'">Yes</button></div></div>';
                            $(".order-details-center").after(divElement);

                            $('#confrmNoDoc').click(function(){
                                $("#scndCnfrmPopup").remove();
                                $("#scndBg").remove();
                            });

                            $('#confrmYesDoc').click(function(){
                                $("#scndCnfrmPopup").remove();
                                $("#scndBg").remove();
                                showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
                                $(".popup-container").addClass('only-read-view');
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $.ajax({
                                    url: base_url+"deleteNocDoc",
                                    type:"POST",
                                    data: {
                                        transactionId: $('[name="transactionId"]').val(),
                                        fileName: fileName
                                    },
                                    dataType: "json",
                                    success:function(data){
                                        hideLoader("body");
                                        $(".popup-container").removeClass('only-read-view');
                                        if(data.status != 'error'){
                                            var msgHdng = '<h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3>';
                                        }else{
                                            var msgHdng = '<h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3>';
                                        }
                                        var divElementSuccess = '<div class="mfp-bg mfp-ready" id="scndBg"><div id="nocDeleteSuccPopup" style="position:fixed; z-index:9999; top: 40%; left: 35%;" class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" id="okbtnNocDoc">Ok</button></div></div>';
                                        $(".order-details-center").after(divElementSuccess);

                                        if(data.fileUploadedCnt == '0'){
                                            $("#apprveNocTr").remove();
                                        }

                                        $("[data-fileName='"+fileName+"']").parents('td').html('-');

                                        $("#okbtnNocDoc").click(function(){
                                            $("#scndBg").remove();
                                            $("#nocDeleteSuccPopup").remove();
                                        });
                                    }
                                });
                            });
                        });


                        $("#uploadNoc").click(function(){
                            if($('#nocDoc1').get(0).files.length == 0 && $('#nocDoc2').get(0).files.length == 0 && $('#nocDoc3').get(0).files.length == 0){
                                $('#uploadNoc').after("<small class='error-color' id='errorMsg'>Please select atleast 1 image.</small>");
                                return false;
                            }
                            showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
                            $(".popup-container").addClass('only-read-view');

                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            var form = $('#formNocUpload')[0];
                            var dataToUpload = new FormData(form);

                            $.ajax({
                                url: base_url+"uploadNocDoc",
                                data: dataToUpload,
                                type:"POST",
                                enctype: 'multipart/form-data',
                                processData: false,
                                contentType: false,
                                cache: false,
                                success:function(data){
                                    var data = $.parseJSON(data);
                                    hideLoader("body");
                                    $(".popup-container").removeClass('only-read-view');
                                    if(data.status != 'error'){
                                        var msgHdng = '<h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3>';
                                    }else{
                                        var msgHdng = '<h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3>';
                                    }
                                    var urlString = window.location.href.replace(base_url,'');
                                    var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+urlString+'\')">Ok</button></div></div>';
                                    showPopUp(divElementSuccess);
                                }
                            });
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                    }
                });
            });

            $('.approve_application').on('click',function(){
                $.magnificPopup.open({
                    items: {
                        src: '#approve-confirm-popup'
                    },
                    type: 'inline',
                    midClick: true,
                    mainClass: 'my-mfp-zoom-in',
                    modal: true
                });
                var groupCode = $(this).attr("data-groupCode");

                $('#yes_submit_form_approve').attr("data-group",groupCode);
                $('#cancel_confirm_approve').attr("data-group",groupCode);
            });

            $( ".checkcbexpiry" ).each(function( index ) {
                var tdID = $(this).attr('id');
                if($(this).find('.recbcheck').length == 1 || $(this).find('.confirm_teleVerification').length == 1)
                {
                    $("#checkcbexpiry_"+tdID).find('.approve_application').hide();
                    $("#checkcbexpiry_"+tdID).find('.edit_application').hide();
                    var groupCodeArr = tdID.split('_');
                    var groupCode = groupCodeArr[1];
                    $("#change_application_status_"+groupCode).prop("disabled", true);
                }



            });

            $('.groupBack').on('click',function(){
                $.magnificPopup.open({
                    items: {
                        src: '#groupBack-confirm-popup'
                    },
                    type: 'inline',
                    midClick: true,
                    mainClass: 'my-mfp-zoom-in',
                    modal: true
                });
                var groupCode = $(this).attr("data-groupCode");
                $('#errorMsg').remove();

                $('#yes_submit_form_groupBack').attr("data-group",groupCode);
                $('#cancel_confirm_groupBack').attr("data-group",groupCode);
            });

            $(document).on('click','#yes_submit_form_groupBack',function(){
                var groupBackReason = $.trim($("#groupBackReason").val());
                $('#errorMsg').remove();

                if (groupBackReason.length == 0) {
                    $('#groupBackReason').after("<small class='error-color' id='errorMsg'>Please provide a Reason.</small>");
                    return false;
                }
                $.magnificPopup.close();
                $("body").addClass('only-read-view');
                showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 99999;");
                var groupCode = $(this).attr("data-group");

                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

                $.ajax({
                    url: base_url+"manage-applications/groupBack-applications",
                    type:"POST",
                    data: {
                        groupCode: groupCode,
                        groupBackReason:groupBackReason
                    },
                    dataType: "json",
                    success:function(data){
                        hideLoader("body");
                        $("body").removeClass('only-read-view');
                        var current_url = window.location.href;
                        var current_url_last_segment = current_url.substring(current_url.lastIndexOf('/') + 1);
                        var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-info-circle" aria-hidden="true"></i> '+((data.status == 'success')?'Success':'Info')+'</h3><p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+current_url_last_segment+'\')">Ok</button></div></div>';
                        showPopUp(divElementSuccess);
                    },
                    complete: function(xhr, textStatus) {
                        checkIfLogout(xhr);
                    }
                });
            });

            $('.viewESignDetail').on('click', function(){
                var transactionID = $(this).attr("data-ID");
                var groupCode = $(this).attr("data-groupCode");
                var isVerified = $(this).attr("data-isVerified");
                showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
                $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

                $("body").addClass('only-read-view');

                $.ajax({
                    url: base_url+"esign-application-list/ajax_view_esign_details",
                    type: "POST",
                    data: {
                        groupCode: groupCode,
                        transactionID: transactionID,
                        isVerified: isVerified,
                        isVerifiedBtn:0
                    },
                    dataType: 'html',
                    beforeSend: function() {},
                    success: function(data) {
                        hideLoader("body");
                        $("body").removeClass('only-read-view');
                        var divElement = '';
                        divElement += data;
                        showPopUp(divElement);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR, textStatus, errorThrown);
                    }
                });
            });

            $('.cancel_application').on('click', function(){
                $.magnificPopup.open({
                    items: {
                        src: '#cancelation-confirm-popup'
                    },
                    type: 'inline',
                    midClick: true,
                    mainClass: 'my-mfp-zoom-in',
                    modal: true
                });
                var groupCode = $(this).attr("data-groupCode");
                var transactionID = $(this).attr("data-ID");
                $('#yes_submit_form_cancelation').attr("data-group",groupCode);
                $('#yes_submit_form_cancelation').attr("data-applicationId",transactionID);
                $('#cancel_confirm_cancelation').attr("data-group",groupCode);
                $('#cancel_confirm_cancelation').attr("data-applicationId",transactionID);

                if($("#cancelReasonDiv").is(':visible') && $("#cancelationReason").is(':visible')){
                    $("#cancelationReason").val('');
                }
                else
                {
                    $("#cancelationReason").show();
                    $("#cancelationReason").val('');
                }
                if($("#cancelReasonDiv").is(':visible') && $("#cancelationReasonOther").is(':visible')){
                    $("#cancelationReasonOther").hide();
                    $("#cancelationReasonOther").val('');
                }

            });

        });
        $(document).on('click', '.forFromDateSearch_clearable__clear_new', function(e) {
            $("#forFromDateSearch").val('');
            $(this).remove();
        });
        $(document).on('click', '.forToDateSearch_clearable__clear_new', function(e) {
            $("#forToDateSearch").val('');
            $(this).remove();
        });
        $(document).on('click','#yes_submit_form',function(){
            //$('#status-confirm-popup').hide();
            if($("#rejectReasonDiv").is(':visible') && $("#bqhRejectReason").val().trim().length <= 0){
                markAsError($("#bqhRejectReason"),'Reason is required!', true);
                return false;
            }
            $.magnificPopup.close();
            $("body").addClass('only-read-view');
            showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 99999;");
            var groupCode = $(this).attr("data-group");
            var centerCode = $(this).attr("data-center");
            var applicationStatus = $(this).val();
            var bqhRejectReason = $("#bqhRejectReason").val();

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            $.ajax({
                url: base_url+"unapproved-application/ajax_change_application_status",
                type:"POST",
                data: {
                    groupCode: groupCode,
                    centerCode: centerCode,
                    applicationStatus: applicationStatus,
                    bqhRejectReason: bqhRejectReason
                },
                dataType: "json",
                success:function(data){
                    hideLoader("body");
                    $("body").removeClass('only-read-view');
                    if(data.status == 'success')
                    {
                        var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-info-circle" aria-hidden="true"></i> Success</h3><p class="margin-bottom-0">Status successfully changed</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+'ManageUnapprovedApplication\')">Ok</button></div></div>';
                        showPopUp(divElementSuccess);
                        $('#change_application_status_'+groupCode).hide();
                        $('#change_application_status_'+groupCode).parent().parent().html('<span class="bagde bagde-primary">'+data.applicationStatus+'</span>');
                    }
                    else
                    {
                        var divElementError = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="error-color"><i class="fa fa-info-circle" aria-hidden="true"></i> Error</h3><p class="margin-bottom-0">Status can not be changed</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+'ManageUnapprovedApplication\')">Ok</button></div></div>';
                        showPopUp(divElementError);
                        $('#change_application_status_'+groupCode).hide();
                        $('#change_application_status_'+groupCode).parent().parent().html('<span class="bagde bagde-primary">'+data.applicationStatus+'</span>');
                    }

                },
                complete: function(xhr, textStatus) {
                    checkIfLogout(xhr);
                }
            });
        });

        $(document).on('click','#cancel_confirm',function(){
            $('#yes_submit_form').val('');
            var groupCode = $(this).attr("data-group");
            $('#change_application_status_'+groupCode).val('');
        });

        $(document).on('click','#cancel_confirm_recbcheck',function(){
            $('#yes_submit_form_recbcheck').attr("data-group",'');
            $('#yes_submit_form_recbcheck').attr("data-ID",'');
        });

        $(document).on('click','#yes_submit_form_recbcheck',function(){
            //$('#status-confirm-popup').hide();
            $.magnificPopup.close();
            $("body").addClass('only-read-view');
            showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 99999;");
            var groupCode = $(this).attr("data-group");
            var transactionID = $(this).attr("data-ID");
            var current_url = location.href;
            var lastUrlSegment = current_url.substring(current_url.lastIndexOf('/') + 1);
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            $.ajax({
                url: base_url+"unapproved-application/ajax_recbcheck",
                type:"POST",
                data: {
                    groupCode: groupCode,
                    transactionID: transactionID
                },
                dataType: "json",
                success:function(data){
                    console.log(data);
                    hideLoader("body");
                    $("body").removeClass('only-read-view');
                    var abc = base_url+lastUrlSegment;
                    console.log(abc);
                    if(data.status == 'success')
                    {
                        var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-info-circle" aria-hidden="true"></i> Success</h3><p class="margin-bottom-0">'+data.message+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+lastUrlSegment+'\')">Ok</button></div></div>';
                        showPopUp(divElementSuccess);
                    }
                    else
                    {
                        var divElementError = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="error-color"><i class="fa fa-info-circle" aria-hidden="true"></i> Error</h3><p class="margin-bottom-0">'+data.message+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+lastUrlSegment+'\')">Ok</button></div></div>';
                        showPopUp(divElementError);
                    }
                    //$('#change_application_status_'+groupCode).hide();
                    //$('#change_application_status_'+groupCode).parent().parent().html('<span class="bagde bagde-primary">'+data.applicationStatus+'</span>');
                },
                complete: function(xhr, textStatus) {
                    checkIfLogout(xhr);
                }
            });
        });

        $(document).on('click','#yes_submit_form_approve',function(){
            $.magnificPopup.close();
            $("body").addClass('only-read-view');
            showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 99999;");
            var groupCode = $(this).attr("data-group");

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            $.ajax({
                url: base_url+"manage-applications/approve-application",
                type:"POST",
                data: {
                    groupCode: groupCode
                },
                dataType: "json",
                success:function(data){
                    hideLoader("body");
                    $("body").removeClass('only-read-view');
                    var current_url = window.location.href;
                    var current_url_last_segment = current_url.substring(current_url.lastIndexOf('/') + 1);
                    var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-info-circle" aria-hidden="true"></i> Success</h3><p class="margin-bottom-0">Application(s) successfully approved</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+current_url_last_segment+'\')">Ok</button></div></div>';
                    showPopUp(divElementSuccess);
                },
                complete: function(xhr, textStatus) {
                    checkIfLogout(xhr);
                }
            });
        });


        $(document).on('click','#cancel_confirm_approve_tele_verification',function(){
            $('#yes_submit_form_approve_tele_verification').attr("data-group",'');
            $('#yes_submit_form_approve_tele_verification').attr("data-ID",'');
        });

        $(document).on('click','#yes_submit_form_approve_tele_verification',function(){
            //$('#status-confirm-popup').hide();
            $.magnificPopup.close();
            $("body").addClass('only-read-view');
            showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 99999;");
            var groupCode = $(this).attr("data-group");
            var transactionID = $(this).attr("data-ID");
            var current_url = location.href;
            var lastUrlSegment = current_url.substring(current_url.lastIndexOf('/') + 1);
            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            $.ajax({
                url: base_url+"unapproved-application/ajax_approve_tele_verification",
                type:"POST",
                data: {
                    groupCode: groupCode,
                    transactionID: transactionID
                },
                dataType: "json",
                success:function(data){
                    console.log(data);
                    hideLoader("body");
                    $("body").removeClass('only-read-view');
                    var abc = base_url+lastUrlSegment;
                    if(data.status == 'success')
                    {
                        var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-info-circle" aria-hidden="true"></i> Success</h3><p class="margin-bottom-0">'+data.message+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+lastUrlSegment+'\')">Ok</button></div></div>';
                        showPopUp(divElementSuccess);
                    }
                    else
                    {
                        var divElementError = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="error-color"><i class="fa fa-info-circle" aria-hidden="true"></i> Error</h3><p class="margin-bottom-0">'+data.message+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+lastUrlSegment+'\')">Ok</button></div></div>';
                        showPopUp(divElementError);
                    }
                    //$('#change_application_status_'+groupCode).hide();
                    //$('#change_application_status_'+groupCode).parent().parent().html('<span class="bagde bagde-primary">'+data.applicationStatus+'</span>');
                },
                complete: function(xhr, textStatus) {
                    checkIfLogout(xhr);
                }
            });
        });

        $(document).on('change','.cancelationReasonDd',function(){
            var applicationCancelReason = $(this).val();

            if(applicationCancelReason == 'Others'){
                $("#cancelationReasonOther").show();
            }else{
                $("#cancelationReasonOther").hide();
            }
        });

        $(document).on('click','#yes_submit_form_cancelation',function(){
            //$('#status-confirm-popup').hide();
            if($("#cancelReasonDiv").is(':visible') && $("#cancelationReason").is(':visible') && $("#cancelationReason").val().trim().length <= 0){
                markAsError($("#cancelationReason"),'Reason is required!', true);
                return false;
            }
            if($("#cancelReasonDiv").is(':visible') && $("#cancelationReasonOther").is(':visible') && $("#cancelationReasonOther").val().trim().length <= 0){
                markAsError($("#cancelationReasonOther"),'Reason is required!', true);
                return false;
            }
            $.magnificPopup.close();
            $("body").addClass('only-read-view');
            showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 99999;");
            var groupCode = $(this).attr("data-group");
            var applicationId = $(this).attr("data-applicationId");
            /*if($("#cancelationReasonOther").is(':visible')){
                var cancelationReason = $("#cancelationReasonOther").val();
            }
            if($("#cancelationReason").is(':visible')){
                var cancelationReason = $("#cancelationReason").val();
            }*/
            var cancelationReasonOtherTxt = $("#cancelationReasonOther").val();
            var cancelationReasonTxt = $("#cancelationReason").val();
            if(cancelationReasonTxt == 'Others')
            {
                var cancelationReason = cancelationReasonOtherTxt;
            }
            else
            {
                var cancelationReason = cancelationReasonTxt;
            }

            $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

            $.ajax({
                url: base_url+"unapproved-application/ajax_cancel_application",
                type:"POST",
                data: {
                    groupCode: groupCode,
                    applicationId: applicationId,
                    cancelationReason: cancelationReason
                },
                dataType: "json",
                success:function(data){
                    hideLoader("body");
                    $("body").removeClass('only-read-view');
                    var current_url = window.location.href;
                    var current_url_last_segment = current_url.substring(current_url.lastIndexOf('/') + 1);
                    if(data.status == 'success')
                    {
                        var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-info-circle" aria-hidden="true"></i> Success</h3><p class="margin-bottom-0">Status successfully changed</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+current_url_last_segment+'\')">Ok</button></div></div>';
                        showPopUp(divElementSuccess);
                        $('#cancel_application_'+applicationId).hide();
                        $('#change_application_status_'+groupCode).parent().parent().html('<span class="bagde bagde-primary">Cancelled</span>');
                    }
                    else
                    {
                        var divElementError = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="error-color"><i class="fa fa-info-circle" aria-hidden="true"></i> Error</h3><p class="margin-bottom-0">Status can not be changed</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+current_url_last_segment+'\')">Ok</button></div></div>';
                        showPopUp(divElementError);
                        $('#cancel_application_'+applicationId).hide();
                        $('#change_application_status_'+groupCode).parent().parent().html('<span class="bagde bagde-primary">Cancelled</span>');
                    }

                },
                complete: function(xhr, textStatus) {
                    checkIfLogout(xhr);
                }
            });
        });

        function load_region_by_zone()
        {
            var zoneIDs 	= $('#zoneSearch').val();
            var region_html = "";

            var region_selected = $('#regionSearched').val().split(',');
            //console.log(region_selected);
            showLoader($('#regionSearch'), 'position:absolute; top: 4px; right: 1px; z-index: 1;');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: base_url+"ajax_region_list_by_zone",
                type:"POST",
                data: {
                    zoneIDs: zoneIDs
                },
                dataType: "json",
                async: false,
                success:function(data){

                    if(data['region_flag'])
                    {
                        var	csr_slected_text = '';
                        for(var i in data['region_data'])
                        {
                            region_html += '<optgroup label="'+data['region_data'][i][0]['s_parent_name']+'">';

                            for(var j in data['region_data'][i])
                            {
                                if( (region_selected.length > 0) && (region_selected.indexOf(data['region_data'][i][j]['s_office_code']) > -1) )
                                    csr_slected_text = 'selected';
                                else
                                    csr_slected_text = '';

                                region_html += "<option value='"+data['region_data'][i][j]['s_office_code']+"' "+csr_slected_text+">"+data['region_data'][i][j]['office_name']+"</option>";
                            }

                            region_html += '</optgroup>';
                        }
                    }

                    setTimeout(function() {
                        hideLoader($('#regionSearch'));

                        $('#regionSearch').multiselect('reset');
                        $('#regionSearch').html(region_html);
                        $('#regionSearch').multiselect('reset');
                        $('#regionSearch').multiselect('reload');


                        load_branch_by_region($('#regionSearch'));

                    }, 100);

                },
                complete: function(xhr, textStatus) {
                    checkIfLogout(xhr);
                }
            });
        }

        function load_branch_by_region(elem)
        {
            var regionIDs 	= $(elem).val();
            var branch_html = "";

            var branch_selected = $('#branchSearched').val().split(',');
            //console.log(region_selected);
            showLoader($('#branchSearch'), 'position:absolute; top: 4px; right: 1px; z-index: 1;');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: base_url+"get_branch_list_by_region",
                type:"POST",
                data: {
                    regionIDs: regionIDs
                },
                dataType: "json",
                async: false,
                success:function(data){

                    if(data['branch_flag'])
                    {
                        var	csr_slected_text = '';
                        for(var i in data['branch_data'])
                        {
                            branch_html += '<optgroup label="'+data['branch_data'][i][0]['s_parent_name']+'">';

                            for(var j in data['branch_data'][i])
                            {
                                if( (branch_selected.length > 0) && (branch_selected.indexOf(data['branch_data'][i][j]['s_office_code']) > -1) )
                                    csr_slected_text = 'selected';
                                else
                                    csr_slected_text = '';

                                branch_html += "<option value='"+data['branch_data'][i][j]['s_office_code']+"' "+csr_slected_text+">"+data['branch_data'][i][j]['office_name']+"</option>";
                            }

                            branch_html += '</optgroup>';
                        }
                    }

                    setTimeout(function(){
                        hideLoader($('#branchSearch'));

                        $('#branchSearch').multiselect('reset');
                        $('#branchSearch').html(branch_html);
                        $('#branchSearch').multiselect('reset');
                        $('#branchSearch').multiselect('reload');

                        //load_center_by_branch($('#branchSearch'));
                    }, 100);

                },
                complete: function(xhr, textStatus) {
                    checkIfLogout(xhr);
                }
            });
        }


    </script>
@endsection
