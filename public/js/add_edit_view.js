/*** 
* File Name: add_edit_view.js
* Created By: ACS Dev
* Created On: July 31, 2014
* Purpose: Add Edit page required javascript code 
*/
// Display error
var markAsError = function(selector,msg,animate){
    /*if(focus_element == '') 
        focus_element = selector;*/
    
    /*if(animate != 'no')
        $('html, body').animate({scrollTop : 0},800);*/
    
    //$(selector).next('.text-danger').html('<i class="fa fa-times-circle-o"></i> '+msg);    
    
    /*$(selector).next('.text-danger').html(msg);    
    $(selector).parents('.form-panel').addClass("error");*/
    $('html, body').animate({scrollTop : 0},800);
    $(selector).next('.error-message').html(msg);    
    $(selector).parents('.form-panel').addClass("error");
    $(selector).on('focus',function(){
        removeAsError($(this));
    });
}

// Hide error
var removeAsError = function(selector){
    /*$(selector).next('.text-danger').html('');    
    $(selector).parents('.form-group').removeClass("has-error");*/
    
    $(selector).next('.error-message').html('');    
    $(selector).parents('.form-panel').removeClass("error");
} 
   
$(document).ready(function(){  
    // Click on cancel button
    $('#btn_cancel').click(function(i){
         window.location.href=g_controller+'show_list/';
    });  

    // Clieck on close button
    $('.btn-close').click(function(i){
         window.location.href=g_controller; 
    });  

    // Click on save button
    $('#btn_save').click(function(){
       //check_duplicate();
       $("#frm_add_edit").submit();
    }); 
    
    //Submitting search all//
    $("#btn_srchall").click(function(){
        $("#frm_search_3").submit();
    });
    //end Submitting search all//
    
    //$(".glyphicon-zoom-in").colorbox();
    
    //Submitting the form//                                            
    $("#btn_submit").click(function(){
        var formid=$(this).attr("search");
		if (search_action)    
        	$("#frm_search_"+formid).attr("action", search_action);
        $("#frm_search_"+formid).submit(); 
    });                                              
    //Submitting the form//
});
