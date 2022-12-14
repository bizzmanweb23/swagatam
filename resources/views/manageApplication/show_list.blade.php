@extends('layouts.app')

@section('content')

<div class="admin-content-header">	
	<h1 class="float-left-sm primary-color">{{ $heading }}</h1>
</div>
<div class="wrapper-fluid"> 
	<div class="row">
		<div class="col-la-12">
			<div class="card ">			
				
					<div class="card-container pl-0 pr-0 pb-0 clearfix">
						
						<form class="" id="frm_reset_search" name="frm_reset_search" method="POST" action="{{url('manage-application')}}">
							{{ csrf_field() }}
							<input type="hidden" id="h_search" name="h_search" value="">    
						</form>
						<form class="col-sm-12" id="searchForm" name="frm_search_2" method="POST" action="{{url('manage-application')}}" role="search"  autocomplete="autocomplete_off_hack_xfr4!k">
							<input type="hidden" id="h_search" name="h_search" value="{{$search_header_name}}">
							{{ csrf_field() }}	
							
							<div class="row"> 					
								<div class="col-la-2 col-me-3 col-sm-6">
									<div class="form-panel">
										<label>Application Date From</label>
										<div class="form-panel">
											<input type="text" name="forFromDateSearch" id="forFromDateSearch" placeholder="Date" class="input-panel" data-role="datepicker2" value="{{$forFromDateSearch}}" readonly="true" autocomplete="off" />
											<span class="error-message"></span>
										</div>
									</div> 
								</div>	

								<div class="col-la-2 col-me-3 col-sm-6">
									<div class="form-panel">
										<label>Application Date To</label>
										<div class="form-panel">
											<input type="text" name="forToDateSearch" id="forToDateSearch" placeholder="Date" class="input-panel" data-role="datepicker3" value="{{$forToDateSearch}}" readonly="true" autocomplete="off" />
											<span class="error-message"></span>
										</div>
									</div> 
								</div>
								<?php if($user_access_type == 'ZONE' || $user_access_type == 'ALL' ){?>
								<div class="col-la-2 col-me-3 col-sm-6">  
									<div class="form-panel">
										<label for="zoneSearch">Zone</label>
										<div class="form-panel">
											<select name="zoneSearch" id="zoneSearch" class="input-panel chosen-select">
											<option value="">-- Select Zone --</option>
												@if($zonal_office)
													@foreach($zonal_office as $zone)
													<?php
													$selected = (($zoneSearch) && ($zone->s_office_code == $zoneSearch)) ? "selected" : "";
													?>
													<option value="{{ $zone->s_office_code }}" {{ $selected }}>{{ $zone->s_office_name .' ('.$zone->s_office_code.')' }}</option>
													@endforeach
												@endif												
											</select>
											<span class="error-message"></span>
										</div>
									</div>
								</div>									
								<?php }?>
								<?php if($user_access_type != 'BRANCH' && $user_access_type != 'CSR'){?>
								<div class="col-la-2 col-me-3 col-sm-6">
									<div class="form-panel">
										<label for="regionSearch">Region</label>
										<input type="hidden" name="regionSearched" id="regionSearched" value="{{$regionSearched}}">
										<div class="form-panel">
											<select name="regionSearch[]" id="regionSearch" class="input-panel select_custom_rgn" multiple>
												@if($regional_office)
													@foreach($regional_office as $region)
													<?php
													$selected = (($regionSearched) && (in_array($region->s_office_code, explode(',',$regionSearched)))) ? "selected" : "";
													?>
													<option value="{{ $region->s_office_code }}" {{ $selected }}>{{ $region->office_name }}</option>
													@endforeach
												@endif												
											</select>
										</div>
									</div>
								</div>								
								<?php }?>
								<?php if($user_access_type != 'CSR'){?>
								<div class="col-la-2 col-me-3 col-sm-6">
									<div class="form-panel">
										<label for="branchSearch">Branch</label>
										<input type="hidden" name="branchSearched" id="branchSearched" value="{{$branchSearched}}">
										<div class="form-panel">
											<select name="branchSearch[]" id="branchSearch" class="input-panel select_custom_brnch" multiple>
												@if($branch_office)
													@foreach($branch_office as $branch)
													<?php
													$selected = (($branchSearched) && (in_array($branch->s_office_code, explode(',',$branchSearched)))) ? "selected" : "";
													?>
													<option value="{{ $branch->s_office_code }}" {{ $selected }}>{{ $branch->office_name }}</option>
													@endforeach
												@endif												
											</select>
										</div>
									</div>
								</div>
								<?php }
									$pageName = str_replace(env('APP_URL').'/', '/',\Request::url()); 

									if(substr($pageName , -1) != '/'){
									    $pageName = $pageName.'/';
									}
								?>
								@if(strpos($pageName, '/disbursedApplications') === FALSE)
									<div class="col-la-2 col-me-3 col-sm-6">  
										<div class="form-panel">
											<label for="statusSearch">Status</label>
											<div class="form-panel">
												<select name="statusSearch" id="statusSearch" class="input-panel chosen-select">
												<option value="">-- Select Status --</option>
												<option value="99" <?php if($statusSearch == '99'){ echo 'selected';}?>>LAF Incomplete</option>
												<option value="1" <?php if($statusSearch == 1){ echo 'selected';}?>>LAF Done</option>
												<option value="2" <?php if($statusSearch == 2){ echo 'selected';}?>>Neighbour Feedback Done</option>
												<option value="3" <?php if($statusSearch == 3){ echo 'selected';}?>>Group Formation Done</option>
												<option value="4" <?php if($statusSearch == 44){ echo 'selected';}?>>CGT 1 Failed</option>
												<option value="4" <?php if($statusSearch == 4){ echo 'selected';}?>>CGT 1 Done</option>
												<option value="5" <?php if($statusSearch == 55){ echo 'selected';}?>>CGT 2 Failed</option>
												<option value="5" <?php if($statusSearch == 5){ echo 'selected';}?>>CGT 2 Done</option>
												<option value="6" <?php if($statusSearch == 66){ echo 'selected';}?>>Cross Verification Failed</option>
												<option value="6" <?php if($statusSearch == 6){ echo 'selected';}?>>Cross Verification Done</option>
												<option value="7" <?php if($statusSearch == 77){ echo 'selected';}?>>GRT Failed</option>
												<option value="7" <?php if($statusSearch == 7){ echo 'selected';}?>>GRT Done</option>
												<option value="8" <?php if($statusSearch == 8){ echo 'selected';}?>>Disbursement Done</option>
												</select>
												<span class="error-message"></span>
											</div>
										</div>
									</div>
								@endif
								<div class="col-la-2 col-me-3 col-sm-6">
									<div class="form-panel">
										<label>Center Name</label>
										<div class="form-panel">
											<input type="text" name="arohan_center_name" id="arohan_center_name" placeholder="Center Name" class="input-panel" value="{{$arohan_center_name}}" autocomplete="off" />
											<span class="error-message"></span>
										</div>
									</div> 
								</div>

								<div class="col-la-2 col-me-3 col-sm-6">
									<div class="form-panel">
										<label>Customer Code</label>
										<div class="form-panel">
											<input type="text" name="arohan_customer_code" id="arohan_customer_code" placeholder="Customer Code" class="input-panel" value="{{$arohan_customer_code}}" autocomplete="off" />
											<span class="error-message"></span>
										</div>
									</div> 
								</div>

								<div class="col-la-2 col-me-3 col-sm-6">
									<div class="form-panel">
										<label>Customer Name</label>
										<div class="form-panel">
											<input type="text" name="customer_name" id="customer_name" placeholder="Customer Name" class="input-panel" value="{{$customer_name}}" autocomplete="off" />
											<span class="error-message"></span>
										</div>
									</div> 
								</div>

								@if(strpos($pageName, '/disbursedApplications') !== FALSE)
									<div class="col-la-2 col-me-3 col-sm-6">
										<div class="form-panel">
											<label>Loan Id</label>
											<div class="form-panel">
												<input type="text" name="loanId" id="loanId" placeholder="Loan Id" class="input-panel" value="{{$loanId}}" autocomplete="off" />
												<span class="error-message"></span>
											</div>
										</div> 
									</div>
								@endif
								<div class="col-la-2 col-me-6 col-sm-6">  
									<div class="form-panel">
										<label class="hidden-es">&nbsp;</label>
										<div class="clearfix"></div>
										<button type="submit" search="2" id="btn_submit" name="btn_submit" class="button button-info"><i class="material-icons">search</i> Search</button>
										<button type="reset" id="btn_reset_search" name="btn_reset_search" class="button button-gray" ><i class="material-icons">not_interested</i> Reset</button>
										
									</div>
								</div>
								
							</div>	
						</form>
						
					</div>	
				
					<div class="card-container">  
						<div class=" float-right-sm margin-bottom-sm align-right">

						    <div class=" float-right-sm ">
						    @if($data_count > 0)
						        <a href="javascript:void(0)" class="icon-button button-primary" style="cursor: default;"> <div style="width: 12px; height: 12px; background-color: #C54E4E; float: left; margin-right: 5px;"></div>  Borrower override</a>                          
						    @endif
						    </div>
						</div>                                  
						<div class="table-responsive bg-white daily-plan-table">
							<table class="table-border table-odd-even no-margin table-head-color margin-bottom-es equal-btn">
								<thead>
									<tr>
										<th class="align-center text-nowrap" width="10%">Application Date</th>
										@if(strpos($pageName, '/disbursedApplications') !== FALSE)
											<th class="align-center text-nowrap" width="10%">Disbursement Date</th>
										@endif
										@if(strpos($pageName, '/rejectedApplications') !== FALSE || strpos($pageName, '/rejectedBqhApplications') !== FALSE)
											<th class="align-center text-nowrap" width="10%">Rejection Date</th>
										@endif
										<th class="align-center text-nowrap" width="10%">Branch</th>
										<th class="align-center text-nowrap" width="10%">Center</th>
										<th class="align-center text-nowrap" width="10%">Group</th>
										<th class="align-center text-nowrap" width="12%">Customer</th>
										<th class="align-center text-nowrap" width="10%">Application Id</th>
										@if(strpos($pageName, '/disbursedApplications') !== FALSE)
											<th class="align-center text-nowrap" width="10%">Loan Id</th>
										@endif
										<th class="align-center text-nowrap" width="10%">Loan Type</th>
										<th class="align-center text-nowrap" width="12%">Status</th>
										<th class="align-center text-nowrap" width="12%">Action</th>
									</tr>
									
								</thead>
								<tbody>
								<?php if($data_count > 0): 	
								?>
									
								<?php
										foreach($report_data as $report_data_val)
										{

								?>
										@if($report_data_val->s_cb_fail_reason != '' && $report_data_val->s_cb_fail_reason != 'No Active Record found...')
										    @php ($trClr = 'color:#C54E4E;')
										@else
										    @php ($trClr = '')
										@endif								
											<tr style="{!! $trClr !!}">
												<td class="align-center text-nowrap"><?php if($report_data_val->dt_created_at != ''){ echo date('d-m-Y', strtotime($report_data_val->dt_created_at));}?></td>
												@if(strpos($pageName, '/disbursedApplications') !== FALSE)
													<td class="align-center text-nowrap"><?php if($report_data_val->dt_disbursement_date != ''){ echo date('d-m-Y', strtotime($report_data_val->dt_disbursement_date));}?></td>
												@endif
												@if(strpos($pageName, '/rejectedApplications') !== FALSE)
													<td class="align-center text-nowrap"><?php if($report_data_val->dt_chms_rejected_date != ''){ echo date('d-m-Y', strtotime($report_data_val->dt_chms_rejected_date));}?></td>
												@endif
												@if(strpos($pageName, '/rejectedBqhApplications') !== FALSE)
													<td class="align-center text-nowrap"><?php if($report_data_val->dt_status_change != ''){ echo date('d-m-Y', strtotime($report_data_val->dt_status_change));}?></td>
												@endif
												<td class="align-left text-nowrap"><?php if($report_data_val->s_branch_code != ''){ echo $report_data_val->s_branch_name.' ('.$report_data_val->s_branch_code.')';}?></td>
												<td class="align-left text-nowrap"><?php if($report_data_val->s_center_code != ''){ echo $report_data_val->s_center_name.' ('.$report_data_val->s_center_code.')';}?></td>
												<td class="align-center text-nowrap"><?php if($report_data_val->s_group_code != ''){ echo $report_data_val->s_group_code;}?></td>
												<td class="align-left text-nowrap">{{$report_data_val->s_cb_customer_name}} ({{$report_data_val->s_customer_id}})</td>
												<td class="align-center text-nowrap">{{$report_data_val->s_transaction_id}}</td>
												@if(strpos($pageName, '/disbursedApplications') !== FALSE)
													<td class="align-center text-nowrap"><?php echo $report_data_val->s_loan_id?></td>
												@endif
												<td class="align-center text-nowrap">{{$report_data_val->s_loan_type.' - '. $report_data_val->s_user_loan_type}}</td>
												<td class="align-center text-nowrap">
												<?php
												if($report_data_val->s_application_status == ''){
													if($report_data_val->i_last_step_saved == 8)
													{
														$application_status = 'Disbursement Done';
													}
													else if($report_data_val->i_last_step_saved == 7 && $report_data_val->i_grt_status == 1)
													{
														$application_status = 'GRT Done';
													}
													else if($report_data_val->i_current_step == 7 && $report_data_val->i_grt_status === 0)
													{
														$application_status = 'GRT Failed';
													}
													else if($report_data_val->i_last_step_saved == 6 && $report_data_val->i_cross_verification_status == 1)
													{
														$application_status = 'Cross Verification Done';
													}
													else if($report_data_val->i_current_step == 6 && $report_data_val->i_cross_verification_status == 2)
													{
														$application_status = 'Cross Verification Failed';
													}
													else if($report_data_val->i_last_step_saved == 5 && $report_data_val->i_cgt2_status == 1)
													{
														$application_status = 'CGT 2 Done';
													}
													else if($report_data_val->i_current_step == 5 && $report_data_val->i_cgt2_status === 0)
													{
														$application_status = 'CGT 2 Failed';
													}
													else if($report_data_val->i_last_step_saved == 4 && $report_data_val->i_cgt1_status == 1)
													{
														$application_status = 'CGT 1 Done';
													}
													else if($report_data_val->i_current_step == 4 && $report_data_val->i_cgt1_status === 0)
													{
														$application_status = 'CGT 1 Failed';
													}
													else if($report_data_val->i_last_step_saved == 3)
													{
														$application_status = 'Group Formation Done';
													}
													else if($report_data_val->i_last_step_saved == 2)
													{
														$application_status = 'Neighbour Feedback Done';
													}
													else if($report_data_val->i_last_step_saved == 1)
													{
														$application_status = 'LAF Done';
													}
													else
													{
														$application_status = 'LAF Incomplete';
													}
													if($application_status == 'CGT 1 Failed' || $application_status == 'CGT 2 Failed' || $application_status == 'GRT Failed' || $application_status == 'Cross Verification Failed')
													{
														echo '<span class="bagde bagde-error">'.$application_status.'</span>';
													}else if($application_status == 'LAF Incomplete'){  
														echo '<span class="bagde bagde-warning">'.$application_status.'</span>';
													}else
													{
														echo '<span class="bagde bagde-primary">'.$application_status.'</span>';
													}
												}else{
													if(strpos($pageName, '/rejectedApplications') !== FALSE || strpos($pageName, '/rejectedBqhApplications') !== FALSE){
														echo '<span class="bagde bagde-error">'.$report_data_val->s_application_status.'</span>';
													}else{
														echo '<span class="bagde bagde-primary">'.$report_data_val->s_application_status.'</span>';
													}
												}
												?>
												</td>										
												<td class="align-center action-tooltip tooltip-width">
													<div class="dropdownList">
														<a onclick="openMenuList(this)"><i class="fa fa-bars dropbtn" aria-hidden="true"></i></a>
														<div class="dropdownList-content">
															<a data-ID="{{$report_data_val->s_transaction_id}}" href="javascript:void(0);" class="icon-button button-primary viewTransactionDetail" ><i class="fas fa-eye"></i><span> View Application</span></a>
															<?php if($report_data_val->s_application_status == 'Rejected' || $report_data_val->s_application_status == 'Rejected by BQH'){?>
																<a href="{{url('edit_application/'.$report_data_val->i_id)}}" class="icon-button button-primary" ><i class="fas fa-edit"></i><span> Edit</span></a>
															<?php }?>
															@if($report_data_val->s_cb_fail_reason != '' && $report_data_val->s_cb_fail_reason != 'No Active Record found...')
																<a data-ID="{{$report_data_val->s_transaction_id}}" href="javascript:void(0);" class="icon-button button-primary uploadNocDoc" ><i class="fa fa-file" aria-hidden="true"></i><span> NOC Documents</span></a>
															@endif

															@if($report_data_val->i_last_step_saved >= 3)
															    <a href="{{url('downloadPDF/'.$report_data_val->s_transaction_id.'/1')}}" class="icon-button button-primary" data-ordrid="{{$report_data_val->s_transaction_id}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> <span>LAF+DOGH</span></a>
															@endif

															@if($report_data_val->i_last_step_saved >= 3)
															    <a href="{{url('downloadPDF/'.$report_data_val->s_transaction_id.'/1/'.$report_data_val->s_group_code)}}" class="icon-button button-primary" data-ordrid="{{$report_data_val->s_transaction_id}}" target="_blank"><i class="fa fa-download" aria-hidden="true"></i> <span>Group LAF+DOGH</span></a>
															@endif

															@if($report_data_val->s_cb_report != '')
															    <a href="{{url('viewHighMark/'.$report_data_val->s_transaction_id)}}" class="icon-button button-primary" data-ordrid="{{$report_data_val->s_transaction_id}}" target="_blank"><i class="fas fa-file-code" aria-hidden="true"></i> <span>Customer High Mark</span></a>
															@endif

															@if($report_data_val->s_coborrower_cb_report != '')
															    <a href="{{url('viewHighMarkCobor/'.$report_data_val->s_transaction_id)}}" class="icon-button button-primary" data-ordrid="{{$report_data_val->s_transaction_id}}" target="_blank"><i class="fas fa-file-code" aria-hidden="true"></i> <span>Coborrower High Mark</span></a>
															@endif
														</div>
													</div>
												</td>										
											</tr>
										<?php 	
										}
									else: 
								?>
									<tr>	
										<td class="align-center error"  colspan="12">No record(s) to display.</td>
									</tr>
								<?php endif; ?>
								
								</tbody>
							</table>
						</div>
						<div class="clearfix"></div>
					{!!pagination($limit, $data_count, $pageNo, $pagination_url)!!}
					</div>
				
			</div>
		</div>
	</div>
