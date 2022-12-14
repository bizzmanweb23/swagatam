/* function to display customized-alert-msg
 * - using jquery-confirm package
 **/
function _alertMsg(param_title, param_msg=null) {
	
	$.alert({
		title: param_title,
		content: param_msg,
	});
}



$(function() {
	
	// delete confirmation
		$(document).on('click', '.btn-delete', function() {
			
			var selected_process_id = $(this).attr('data-attr-val');
			$.confirm({
				boxWidth: '30%',
				useBootstrap: false,
				title: 'Delete Confirm!',
				content: 'Are you sure to delete this data-request? Plz note that,once you confirm this can\'t be undone!',
				buttons: {
					confirm: function () {
						_delete_process_request_AJAX(selected_process_id);
					},
					cancel: function () {
						//$.alert('Canceled!');
					}
				}
			});
			
		});
		
	
	// Pool-Finalize confirmation
		$(document).on('click', '.btn-success', function() {
			
			var selected_process_id = $(this).attr('data-attr-val');
			$.confirm({
				boxWidth: '30%',
				useBootstrap: false,
				title: 'Finalize-Pool Confirm!',
				content: 'Are you sure to Finalize this data-request? Plz note that,once you confirm this can\'t be undone!',
				buttons: {
					confirm: function () {
						_finalize_pool_process_request_AJAX(selected_process_id);
					},
					cancel: function () {
						//$.alert('Canceled!');
					}
				}
			});
			
		});
		
		
	// search "process-history" by selected filter(s)
		$(document).on('click', '#btn_search_process_history', function() {
			
			// load search-result(s)
				_load_process_history_search_AJAX();
				
		});
		
	// display "selected-process-request-filters"
		$(document).on('click', '.btn-filter-details', function() {
			
			// load filter-details
				var selected_process_id = $(this).attr('data-attr-val');
				_load_process_filter_details_AJAX(selected_process_id);
				
		});
});


function _load_process_history_search_AJAX() {
	
	var ajax_URL = base_url +'ajax-calls/search-process-securitization-da-history-AJAX';
						
	$.ajaxSetup({ 	   
	  headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	
	var selected_sec_deal_code = $('#search_deal_code_mapping').val();
	$.ajax({
		type: "POST",
		url: ajax_URL,
		data: {'sec_deal_code': selected_sec_deal_code},
		beforeSend: function() {
			var loader_msg = 'Please wait...';
			showLoaderUI(null, loader_msg);
		},
		success: function(data) {
			json_data = JSON.parse(data);
			
			if( json_data.status=='success' ) {
				
				$('#div_process_history').html(json_data.ajax_content);
					
			} else {	// Error - show error message
				showBlockUI(json_data.msg);
			}
			
		}

	});
	
}

/* function to delete selected 
 * - process-request
 **/
function _delete_process_request_AJAX(param_selected_process_request) {
	
	var ajax_URL = base_url +'ajax-calls/delete-selected-securitization-da-process-request-AJAX';
	
						
	$.ajaxSetup({ 	   
	  headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	
	$.ajax({
		type: "POST",
		url: ajax_URL,
		data: {'process_request_id': param_selected_process_request},
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



/* function to display filter(s) 
 * - applied for the selected process-request
 **/
function _load_process_filter_details_AJAX(param_selected_process_request) {
	
	var ajax_URL = base_url +'ajax-calls/display-selected-securitization-da-process-filters-AJAX';
	
						
	$.ajaxSetup({ 	   
	  headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	
	$.ajax({
		type: "POST",
		url: ajax_URL,
		data: {'process_request_id': param_selected_process_request},
		beforeSend: function() {
			showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
		},
		success: function(data) {
			json_data = JSON.parse(data);
			
			hideLoader("body");
			$("body").removeClass('only-read-view');
			var divElement = '<div class="product_detail_popup"><div class="popup-container popup-container-la"><div class="content">';
			divElement += json_data.ajax_content;
			divElement += '</div><button title="Close" type="button" class="mfp-close">×</button></div></div>';
			showPopUp(divElement);
			
		}

	});
	

}


// form-submit event(s) [Begin]
	// function to show loader (jquery-blockUI)
	function showLoaderUI(param_container_div=null, param_msg=null, param_close_automatically=true) {
		
		var msg = ( !!param_msg )? param_msg: "Please wait while we're processing your data-request...";
		showBlockUI(msg, param_close_automatically);
		
	}
	
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



//	Product Details
$('.viewProductDetail').on('click', function(){
	var product_id = $(this).data('id');
	var ajax_url = base_url + 'product/detail';

	$.ajaxSetup({
		headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	
	showLoaderUI("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
	$("body").addClass('only-read-view');

	var data_string = {product_id:product_id };
	$.ajax({
		url: ajax_url,
		type: "POST",
		data: data_string,
		dataType: 'html',
		beforeSend: function() {},
		success: function(data) {
			hideLoader("body");
			$("body").removeClass('only-read-view');
			var divElement = '<div class="product_detail_popup"><div class="popup-container popup-container-la"><div class="content">';
			divElement += data;
			divElement += '</div><button title="Close" type="button" class="mfp-close">×</button></div></div>';
			showPopUp(divElement);
		},
		error: function(jqXHR, textStatus, errorThrown) {
			console.log(jqXHR, textStatus, errorThrown);
		}
	});
});



/* function to Finalize-Pool selected 
 * - process-request
 **/
function _finalize_pool_process_request_AJAX(param_selected_process_request) {
	
	var ajax_URL = base_url +'ajax-calls/finalize-pool-selected-securitization-da-process-request-AJAX';
	
						
	$.ajaxSetup({ 	   
	  headers: {
		  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
	
	$.ajax({
		type: "POST",
		url: ajax_URL,
		data: {'process_request_id': param_selected_process_request},
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

