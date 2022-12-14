$(function() {
	
	// "Approve/Reject" URL click
		$(document).on('click', '.btn-approve-reject, .btn-display-letter', function() {
			
			var branch_code = $(this).data('branch');
			var redirect_url = base_url + 'recovery-handover-letters/';
			
			redirect_url = redirect_url + branch_code;
			//console.log('branch_code::'+ branch_code +'-->redirect_url::'+ redirect_url);
			
			window.location.href = redirect_url;
			
		});
		
	
	
	// "Download-Letter" URL click
		$(document).on('click', '.btn-download-letter', function() {
			
			var branch_code = $(this).data('branch');
			var redirect_url = base_url + 'recovery-handover-letter-download/';
			
			redirect_url = redirect_url + branch_code;
			console.log('branch_code::'+ branch_code +'-->redirect_url::'+ redirect_url);
			
			window.location.href = redirect_url;
			
		});
		
	
});


/* function to paginate_url
 * - in JS
 **/
function _paginateData(paginate_url=null) {
    
	if( paginate_url.trim().length > 0 )
		window.location.href = paginate_url;
	
}

