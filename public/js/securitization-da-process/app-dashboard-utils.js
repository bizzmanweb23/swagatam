$(function() {
	
	var ajax_submit_url = base_url +'ajax-calls/process-securitization-data-AJAX';
	
    var options = {
		url: ajax_submit_url,
        //beforeSubmit:  showLoader,  // pre-submit callback 
        success:       processRequest,  // post-submit callback 
 
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
 
    // bind to the form's submit event 
    $('#frmAppNew').submit(function() { 
		
		frmObj = $(this);
		
		// check for "Term-Loan-Amount" value (if not in Crores)
			var amount_term_loan = $('#filter_term_loan_amt').val();
			
			// check iff Loan-Amount is given
				if( amount_term_loan!='' ) {
					
					var CRORES = 10000000;
					
					var msg = 'Are you sure to submit data-request? Plz note that,once you confirm this can\'t be undone!';
					if( (amount_term_loan/CRORES)<1 )
						msg += '<br />** <b>"Term Loan Amount" is less than 1 Crore.</b>';
					
				}
	
		if( _validateFormSubmission() ) {
			
			$.confirm({
				useBootstrap: false,
				title: 'Confirm!',
				content: msg,
				buttons: {
					confirm: function () {
						showLoader(null, null, false);
						$(frmObj).ajaxSubmit(options); 
					},
					cancel: function () {
						//$.alert('Canceled!');
					}
				}
			});
			
		}
	
        // inside event callbacks 'this' is the DOM element so we first 
        // wrap it in a jQuery object and then invoke ajaxSubmit 
        //$(this).ajaxSubmit(options); 
 
        // !!! Important !!! 
        // always return false to prevent standard browser submit and page navigation 
        return false; 
    }); 


	/* function on-change for the field "sec-deal-code"
	 * - if already process-request for particular bank & sec-deal-code
	 * - exists
	 **/
	$(document).on('blur', '#filter_sec_deal_cde', function() {
		
		var filter_bank = $('#filter_bank').val();
		var filter_slwo = $(this).val();
		
		if( filter_bank!='' && filter_slwo!='' ) {
			_load_existing_filters_AJAX();
		}
		
	});
	
	/* function on-change for the field "deal-code-mapping"
	 * - relevant deal-code will get populated
	 * - once it's get selected
	 **/
	$(document).on('change', '#filter_deal_code_mapping', function() {
		
		var filter_deal_code_mapping = $(this).val();
		
		if( filter_deal_code_mapping!='' ) {
			_load_mapped_sec_deal_code_AJAX();
		}
		
	});
	
	// reset-form
	$(document).on('click', '#btn_reset_search', function() {
		_resetForm();
	});

	// Interest-Rate Slider
    $('#slider-range').slider({
		range: true,
		min: parseInt($('#filter_int_rate').attr('data-min-rate')),
		max: parseInt($('#filter_int_rate').attr('data-max-rate')),
		step: 0.01,
		values: [ 0, 0 ],
		slide: function( event, ui ) {
			var selected_val = ui.values[0].toFixed(2) + "-" + ui.values[1].toFixed(2);
			$('#filter_int_rate').val(selected_val);
		}
    });
	
	var default_selected_val = $('#slider-range').slider("values", 0).toFixed(2) +"-" + $('#slider-range').slider("values", 1).toFixed(2);
    $('#filter_int_rate').val(default_selected_val);

});

/* function to validate
 * - Form submission
 **/
function _validateFormSubmission() {
	
	var return_flag = true;
	
	// check for mandatory field(s)
		var mandatory_fields = {'filter_first_emi_dt': 'First-EMI-Date is required', 'filter_dpd_days': 'DPD-Days is required'};
		
		// check for Co-Terminus condition
			if( $('#filter_cotrminus').prop('checked')==true ) {
				mandatory_fields['filter_term_loan_end_dt'] = 'Loan-Maturity-Date is required';
			} else {
				if('filter_term_loan_end_dt' in mandatory_fields) {
					delete mandatory_fields['filter_term_loan_end_dt'];
				}
				fld_id = '#filter_term_loan_end_dt';
				$(fld_id).parent('.form-panel.error').removeClass('error');
				$(fld_id).parent('.form-panel').parent('.form-panel.error').removeClass('error');
			}
			
		
		// check for Occupation & Occupation-Percent
			var count_selected_occu = $("#filter_occu").val().length;
			
			
		var FLAG_FIELD_EMPTY = false;
		$.each(mandatory_fields, function(index, value){
			fld_id = '#'+ index;
			if( $(fld_id).val()=='' ) {
				FLAG_FIELD_EMPTY = true;
				markAsError($(fld_id), value, true);
			}
		});
		
		return_flag = ( FLAG_FIELD_EMPTY )? false: true;
		
	return return_flag;
}



/* function to unmark-Error
 * - for field(s)
 **/
function _unMarkError(param_field_id) {
	
	var fld_id = '#'+ param_field_id;
	$(fld_id).parent('.form-panel.error').removeClass('error');
	$(fld_id).parent('.form-panel').parent('.form-panel.error').removeClass('error');
	
}


/* function to show-Or-Hide
 * - for containing DIV(s)
 **/
function _showOrHideContainingDIV(param_field_id, param_mode='hide') {
	
	var fld_id = '#'+ param_field_id;
	
	if( param_mode=='hide' ) {
		$(fld_id).parent('.form-panel').parent('.form-panel').addClass('hidden');
	} else {
		$(fld_id).parent('.form-panel').parent('.form-panel').removeClass('hidden');
	}
	
}


function _reloadJSEffects() {
	
// for chosen-select
	$('.chosen-select').chosen();

// multi-select DD(s)
	_load_multi_select_DDs();
	

// "Co-Terminus" on-change event
	var DEFAULT_RESIDUAL_DAYS = 90;
	$('#filter_cotrminus').on('change', function() {
		
		var css_class = 'hide-div';
		if( $(this).prop('checked')==true ) {
			$('#msg_cotrminus').removeClass(css_class);
		} else {
			$('#filter_residual_period').val(DEFAULT_RESIDUAL_DAYS);
			$('#msg_cotrminus').addClass(css_class);
		}
			
	});
	
	_reloadDatePickers();

}


function _reloadDatePickers() {
	
	$('[data-role="datepicker2"]' ).datepicker({
		showOn: "both",
		showButtonPanel: true,
		buttonText: "<i class='material-icons'>date_range</i>",
		dateFormat: 'dd-mm-yy',
		maxDate: '',
		closeText: 'Reset', // Text to show for "close" button
		onClose: function () {
			var event = arguments.callee.caller.caller.arguments[0];
			// If "Reset" gets clicked, clear selected value
			if ($(event.delegateTarget).hasClass('ui-datepicker-close')) {
			  $(this).val('');
			}
		},
		onSelect : function(date,inst)
		{
		}
	});		

}


/* function to load existing filter(s)
 * - based on existing-data
 **/
function _load_existing_filters_AJAX() {
	
	var filter_bank = $('#filter_bank').val();
	var filter_slwo = $('#filter_sec_deal_cde').val();
	var ajax_URL = base_url +'ajax-calls/load-securitization-existing-filters-AJAX';
	
						
	$.ajaxSetup({ 	   
	  headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	
	$.ajax({
		type: "POST",
		url: ajax_URL,
		data: {'bank': filter_bank, 'slwo': filter_slwo},
		beforeSend: function() {
			var loader_msg = 'Loading existing data (if any)...';
			showLoader(null, loader_msg);
		},
		success: function(data) {
			json_data = JSON.parse(data);
			
			if( json_data.status=='success' ) {
				$('#div_filters_block').html(json_data.html_output);
				
				_reloadJSEffects();
					
			}
		}

	});
	

}


// form-submit event(s) [Begin]
	// function to show loader (jquery-blockUI)
	function showLoader(param_container_div=null, param_msg=null, param_close_automatically=true) {
		
		var msg = ( !!param_msg )? param_msg: "Please wait while we're processing your data-request...";
		showBlockUI(msg, param_close_automatically);
		
	}
	
	// function ajax-process-form-submit
	function processRequest(data) {
		
		if(data.status)
		{
			showBlockUI(data.msg, true);
			_resetForm();
		} else
			showBlockUI(data.msg, true);
		
	}
	
	
	/* function to reset form */
	function _resetForm() {
		
		$('#frmAppNew')[0].reset();
		$(".chosen-select").val('').trigger("chosen:updated");
		
		var DD_obj = {'filter_occu': 'Select Occupation(s)', 'filter_states': 'Select State(s)', 'filter_product_types': 'Select Products', 'filter_exclude_deal_codes': 'Select Deal-ID(s)'};
		
		$.each(DD_obj, function(dd_id, dd_lbl) {
			
			dd_id = '#'+ dd_id;
			
			$(dd_id).multiselect( 'reset' );
		});
	}
// form-submit event(s) [End]


/* function to display page/div blocking
 * - message(s) using jQuery.blockUI library
 **/
function showBlockUI(param_msg, param_close_automatically=false, param_container_id=null) {
	
	$.blockUI({ message: param_msg });
	
	if( param_close_automatically ) {
		setTimeout(function(){
			$.unblockUI();
		}, 3000);
	}
}

/* function to load multi-select DD(s) */
function _load_multi_select_DDs() {

	// multi-select DD(s)
		var DD_obj = {'filter_occu': 'Select Occupation(s)', 'filter_states': 'Select State(s)', 'filter_product_types': 'Select Products', 'filter_exclude_deal_codes': 'Select Deal-ID(s)'};
		
		$.each(DD_obj, function(dd_id, dd_lbl) {
			
			dd_id = '#'+ dd_id;
			
			$(dd_id).multiselect({
				search   : true,
				selectAll: true,
				maxPlaceholderOpts: 3,
				texts    : {
					placeholder: dd_lbl,
					search     : dd_lbl
				}
			});
		
		});
		
}


/* function to put focus on 
 * - profile percentage field
 **/
function _put_focus_on(param_fld_id) {
	
	var fld_id = '#'+ param_fld_id;
	$(fld_id).select();
}

// function for jquery-confirm
function _confirm() {
	
	$.confirm({
		title: 'Confirm!',
		content: 'Simple confirm!',
		buttons: {
			confirm: function () {
				$.alert('Confirmed!');
			},
			cancel: function () {
				$.alert('Canceled!!!');
			},
			somethingElse: {
				text: 'Something else',
				btnClass: 'btn-blue',
				keys: ['enter', 'shift'],
				action: function(){
					$.alert('Something else?');
				}
			}
		}
	});
	
}


/* function to load mapped Sec-Deal-Code
 * - based on selected Deal-Code-Mapping
 **/
function _load_mapped_sec_deal_code_AJAX() {
	
	var filter_deal_code_mapping = $('#filter_deal_code_mapping').val();
	var ajax_URL = base_url +'ajax-calls/load-securitization-mapped-sec-deal-code-AJAX';
	
						
	$.ajaxSetup({ 	   
	  headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	
	$.ajax({
		type: "POST",
		url: ajax_URL,
		data: {'mapped_deal_code': filter_deal_code_mapping},
		beforeSend: function() {
			var loader_msg = 'Loading existing Sec-Deal-Code (if any)...';
			showLoader(null, loader_msg);
		},
		success: function(data) {
			json_data = JSON.parse(data);
			
			if( json_data.status=='success' ) {
				$('#filter_sec_deal_cde').val(json_data.relevant_sec_deal_code);
			}
		}

	});
	

}



// jquery dateformat modification
// - to prefix 0 for single-digit
// - day number(s)
$.dateFormat = function(dateObject) {
    var d = new Date(dateObject);
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    if (day < 10) {
        day = "0" + day;
    }
    if (month < 10) {
        month = "0" + month;
    }
    var date = day + "-" + month + "-" + year;

    return date;
};