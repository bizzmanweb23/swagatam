@extends('layouts.app')

@section('content')
    
<div class="admin-content-header">
    <h1 class="float-left-sm margin-top-09 primary-color">{{ $heading }}</h1>
    <div class=" float-right-sm margin-bottom-sm align-right">
        <div class=" float-right-sm">
            <a href="{{url('manage-application')}}" class="button button-gray"><i class="material-icons">keyboard_arrow_left</i>Back</a>
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
            <form method="post" id="frm_add_edit" name="frm_add_edit" action="{{url('update_application')}}" enctype="multipart/form-data">
                {{csrf_field()}}
                <input name="i_id" type="hidden" value="{{ $application_id }}" >
                <input name="s_customer_id" type="hidden" value="{{ $detail->s_customer_id }}" >
                <input name="s_transaction_id" type="hidden" value="{{ $detail->s_transaction_id }}" >
                <div class="card">
                    <div class="card-container">
                        <h3 class="primary-color">Application Details</h3>
						
                        <h4 class="primary-color">Current Address</h4>
						<div class="row ">
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Address</label>
                                    <input type="text" placeholder="Address" class="input-panel" name="s_current_address" value="<?php echo $detail->s_current_address;?>" />
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>State</label>
                                    <select class="input-panel" name="i_current_state_id" id="i_current_state_id">
										<?php
										if(!empty($state_list))
										{
											foreach($state_list as $state_list_val)
											{
										?>
												<option value="<?php echo $state_list_val->i_id;?>" <?php if($detail->i_current_state_id == $state_list_val->i_id){ echo 'selected';}?> ><?php echo $state_list_val->s_name;?></option>
										<?php
											}
										}
										?>
                                    </select>
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>District</label>
									<select class="input-panel" name="i_current_district_id" id="i_current_district_id">
                                    <?php
										if(!empty($district_list))
										{
											foreach($district_list as $district_list_val)
											{
										?>
												<option value="<?php echo $district_list_val->i_id;?>" <?php if($detail->i_current_district_id == $district_list_val->i_id){ echo 'selected';}?> ><?php echo $district_list_val->s_district_name;?></option>
										<?php
											}
										}
										?>
										</select>
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Village</label>
                                    <input type="text" placeholder="Village" class="input-panel" name="s_current_village" value="<?php echo $detail->s_current_village;?>" />
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Zipcode</label>
                                    <input type="text" placeholder="Zipcode" class="input-panel" name="s_current_zip" value="<?php echo $detail->s_current_zip;?>" />
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Taluka/Block</label>
                                    <input type="text" placeholder="Taluka/Block" class="input-panel" name="s_current_taluka_block" value="<?php echo $detail->s_current_taluka_block;?>" />
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Police Station</label>
                                    <input type="text" placeholder="Police Station" class="input-panel" name="s_current_police_station" value="<?php echo $detail->s_current_police_station;?>" />
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Post Office</label>
                                    <input type="text" placeholder="Post Office" class="input-panel" name="s_current_post_office" value="<?php echo $detail->s_current_post_office;?>" />
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Area</label>
                                    <input type="text" placeholder="Area" class="input-panel" name="e_current_area" value="<?php echo $detail->e_current_area;?>" />
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Landmark</label>
                                    <input type="text" placeholder="Landmark" class="input-panel" name="s_current_landmark" value="<?php echo $detail->s_current_landmark;?>" />
                                </div>
                            </div>
							
                        </div>
                        <h4 class="primary-color">Bank Details</h4>
                        <div class="row ">
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Mode of Disbursement</label>
                                    <select class="input-panel" name="s_mode_of_disbrusement" id="s_mode_of_disbrusement">
                                        <option value="Cash" <?php if($detail->s_mode_of_disbrusement == 'Cash'){ echo 'selected';}?> >Cash</option>
                                        <option value="Cashless" <?php if($detail->s_mode_of_disbrusement == 'Cashless'){ echo 'selected';}?> >Cashless</option>
                                    </select>
                                    <span class="error-message"></span>
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Account Holder Type <span class="error-color">*</span></label>
                                    <select class="input-panel" name="s_account_holder_type" id="s_account_holder_type">
                                        <option value="Self" <?php if($detail->s_account_holder_type == 'Self'){ echo 'selected';}?> >Self</option>
                                        <option value="Spouse" <?php if($detail->s_account_holder_type == 'Spouse'){ echo 'selected';}?> >Spouse</option>
                                        <option value="Other Member" <?php if($detail->s_account_holder_type == 'Other Member'){ echo 'selected';}?> >Other Member</option>
                                    </select>
                                    <span class="error-message"></span>
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Bank Name</label>
                                    <select class="input-panel" name="s_bank_name" id="s_bank_name">
										<?php
										if(!empty($bank_list))
										{
											foreach($bank_list as $bank_list_val)
											{
										?>
												<option value="<?php echo $bank_list_val->s_name;?>" <?php if($detail->s_account_holder_type == $bank_list_val->s_name){ echo 'selected';}?> ><?php echo $bank_list_val->s_name;?></option>
										<?php
											}
										}
										?>
                                    </select>
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            <div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Bank Branch Details</label>
                                    <input type="text" placeholder="Bank Branch Details" class="input-panel" name="s_branch_detail" value="<?php echo $detail->s_branch_detail;?>" />
                                    <span class="error-message"></span>
                                </div>
                            </div>
                            <div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Account Holder Name</label>
                                    <input type="text" placeholder="Account Holder Name" class="input-panel" name="s_account_holder_name" value="<?php echo $detail->s_account_holder_name;?>" />
                                    <span class="error-message"></span>
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Account Number</label>
                                    <input type="password" placeholder="Account Number" class="input-panel" name="i_account_number" id="i_account_number" value="" />
                                    <span class="error-message"></span>
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Retype Account Number</label>
                                    <input type="text" placeholder="Retype Account Number" class="input-panel" name="i_account_number_retype" id="i_account_number_retype" value="" />
                                    <span class="error-message"></span>
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>Account Operational Since</label>
                                    <input type="text" name="i_account_operational_since" id="i_account_operational_since" placeholder="Date" class="input-panel" data-role="datepicker2" value="{{$detail->i_account_operational_since}}" readonly="true" autocomplete="off" />
                                    <span class="error-message"></span>
                                </div>
                            </div>
							<div class="col-la-2 col-me-2 col-sm-6">
                                <div class="form-panel">
                                    <label>IFSC Code</label>
                                    <input type="text" placeholder="IFSC Code" class="input-panel" name="s_ifsc_code" value="<?php echo $detail->s_ifsc_code;?>" />
                                    <span class="error-message"></span>
                                </div>
                            </div>
                         </div>
                         <h4 class="primary-color">Customer KYC Images</h4>
                         <div class="row">						 
							<div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label><?php echo $detail->s_cb_kyc_type1;?> (Front)</label>
                                     <input type="file" class="input-panel" name="s_applicant_kyc_image_front1" id="s_applicant_kyc_image_front1">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_applicant_kyc_image_front1}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_applicant_kyc_image_front1}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div>                            
                            <div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label><?php echo $detail->s_cb_kyc_type1;?> (Back)</label>
                                     <input type="file" class="input-panel" name="s_applicant_kyc_image_back1" id="s_applicant_kyc_image_back1">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_applicant_kyc_image_back1}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_applicant_kyc_image_back1}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div> 
							
							<div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label><?php echo $detail->s_cb_kyc_type2;?> (Front)</label>
                                     <input type="file" class="input-panel" name="s_applicant_kyc_image_front2" id="s_applicant_kyc_image_front2">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_applicant_kyc_image_front2}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_applicant_kyc_image_front2}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div>                            
                            <div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label><?php echo $detail->s_cb_kyc_type2;?> (Back)</label>
                                     <input type="file" class="input-panel" name="s_applicant_kyc_image_back2" id="s_applicant_kyc_image_back2">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_applicant_kyc_image_back2}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_applicant_kyc_image_back2}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div>
							
						 </div>
                         
						 <div class="row">						 
							<div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label>Customer Image in Residential place</label>
                                     <input type="file" class="input-panel" name="s_customer_recidence_img" id="s_customer_recidence_img">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_customer_recidence_img}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_customer_recidence_img}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div>                            
                            <div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label>Customer Image in Business place</label>
                                     <input type="file" class="input-panel" name="s_customer_business_img" id="s_customer_business_img">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_customer_business_img}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_customer_business_img}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div> 						
						 </div>
                         
						 
						 <h4 class="primary-color">Co-Borrower KYC Images</h4>
                         <div class="row">						 
							<div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label><?php echo $detail->s_borrower_kyc_type;?> (Front)</label>
                                     <input type="file" class="input-panel" name="s_coborrower_kyc_image_front" id="s_coborrower_kyc_image_front">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_coborrower_kyc_image_front}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_coborrower_kyc_image_front}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div>                            
                            <div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label><?php echo $detail->s_borrower_kyc_type;?> (Back)</label>
                                     <input type="file" class="input-panel" name="s_coborrower_kyc_image_back" id="s_coborrower_kyc_image_back">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_coborrower_kyc_image_back}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_coborrower_kyc_image_back}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div> 
							
							<div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label>Co-Borrower Image</label>
                                     <input type="file" class="input-panel" name="s_coborrower_img" id="s_coborrower_img">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_coborrower_img}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_coborrower_img}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div>
							
						 </div>
                         
						  <h4 class="primary-color">Bank Details Images</h4>
                         <div class="row">						 
							<div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label>Passbook</label>
                                     <input type="file" class="input-panel" name="s_applicant_bank_passbook_img" id="s_applicant_bank_passbook_img">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_applicant_bank_passbook_img}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_applicant_bank_passbook_img}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div>                            
                            <div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label>Bank Statement</label>
                                     <input type="file" class="input-panel" name="s_applicant_bank_statement_img" id="s_applicant_bank_statement_img">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_applicant_bank_statement_img}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_applicant_bank_statement_img}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div> 

							<div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label>Coborrower Signature</label>
                                     <input type="file" class="input-panel" name="s_coborrower_signature" id="s_coborrower_signature">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_coborrower_signature}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_coborrower_signature}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div>
							
							<div class="col-la-3 col-me-3 col-sm-6">
                                  <div class="form-panel">
                                     <label>Applicant Signature</label>
                                     <input type="file" class="input-panel" name="s_application_signature" id="s_application_signature">
                                     <span class="error-message"></span>
                                  </div>
								  <div class="clearfix"></div>
								  <div class="example margin-bottom gallery-page">
									<div class="gallery-container">
										<div class="col-me-2 col-sm-4">
										   <div class="gallery-thumb-border">
											  <a href="{{env('APP_URL')}}/{{$detail->s_application_signature}}" data-lightbox="images" class="gallery-thumb zoom-icon">
												 <figure style="background-image: url({{env('APP_URL')}}/{{$detail->s_application_signature}});" class="gallery-thumb-image"></figure>
											  </a>
										   </div>
										</div>
									</div>
								</div>
                            </div>
								
						 </div>
						 
						 <div class="row">
                            <div class="clearfix"></div>
                            <div class="col-la-3 col-me-4 col-sm-6">
                                <div class="form-panel">
                                    <div class="clearfix"></div> 
                                    <button type="button" class="button button-info" id="applicationSubmtBtn"><i class="material-icons">save</i>Save</button>
                                    <button type="reset" class="button button-gray"><i class="material-icons">not_interested</i>Reset</button>
                                </div>
                            </div>  
                        </div>
                        
                        <!-- <div class="row ">
                            <div class="clearfix"></div> 
                        </div> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')