</div>

<!-- Confirmation Popup -->
<div class="popup-container popup-container-sm mfp-hide alert-popup-view" id="delete-popup">
	<div class="popup-container-sm">
		<h3><i class="fa fa-info-circle" aria-hidden="true"></i> Delete Confirmation </h3>
		<p class="margin-bottom-0">Are you sure you want to delete this advance collection?</p>
	</div>

	<div class="alert-button">
		<button type="button" id="cancel_confirm" class="button button-gray popup-modal-dismiss">No</button>
		<button type="button" class="button" id="yes_submit_form" value="" data-flag="">Yes</button>
	</div>
</div>
<!-- Confirmation Popup -->


@include('layouts.inactive_confirmation_modal')

@endsection

@section('js')
<script src="{{asset('public/js/chosen/chosen.jquery.min.js')}}"></script>
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
						
		$('[data-role="datepicker2"]' ).datepicker({
			showOn: "both",
			buttonText: "<i class='material-icons'>date_range</i>",
			dateFormat: 'dd-mm-yy',
			maxDate: '',
			onSelect : function(date,inst)
			{
			}
		});		

		$('[data-role="datepicker3"]' ).datepicker({
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
		
		var user_access_type = "<?php echo $user_access_type;?>";
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
			
			if( $('#forFromDateSearch').val() == '' || $('#forFromDateSearch').val() == null ){ 
				markAsError($('#forFromDateSearch'),'This field is required!',1);
				b_valid = false;
			}
						
			return b_valid;				
		});
		
		
	$('.viewTransactionDetail').on('click', function(){
	       var transactionID = $(this).attr("data-ID");
			showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
			$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
			
			$("body").addClass('only-read-view');
			
			$.ajax({
				url: base_url+"manage-applications/ajax_view_details",
	            type: "POST",
	            data: {
					transactionID: transactionID					
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
                    
                    divElement += '<form id="formNocUpload" method="POST" enctype="multipart/form-data"><input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"><input type="hidden" name="transactionId" value="'+dispData.s_transaction_id+'"><input type="hidden" name="customerId" value="'+dispData.s_customer_id+'"><div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-es">Supporting Documents (Customer)</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>'; 
                    divElement += '<tr><td class="font-bold text-nowrap sort-highlight">Loan Override Reason</td><td colspan="7">'+((dispData.s_cb_fail_reason == '' || dispData.s_cb_fail_reason == null)?'-':dispData.s_cb_fail_reason)+'</td></tr>';

                    if(dispData.i_is_noc_approved_by_bh == '0'){
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
                            modhtml += '<td class="font-bold text-nowrap sort-highlight">Document '+(i+1)+'</td><td class="text-nowrap" style="width: 25%;"">'+((i in docPathSplit && (docPathSplit[i] != ''))?'<a data-fileName="'+docPathSplit[i]+'" href="'+base_url+docPathSplit[i]+'" target="_blank">'+docPathSplit[i].substring(docPathSplit[i].lastIndexOf('/') + 1)+'</a>'+((dispData.i_is_noc_approved_by_bh == '0')?'<a href="javascript:void(0);"" class="icon-button button-red file-close dltNocDocs" style="padding: 0;" data-fileName="'+docPathSplit[i]+'"><i class="material-icons">close</i></a>':''):'-')+'</td>';
                            if(docPathSplit[i] != ''){
                                uploadedFileCnt++;  
                            }
                        }
                        modhtml = modhtml.replace(/,\s*$/, "");
                        divElement += modhtml;
                        divElement += '</tr>';

                        @if(Session::get('userType') == 'checker' || Session::get('userType') == 'super_admin')
                        	if(dispData.i_is_noc_approved_by_bh == '0'){
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
	                    	        var divElementSuccess = '<div class="mfp-bg mfp-ready" id="scndBg"><div id="nocDeleteSuccPopup" style="position:fixed; z-index:9999; top: 40%; left: 35%;" class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" id="okbtnNocDoc" onclick="sortData(\''+base_url+urlString+'\')">Ok</button></div></div>';
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