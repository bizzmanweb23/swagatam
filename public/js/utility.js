/* ==== show blockUI message ==== */
function showUIMsg(msg)
{
	$.blockUI({
		message: msg,
		css: {
				border: 'none',
				padding: '15px',
				fontSize: '12px',
				backgroundColor: '#000000',
				'-webkit-border-radius': '10px',
				'-moz-border-radius': '10px',
				opacity: '1',
				color: '#ffffff'
		},
		overlayCSS: { backgroundColor: '#000000' }
	});

	setTimeout($.unblockUI, 2000);
}






/* ############## ELEMENT BLOCKING LOADER [BEGIN] ############## */

	// loading screen...
	function showAJAXLoader(divID, placemarker_type)
	{
		var HTML = '<img src="'+ base_url +'images/loaders/loader_atom.gif" />';
		var placemarker = (typeof placemarker_type==='undefined')? 'div': placemarker_type;
		var element_div = placemarker +'#'+ divID;
		
		$(element_div).block({
			message: HTML,
			css: {
					border: 'none',
					color: '#ffffff'
				 },
			overlayCSS: { backgroundColor: '#ffffff' }
		});
	}
	
	// now, hiding the loading screen...
	function hideAJAXLoader(divID, placemarker_type)
	{
		var placemarker = (typeof placemarker_type==='undefined')? 'div': placemarker_type;
		var element_div = placemarker +'#'+ divID;
		
		$(element_div).unblock();
	}

/* ############## ELEMENT BLOCKING LOADER [END] ############## */