<script type="text/javascript">   
$(document).ready(function(){
	$('[data-role="datepicker2"]' ).datepicker({
			showOn: "both",
			buttonText: "<i class='material-icons'>date_range</i>",
			dateFormat: 'dd-mm-yy',
			maxDate: '',
			onSelect : function(date,inst)
			{
			}
		});
    $("#applicationSubmtBtn").on('click', function(){
        var dis_form = $("#frm_add_edit");

        var is_valid = true;
        var has_error ='';
        
        $("#div_err").hide("slow");

        if(dis_form.find("input[name=s_account_holder_name]").val() == ""){
            markAsError(dis_form.find("input[name=s_account_holder_name]"),'Account Holder Name is required!');
            is_valid = false;
        }
        if(dis_form.find("select[name=s_bank_name]").val() == ""){
            markAsError(dis_form.find("select[name=s_bank_name]"),'Bank Name is required!');
            is_valid = false;
        }
		if($("#i_account_number").val() != '')
		{
			if($("#i_account_number").val() != $("#i_account_number_retype").val())
			{
				markAsError(dis_form.find("select[name=i_account_number_retype]"),'Account Number not matched!');
				is_valid = false;
			}
		}
        
        if(is_valid == true){
            $("#frm_add_edit").submit();
        }
               
        return is_valid ;
    });
	
	$("#i_current_state_id").on('change', function(){
        var stateId = $(this).val();
        var childLocationElementId = "#i_current_district_id";
        showLoader(childLocationElementId, 'position:absolute; top: 25px; right: 1px;');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url: base_url + 'edit-application/getDistrictByState',
            type: "POST",
            data: { stateId: stateId },
            dataType: 'json',
            success: function(data) {
                var frmtdHtml = '<option value=""> -- Select -- </option>';
                frmtdHtml = frmtdHtml + data.childLocations;
                
                $(childLocationElementId).html(frmtdHtml);
                hideLoader(childLocationElementId);
            },
            complete: function(xhr, textStatus) {
            }
        });
    });
	
});    
</script>  

@endsection
