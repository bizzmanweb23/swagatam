$(function() {
	
	// "Approve" confirmation
		$(document).on('click', '#btn_approve', function() {
			
			var branch_id = $('#hdn_br_code').val();
			var selected_RE_user = $('#dd_RE_user').val();
			// console.log('selected_RE_user::'+ selected_RE_user);
			
			if( selected_RE_user!='' ) {
				$.confirm({
					boxWidth: '30%',
					useBootstrap: false,
					title: 'Approve Confirm!',
					content: 'Are you sure to <b>approve</b> this recovery-handover-letter? Plz note that,once you confirm this can\'t be undone!',
					buttons: {
						confirm: {
							text: 'ok', // With spaces and symbols
							action: function () {
								var mode = 'approval';
								_modify_request_handover_letter_AJAX(branch_id, mode, selected_RE_user);
							}
						},
						cancel: function () {
							// none
						}
					}
				});
			} else {
				var alert_msg = 'You need to select RE-user first!';
				$.alert({
					boxWidth: '30%',
					useBootstrap: false,
					title: 'Alert!',
					content: alert_msg
				});
			}
		});
		
	
	// "Reject" confirmation
		$(document).on('click', '#btn_reject', function() {
			
			var branch_id = $('#hdn_br_code').val();
			
			// NEW - CRM Reject-with-reason [Begin]
				var crm_reject_reason = null;
				if( $('#dd_reject_reason').length )
					crm_reject_reason = $('#dd_reject_reason').val();
			// NEW - CRM Reject-with-reason [End]
			
			
			$.confirm({
				boxWidth: '30%',
				useBootstrap: false,
				title: 'Reject Confirm!',
				content: 'Are you sure to <b>reject</b> this recovery-handover-letter? Plz note that,once you confirm this can\'t be undone!',
				buttons: {
					confirm: {
						text: 'ok', // With spaces and symbols
						action: function () {
							var mode = 'reject';
							_modify_request_handover_letter_AJAX(branch_id, mode, null, crm_reject_reason);
						}
					},
					cancel: function () {
						// none
					}
				}
			});
			
		});
		
});



/* function to delete selected 
 * - process-request
 **/
function _modify_request_handover_letter_AJAX(param_branch_code, param_mode, param_RE_user=null, param_reject_reason=null) {
	
	var ajax_URL = base_url +'ajax-calls/recovery-handover-letter/update-handover-letter-process-AJAX';
	
	$.ajaxSetup({ 	   
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	$.ajax({
		type: "POST",
		url: ajax_URL,
		data: {'selected_br_code': param_branch_code, 'selected_mode': param_mode, 'selected_RE': param_RE_user, 'selected_reason': param_reject_reason},
		beforeSend: function() {
			var loader_msg = 'Please wait...';
			showLoaderUI(null, loader_msg);
		},
		success: function(data) {
			json_data = JSON.parse(data);
			
			if( json_data.status=='success' ) {
				showBlockUI(json_data.msg);
				
				var delay = 3000;
				var URL = base_url + json_data.redirect_pg;
				setTimeout(function(){ window.location.href = URL; }, delay);
					
			} else {	// Error - show error message
				showBlockUI(json_data.msg);
			}
			
		}

	});
	

}


