$('[data-lightbox="delete-popup"]').click(function() {
    $('#yes_delete_item').attr('data-id', $(this).attr('data-id'));  
}).magnificPopup({
    type: 'inline',
    midClick: true,
    mainClass: 'my-mfp-zoom-in', 
    modal: true
});

$('.restore-popup').click(function() {
    $('#yes_restore_item').attr('data-id', $(this).attr('data-id'));  
}).magnificPopup({
    type: 'inline',
    midClick: true,
    mainClass: 'my-mfp-zoom-in', 
    modal: true
});

$('[data-lightbox="mail-send-popup"]').click(function() {
    $('#yes_send_mail').attr('data-id', $(this).attr('data-id')); 
}).magnificPopup({
    type: 'inline',
    midClick: true,
    mainClass: 'my-mfp-zoom-in', 
    modal: true
});
   
var markAsError = function(selector, msg, animate) {
    var offset = $(selector).offset();
    if( animate != true ) 
    {
        $('html, body').animate({
            scrollTop: offset.top - 25
        }, 800);
    }
    else
    {
        $(selector).focus();
    }
    $(selector).nextAll('.error-message').html(msg);
    $(selector).parents('.form-panel').addClass("error");
    $(selector).on('focus, keydown, click', function() {
        removeAsError($(this));
    });

    $(selector).on('keyup', function() {
        removeAsError($(this));
    });
}

// Hide error
var removeAsError = function(selector) {
    /*$(selector).next('.text-danger').html('');    
    $(selector).parents('.form-group').removeClass("has-error");*/

    $(selector).nextAll('.error-message').html('');
    $(selector).parents('.form-panel').removeClass("error");
}

function IsEmail(email) {
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!regex.test(email)) {
        return false;
    } else {
        return true;
    } 
}

$('input, checkbox, select').focus(function() {

    if ($(this).parents('.form-panel').hasClass('error'))
        $(this).parents('.form-panel').removeClass('error');
});

function showLoader(selector, additnlCss){
    $(selector).find('.loader').remove();
    $(selector).attr('disabled', 'true');
    $(selector).after('<div class="loader" style="'+additnlCss+'"></div>');
}

function hideLoader(selector){
    $(selector).removeAttr('disabled');
    $(selector).next('.loader').remove();
}

function sortData(url, form_name, type = '') { console.log(type);
    if(type !=''){
        showLoader("body", 'position:fixed; top: 40%; left: 50%; z-index: 99999;');
        $("body").addClass('only-read-view');
    }
    if (!form_name) {
        form_name = 'searchForm';
    }

    $("#" + form_name).attr('action', url);
    $("#" + form_name).submit();
}

$(document).on('click', '#yes_delete_item', function(e) {
    var form = $("#" + ($(this).attr('data-id')));
    form.submit();
});

$(document).on('click', '#yes_restore_item', function(e) {
    var form = $("#" + ($(this).attr('data-id')));
    form.submit();
});



function showPopUp(divElement){
    $.magnificPopup.open({
        items: { 
            src: divElement,
            type: 'inline'
        },
        modal: true
    });
}

function getSubCategoryByCatId(catId, subCatElementId){
    showLoader(subCatElementId, 'position:absolute; top: 25px; right: 1px;');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        url: base_url + 'categories/subCategory/getSubCategoryByCatId',
        type: "POST",
        data: {
            catId: catId
        },
        dataType: 'json',
        success: function(data) {
            var frmtdHtml = '<option value=""> -- Select Sub-category -- </option>';
            
            for (var i = 0; i <= data.subCategories.length - 1; i++) {
                frmtdHtml = frmtdHtml + '<option value="' + data.subCategories[i]['i_id'] + '">' + data.subCategories[i]['s_category_name'] + '</option>';
            }
            $(subCatElementId).html(frmtdHtml);
            hideLoader(subCatElementId);
        },
        complete: function(xhr, textStatus) {
            checkIfLogout(xhr);
        }
    });
}
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true;
    $("body").removeClass('menu-open');
}

$(".side-bar-menu").children().each(function() {
    $(this).children('.dropdown-menu').each(function() {
        $(this).children('li').each(function() {
            if($(this).hasClass('active')){
                $(this).parent().parent().addClass('active');
                $(this).parent().slideDown();
            }
        });
    });
});

function forceNumber(element) {
    element.data("oldValue", '').bind("paste", function(e) {
        var validNumber = /^[-]?\d+(\.\d{1,2})?$/;
        element.data('oldValue', element.val())
        setTimeout(function() {
        if (!validNumber.test(element.val()))
          element.val(element.data('oldValue'));
        }, 0);
    });
    element.keypress(function(event) {
        var text = $(this).val();

        if ((event.which != 46 || text.indexOf('.') != -1) && //if the keypress is not a . or there is already a decimal point
        ((event.which < 48 || event.which > 57) && //and you try to enter something that isn't a number
          (event.which == 45 || (element[0].selectionStart != 0 || text.indexOf('-') != -1)) && //and the keypress is not a -, or the cursor is not at the beginning, or there is already a -
          (event.which != 0 && event.which != 8))) { //and the keypress is not a backspace or arrow key (in FF)
            event.preventDefault(); //cancel the keypress
        }

        if ((text.indexOf('.') != -1) && (text.substring(text.indexOf('.')).length > 2) && //if there is a decimal point, and there are more than two digits after the decimal point
        ((element[0].selectionStart - element[0].selectionEnd) == 0) && //and no part of the input is selected
        (element[0].selectionStart >= element.val().length - 2) && //and the cursor is to the right of the decimal point
        (event.which != 45 || (element[0].selectionStart != 0 || text.indexOf('-') != -1)) && //and the keypress is not a -, or the cursor is not at the beginning, or there is already a -
        (event.which != 0 && event.which != 8)) { //and the keypress is not a backspace or arrow key (in FF)
            event.preventDefault(); //cancel the keypress
        }
    });
}

function downPaymentCalculation(){
    var loanAmmount = $("[name='loanAmmount']").val();
    var customerPrice = $("[name='customerPrice']").val();
    if($("[name='loanAmmount']").val() == '' || $("[name='customerPrice']").val() == ''){
        if($("[name='loanAmmount']").val() == ''){
            loanAmmount = 0;
            customerPrice = $("[name='customerPrice']").val();
        }else if($("[name='customerPrice']").val() == ''){
            customerPrice = 0;
            loanAmmount = $("[name='loanAmmount']").val();
        }else{
            loanAmmount = $("[name='loanAmmount']").val();
            customerPrice = $("[name='customerPrice']").val();
        }
    }

    if($("[name='loanAmmount']").val() == '' || $("[name='customerPrice']").val() == ''){
        $("[name='downPayment']").val('');
    }else{
        if((parseInt(customerPrice)-parseInt(loanAmmount)) >= 0){
            $("[name='downPayment']").val((parseInt(customerPrice)-parseInt(loanAmmount))+'.00');
        }else{
            $("[name='downPayment']").val('');
        }
    }
}

function downPaymentCalculationRegnWise(thisElm){
    if ($(thisElm).attr('name') == 'loanAmmountRegnWise[]') {
        var loanAmmount = $(thisElm).val();
        var customerPrice = $(thisElm).parents('tr').find("[name='customerPriceRegnWise[]']").val();
    }else if ($(thisElm).attr('name') == 'customerPriceRegnWise[]') {
        var loanAmmount = $(thisElm).parents('tr').find("[name='loanAmmountRegnWise[]']").val();
        var customerPrice = $(thisElm).val();
    }

    if(loanAmmount == '' || customerPrice == ''){
        if(customerPrice == ''){
            loanAmmount = 0;
            customerPrice = $(thisElm).parents('tr').find("[name='customerPriceRegnWise[]']").val();
        }else if(customerPrice == ''){
            customerPrice = 0;
            loanAmmount = $(thisElm).parents('tr').find("[name='loanAmmountRegnWise[]']").val();
        }else{
            loanAmmount = $(thisElm).parents('tr').find("[name='loanAmmountRegnWise[]']").val();
            customerPrice = $(thisElm).parents('tr').find("[name='customerPriceRegnWise[]']").val();
        }
    }

    if(loanAmmount == '' || customerPrice == ''){
        $(thisElm).parents('tr').find("[name='downPaymentRegnWise[]']").val('');
    }else{
        if((parseInt(customerPrice)-parseInt(loanAmmount)) >= 0){
            $(thisElm).parents('tr').find("[name='downPaymentRegnWise[]']").val((parseInt(customerPrice)-parseInt(loanAmmount))+'.00');
        }else{
            $(thisElm).parents('tr').find("[name='downPaymentRegnWise[]']").val('');
        }
    }
}

function lpfCalculation(){
    var loanAmmount = $("[name='loanAmmount']").val();
    if($("[name='loanAmmount']").val() != ''){
        var processingFee = Math.round(((1/100)*loanAmmount));
        $("[name='processingFee']").val(processingFee+'.00');
    }else{
        $("[name='processingFee']").val('');
    }
}

function lpfCalculationRegnWise(thisElm){
    var loanAmmount = $(thisElm).val();
    if($(thisElm).val() != ''){
        var processingFee = Math.round(((1/100)*loanAmmount));
        $(thisElm).parents('tr').find("[name='processingFeeRegnWise[]']").val(processingFee+'.00');
    }else{
        $(thisElm).parents('tr').find("[name='processingFeeRegnWise[]']").val('');
    }
}

function gstCreditCalculation(){
    var lpf = $("[name='processingFee']").val();
    if($("[name='processingFee']").val() != ''){
        var gstCredit = Math.round(((18/100)*lpf));
        $("[name='gstCredit']").val(gstCredit+'.00');
    }else{
        $("[name='gstCredit']").val('');
    }
}

function gstCreditCalculationRegnWise(thisElm){
    var lpf = Math.round($(thisElm).val()*(1/100));
    
    if($(thisElm).val() != ''){
        var gstCredit = Math.round(((18/100)*lpf));
        $(thisElm).parents('tr').find("[name='gstCreditRegnWise[]']").val(gstCredit+'.00');
    }else{
        $(thisElm).parents('tr').find("[name='gstCreditRegnWise[]']").val('');
    }
}

function calculateEmi(amount, rate, term){
    rate = parseFloat(parseFloat(rate) / 100);
    var emi = Math.round(parseFloat((amount * rate / 12) * [Math.pow((1 + rate / 12), term)] / [Math.pow((1 + rate / 12), term) - 1]));
    
    if(Math.ceil(emi).toString().match(/\d{2}$/) != null){
        if (Math.ceil(emi).toString().match(/\d{2}$/)[0] > 50) {
            var emi = (parseInt(Math.ceil(emi))+(100 - parseInt(Math.ceil(emi).toString().match(/\d{2}$/)[0])));
        }else if (Math.ceil(emi).toString().match(/\d{2}$/)[0] == 50) {
            var emi = parseInt(Math.ceil(emi));
        }else if (Math.ceil(emi).toString().match(/\d{2}$/)[0] < 50) {
            var emi = (parseInt(Math.ceil(emi))+(50 - parseInt(Math.ceil(emi).toString().match(/\d{2}$/)[0])));
        }else{
            var emi = 50;
        }
    }else{
       var emi = 50; 
    }

    return emi;
}



function marginCalculation(){
    var vendorPrice = $("[name='vendorPrice']").val();
    var customerPrice = $("[name='customerPrice']").val();
    if($("[name='vendorPrice']").val() == '' || $("[name='customerPrice']").val() == ''){
        if($("[name='vendorPrice']").val() == ''){
            vendorPrice = 0;
            customerPrice = $("[name='customerPrice']").val();
        }else if($("[name='customerPrice']").val() == ''){
            customerPrice = 0;
            vendorPrice = $("[name='vendorPrice']").val();
        }else{
            loanAmmount = $("[name='vendorPrice']").val();
            customerPrice = $("[name='customerPrice']").val();
        }
    }

    if($("[name='vendorPrice']").val() == '' || $("[name='customerPrice']").val() == ''){
        $("[name='margins']").val('');
    }else{
        if((parseInt(vendorPrice)-parseInt(customerPrice)) >= 0){
            $("[name='margins']").val((parseInt(vendorPrice)-parseInt(customerPrice))+'.00');
        }else{
            $("[name='margins']").val('');
        }
    }
}

function marginCalculationRegnWise(thisElm){
    if ($(thisElm).attr('name') == 'vendorPriceRegnWise[]') {
        var vendorPrice = $(thisElm).val();
        var customerPrice = $(thisElm).parents('tr').find("[name='customerPriceRegnWise[]']").val();
    }else if ($(thisElm).attr('name') == 'customerPriceRegnWise[]') {
        var vendorPrice = $(thisElm).parents('tr').find("[name='vendorPriceRegnWise[]']").val();
        var customerPrice = $(thisElm).val();
    }

    if(vendorPrice == '' || customerPrice == ''){
        if(customerPrice == ''){
            vendorPrice = 0;
            customerPrice = $(thisElm).parents('tr').find("[name='customerPriceRegnWise[]']").val();
        }else if(customerPrice == ''){
            customerPrice = 0;
            vendorPrice = $(thisElm).parents('tr').find("[name='vendorPriceRegnWise[]']").val();
        }else{
            vendorPrice = $(thisElm).parents('tr').find("[name='vendorPriceRegnWise[]']").val();
            customerPrice = $(thisElm).parents('tr').find("[name='customerPriceRegnWise[]']").val();
        }
    }
    
    
    if(vendorPrice == '' || customerPrice == ''){
        $(thisElm).parents('tr').find("[name='marginsRegnWise[]']").val('');
    }else{
        if((parseInt(vendorPrice)-parseInt(customerPrice)) >= 0){
            $(thisElm).parents('tr').find("[name='marginsRegnWise[]']").val((parseInt(vendorPrice)-parseInt(customerPrice))+'.00');
        }else{
            $(thisElm).parents('tr').find("[name='marginsRegnWise[]']").val('');
        }
    }
}

function showEMIPopup(){
    var tenure = $("[name='tenure']").val();

    var emiTable = '<table class="table table-border table-odd-even margin-bottom-0"><thead><tr><th class="align-center text-nowrap">Tenure</th><th class="align-center text-nowrap">EMI</th></tr></thead><tbody>';
    if($("[name='tenure']").val() != '' && $("[name='loanAmmount']").val() != '' && $("[name='interestRate']").val() != ''){
        for (var i = 0; i < tenure.length ; i++) {
            var emiCalculate = calculateEmi(parseInt($("[name='loanAmmount']").val()), parseInt($("[name='interestRate']").val()), parseInt(tenure[i]));
            emiTable += '<tr><td class="align-center text-nowrap">'+tenure[i]+' months</td><td class="align-center text-nowrap">&#8377; '+Math.ceil(emiCalculate)+'/-</td></tr>';
        }
    }else{
        emiTable += '<tr><td class="align-center text-nowrap" colspan="2">Enter Loan Amount, Tenure & Interest Rate to calculate EMI</td></tr>';
    }

    emiTable += '</tbody></table>';
    
    var divElement = '<div class="popup-container popup-container-sm alert-popup-view" id="emiCalcPopup"><div class="popup-container-sm"><h3><i class="fa fa-calculator" aria-hidden="true"></i> EMI Calculator</h3>'+emiTable+'</div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss">Ok</button></div></div>';
    showPopUp(divElement);
}

function showEMIPopupRegnWise(thisElm){

    var tenure = [];
    $(thisElm).parents('tr').find(".ms-options-wrap").find('.ms-options').find('ul').find(".selected").find('label').find('input[type=checkbox]').each(function(){
        tenure.push($(this).val());
    });
    var loanAmt = $(thisElm).parents('tr').find("[name='loanAmmountRegnWise[]']").val();
    var interestRate = $(thisElm).parents('tr').find("[name='interstRateRegnWise[]']").val();

    var emiTable = '<table class="table table-border table-odd-even margin-bottom-0"><thead><tr><th class="align-center text-nowrap">Tenure</th><th class="align-center text-nowrap">EMI</th></tr></thead><tbody>';
    if(tenure != '' && loanAmt != '' && interestRate != ''){
        for (var i = 0; i < tenure.length ; i++) {
            var emiCalculate = calculateEmi(parseInt(loanAmt), parseInt(interestRate), parseInt(tenure[i]));

            emiTable += '<tr><td class="align-center text-nowrap">'+tenure[i]+' months</td><td class="align-center text-nowrap">&#8377; '+Math.ceil(emiCalculate)+'/-</td></tr>';
        }
    }else{
        emiTable += '<tr><td class="align-center text-nowrap" colspan="2">Enter Loan Amount, Tenure & Interest Rate to calculate EMI</td></tr>';
    }

    emiTable += '</tbody></table>';
    
    var divElement = '<div class="popup-container popup-container-sm alert-popup-view" id="emiCalcPopup"><div class="popup-container-sm"><h3><i class="fa fa-calculator" aria-hidden="true"></i> EMI Calculator</h3>'+emiTable+'</div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss">Ok</button></div></div>';
    showPopUp(divElement);
}

function deletePricingRgnWise(thisElm){
    showLoader("body", 'position:fixed; top: 40%; left: 40%;');
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
        url: base_url+"deletePricingRegionWise",
        type:"POST",
        data: {
            prodId: $("[name='productId']").val(),
            rgnid: $("#pricingList_"+$(thisElm).attr('data-id')).find('[name="regionId[]"]').val()
        },
        dataType: "json",
        success:function(data){
            hideLoader("body");
            var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3><p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="window.location.href=window.location.href">Ok</button></div></div>';
            showPopUp(divElement);
        },
        complete: function(xhr, textStatus) {
            checkIfLogout(xhr);
        }
    });
}

function saveOrderStatProdWise(orderId){
    showLoader("body", 'position:fixed; top: 40%; left: 50%; z-index: 99999;');
    $(".mfp-close").attr('disabled', 'true');
    
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
        url: base_url+"saveOrderStatProdWise",
        type:"POST",
        data: {
            orderId: orderId,
            dataValue: $('#delivered_'+orderId+':checkbox:checked').length
        },
        dataType: "json",
        success:function(data){
            hideLoader("body");
            $(".mfp-close").removeAttr('disabled');
            if(data.statusDoc != '0'){
                if(data.statusDoc == 'Delivered'){
                    $("[data-doc='"+data.docNum+"']").val(data.statusDoc).removeClass('border-warning').addClass('border-success');
                    $("#popupStatus").text(data.statusDoc);
                    $("#popupStatus").removeClass('bagde-warning').addClass('bagde-success');
                }else if(data.statusDoc == 'Send To Hub'){
                    $("[data-doc='"+data.docNum+"']").val(data.statusDoc).removeClass('border-warning').addClass('border-secondary');
                    $("#popupStatus").text(data.statusDoc);
                    $("#popupStatus").removeClass('bagde-warning').addClass('bagde-secondary');
                    $("#deliveredIcn_"+orderId).parents('span').hide();
                    $("#cancelledIcn_"+orderId).parents('span').hide();
                }else{
                    $("[data-doc='"+data.docNum+"']").val('Order Executed').removeClass('border-success').addClass('border-warning');
                    $("#popupStatus").text('Order Executed');
                    $("#popupStatus").removeClass('bagde-success').addClass('bagde-warning');
                }
            }else{
                $("[data-doc='"+data.docNum+"']").val('Order Executed').removeClass('border-success').addClass('border-warning');;
                $("#popupStatus").text('Order Executed');
                $("#popupStatus").removeClass('bagde-success').addClass('bagde-warning');
            }

            if ($('#delivered_'+orderId+':checkbox:checked').length > 0) {
                $("#deliveredIcn_"+orderId).parents('span').show();
                $("#cancelledIcn_"+orderId).parents('span').hide();
            }else{
                $("#deliveredIcn_"+orderId).parents('span').hide();
                $("#cancelledIcn_"+orderId).parents('span').show();
            }
        },
        complete: function(xhr, textStatus) {
            checkIfLogout(xhr);
        }
    });
}

function productPricingList(type){
    var frmtdHtmLpricing = '';

    if ($("[name='includeCharge']:checked").length > 0) {
        var yesChecked = ' checked';
    }else{
        var yesChecked = '';
    }

    var regionIds = '';
    $('[name="statePricing"]').find(":selected").each(function(index){
        regionIds = regionIds+$(this).val()+',';
    });

    regionIds = regionIds.replace(/,+$/,'');

    showLoader("#submitPricing", 'position:absolute; top: 2px; left: 100px;');
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.ajax({
        url: base_url+"getRegionByStateId",
        type:"POST",
        data: {
            regionIds: regionIds
        },
        dataType: "json",
        success:function(data){
            hideLoader("#submitPricing");
            $('[name="statePricing"]').find(":selected").each(function(index){
                for (var i = 0; i < data.rgnIds[$(this).val()].length; i++) {
                    frmtdHtmLpricing += '<tr id="pricingList_'+data.rgnIds[$(this).val()][i].regionId+'" ><td class="align-center">'+$(this).parent().attr('label')+'<input type="hidden" name="stateId[]" value="'+$(this).parent().attr('value')+'"></td>';
                    frmtdHtmLpricing += '<td class="align-center">'+data.rgnIds[$(this).val()][i].regionName+'<input type="hidden" name="regionId[]" value="'+data.rgnIds[$(this).val()][i].regionId+'"></td>';
                    frmtdHtmLpricing += '<td><div class="form-panel"><input type="text" placeholder="dd-mm-yyyy" class="input-panel optnlDt" name="cashEffectiveDate[]" data-role="datepicker" data-alt="datepickerRgnWise" readonly value="'+$('[name="effectiveDate"]').val()+'"></div></td>';
                    frmtdHtmLpricing += '<td><input type="text" placeholder="Vendor Price" class="input-panel rgnwseInput price" name="vendorPriceRegnWise[]" value="'+$("[name='vendorPrice']").val()+'"></td>';
                    frmtdHtmLpricing += '<td><input type="text" placeholder="Customer Price" class="input-panel rgnwseInput price" name="customerPriceRegnWise[]" value="'+$("[name='customerPrice']").val()+'"></td>';
                    frmtdHtmLpricing += '<td><div class="form-panel form-panel-dropdown"><div class="dropdown"><button class="blank-btn dropdown-toggle" type="button" data-toggle="dropdown">'+(($("[name='discountType']").val() == '1')?'%':'&#8377;')+'</button><ul class="dropdown-menu mainClsTr"><li><a href="javascript:void(0);" value="1">%</a></li><li><a href="javascript:void(0);" value="2">&#8377;</a></li></ul></div><input type="text" placeholder="Discount" class="input-panel price" name="discountRegnWise[]" value="'+$("[name='discount']").val()+'"><input type="hidden" name="discountTypeRegnWise[]" value="'+$("[name='discountType']").val()+'"></div></td>';    
                        
                    //if($("[name='paymentType']").val() == '1' || $("[name='paymentType']").val() == '3'){
                        if($("[name='marginType']").val() == '2'){
                            var marginSign = '&#8377;';
                            var marginSignValue = '2';
                        }else{
                            var marginSign = '%';
                            var marginSignValue = '1';
                        }
                        frmtdHtmLpricing += '<td><input type="text" placeholder="Margin" class="input-panel rgnwseInput price" name="marginsRegnWise[]" value="'+$("[name='margins']").val()+'"></div></td>';
                        frmtdHtmLpricing += '<td><input type="text" placeholder="Delivery Charges" class="input-panel price" name="deliveryChargesRegnWise[]" value="'+$("[name='deliveryCharges']").val()+'"></td>';
                        frmtdHtmLpricing += '<td class="align-center text-nowrap"><div class="form-panel input-inline margin-bottom-0"><div class="checkbox"><input type="checkbox" name="includeChargeRegnWise_'+data.rgnIds[$(this).val()][i].regionId+'" id="radio'+index+'" value="1"'+yesChecked+'><label for="radio'+index+'"></label></div></div></div></td>';
                    //}

                    if($("[name='paymentType']").val() == '2' || $("[name='paymentType']").val() == '3'){
                        var getTenureVal = $("[name='tenure']").val();

                        var innerOpt = '<select class="input-panel selectCustomrgn" name="tenureRegnWise_'+data.rgnIds[$(this).val()][i].regionId+'[]" multiple>';
                        $("[name='tenure'] option").each(function(index){
                            if(getTenureVal.indexOf($(this).val()) > -1){
                                var selectedOpt = ' selected';
                            }else{
                                var selectedOpt = '';
                            }
                            innerOpt += '<option value="'+$(this).val()+'"'+selectedOpt+'>'+$(this).text()+'</option>';
                        });

                        innerOpt += '</select>';

                        var insCmpnystr = "";
                        $( "#insurnceComp").find('option').each(function() {
                            if($(this).attr('value') == $( "#insurnceComp").val()){
                                insCmpnystr += '<option value="'+$(this).val()+'" selected>'+$(this).text()+'</option>';
                            }else{
                                insCmpnystr += '<option value="'+$( this ).val()+'">'+$(this).text()+'</option>';
                            }
                            
                        });

                        frmtdHtmLpricing += '<td><input type="text" placeholder="Loan Amount" class="input-panel rgnwseInput price" name="loanAmmountRegnWise[]" value="'+$("[name='loanAmmount']").val()+'"></td>';
                        frmtdHtmLpricing += '<td><input type="text" placeholder="Down Payment" class="input-panel rgnwseInput" name="downPaymentRegnWise[]" value="'+$("[name='downPayment']").val()+'"></td>';
                        frmtdHtmLpricing += '<td><input type="text" placeholder="1% of Loan Amt." class="input-panel rgnwseInput" name="processingFeeRegnWise[]" value="'+$("[name='processingFee']").val()+'"></td>';
                        frmtdHtmLpricing += '<td><input type="text" placeholder="18% of LPF" class="input-panel rgnwseInput" name="gstCreditRegnWise[]" value="'+$("[name='gstCredit']").val()+'"></td>';
                        frmtdHtmLpricing += '<td><select class="input-panel" name="insuranceCompRegnWise[]">'+insCmpnystr+'</select></td>';
                        //frmtdHtmLpricing += '<td><input type="text" placeholder="Insurance Amt." class="input-panel rgnwseInput price" name="insuranceAmtRegnWise[]" value="'+$("[name='insuranceAmt']").val()+'"></td>';
                        frmtdHtmLpricing += '<td>'+innerOpt+'</td>';
                        frmtdHtmLpricing += '<td><input type="text" readonly placeholder="Interest Rate" class="input-panel rgnwseInput price" name="interstRateRegnWise[]" value="'+$("[name='interestRate']").val()+'"></td>';
                    }

                    frmtdHtmLpricing += '<input type="hidden" name="cashEffectiveDateHdn[]" value="">';
                    if($("[name='paymentType']").val() == '2' || $("[name='paymentType']").val() == '3'){
                        var emiBtn = '<a data-id="'+data.rgnIds[$(this).val()][i].regionId+'" href="javascript:void(0);" class="icon-button button-primary tooltip top-center emiCalc" data-tooltip="EMI Calculator"><i class="fas fa-calculator" aria-hidden="true"></i></a>';
                    }else{
                        var emiBtn = '';
                    }
                    frmtdHtmLpricing += '<td class="actions align-center action-tooltip tooltip-width">'+emiBtn+'<a data-id="'+data.rgnIds[$(this).val()][i].regionId+'" class="dltRgnPricingTemp error-color" data-lightbox="delete-popup" href="javascript:void(0)"><i class="fas fa-trash-alt"></i></a></td></tr>';
                }
            });

            $('.selectCustomrgn').val($("[name='tenure']").val());

            if (type == '1') {
                $("#pricingListRgnWise").html(frmtdHtmLpricing);
            }else{
                $("#pricingListRgnWise").append(frmtdHtmLpricing);
                sortTable();
            }

            $('#tenure').multiselect('reset');
            $('.error-message').html('');
            $('.form-panel.error').removeClass('error');

            $('.selectCustomrgn').multiselect({
                columns  : 1,
                search   : true,
                selectAll: true,
                texts    : {
                    placeholder: ' -- Select -- ',
                    search     : 'Search Here'
                },
                minHeight: '150px',
                onControlClose: function( element ){
                }
            });
            

            $('[data-role="datepicker"]' ).datepicker({
                showOn: "both",
                changeMonth: true,
                changeYear: true,
                showAnim: "fade",
                dateFormat: 'dd-mm-yy'
            });

            $('[data-role="datepicker"]').datepicker( "option", "minDate", new Date((new Date).getFullYear(), (new Date).getMonth(), (new Date).getDate()) );
            
            $("#pricingList").show();

            $("[name='loanAmmountRegnWise[]']").on("input", function() {
                lpfCalculationRegnWise(this);
                gstCreditCalculationRegnWise(this)
            });

            $(".emiCalc").on("click", function() {
                showEMIPopupRegnWise(this);
            });


            $(".priceRmve").val('');
            $("[name='radioMain2']").attr('checked', true);
            $('[name="statePricing"]').parent().find(".ms-options-wrap button").text(' -- Select -- ');

            $('[name="statePricing"]').parent().find(".ms-options-wrap").find(".ms-options ul .selected").remove();
            $('[name="statePricing"]').parent().find(".ms-options-wrap").find(".ms-options ul").find('li:not(.optgroup, .ms-hidden).selected').removeClass('selected');
            $('[name="statePricing"]').parent().find(".ms-options-wrap").find(".ms-options ul").find('li:not(.optgroup, .ms-hidden, .selected) input[type="checkbox"]:not(:disabled)').prop( 'checked', false );

            $(".mainClsTr li a").click(function(){
                var selText = $(this).text();
                $(this).parents('.form-panel').find('.dropdown-toggle').html(selText);
                $(this).parents('.form-panel').find('.dropdown-menu').hide();
                $("[name='discountTypeRegnWise[]']").val($(this).attr('value'));
                $(".dropdown").removeClass('open');
            });

            $(".dltRgnPricingTemp").click(function(){
                var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Delete</h3><p class="margin-bottom-0">Are you sure you want to delete this record?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss">Cancel</button><button type="button" class="button popup-modal-dismiss" id="deleteYesInvntry">Delete</button></div></div>';
                showPopUp(divElement);
                
                $('#deleteYesInvntry').attr('data-id', $(this).attr('data-id'));

                $("#deleteYesInvntry").click(function(){
                    $('#pricingList_'+$(this).attr('data-id')).remove();
                    if($("#pricingListRgnWise tr").length == 0){
                        $("#pricingList").hide();
                    }
                });
            });
        },
        complete: function(xhr, textStatus) {
            checkIfLogout(xhr);
        }
    });

    

    $('#btnReset').click(function(){
        $(".rgnwseInput").val('');
    });
}

function sortTable() {
    var table, rows, switching, i, x, y, shouldSwitch;
    table = document.getElementById("rgnwisePriceTable");
    switching = true;
    /*Make a loop that will continue until
    no switching has been done:*/
    while (switching) {
        //start by saying: no switching is done:
        switching = false;
        rows = table.rows;
        /*Loop through all table rows (except the
        first, which contains table headers):*/
        for (i = 1; i < (rows.length - 1); i++) {
            //start by saying there should be no switching:
            shouldSwitch = false;
            /*Get the two elements you want to compare,
            one from current row and one from the next:*/
            x = rows[i].getElementsByTagName("TD")[0];
            y = rows[i + 1].getElementsByTagName("TD")[0];
            //check if the two rows should switch place:
            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                //if so, mark as a switch and break the loop:
                shouldSwitch = true;
                break;
            }
        }
        if (shouldSwitch) {
            /*If a switch has been marked, make the switch
            and mark that a switch has been done:*/
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
        }
    }
}

function getChildLocationByParentId(parentId, childLocationElementId){
    showLoader(childLocationElementId, 'position:absolute; top: 25px; right: 1px;');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        url: base_url + 'office-location/getChildLocationByParentId',
        type: "POST",
        data: {
            parentId: parentId
        },
        dataType: 'json',
        success: function(data) {
            var frmtdHtml = '<option value=""> -- Select -- </option>';
            
			frmtdHtml = frmtdHtml + data.childLocations;
            /*for (var i = 0; i <= data.childLocations.length - 1; i++) {
                frmtdHtml = frmtdHtml + '<option value="' + data.childLocations[i]['i_id'] + '">' + data.childLocations[i]['s_office_name'] + '</option>';
            }*/
            $(childLocationElementId).html(frmtdHtml);
            hideLoader(childLocationElementId);
        },
        complete: function(xhr, textStatus) {
            checkIfLogout(xhr);
        }
    });
}

function getRoleListByuserId(userId, roleElementId){
	
	if ($(roleElementId).css('display') == 'none') 
	{
		showLoader('#i_role_id_chosen', 'position:absolute; top: 25px; right: 1px;');
	}
	else
	{
		showLoader(roleElementId, 'position:absolute; top: 25px; right: 1px;');
	}
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        url: base_url + 'applicationuserroles/getRoleListByuserId',
        type: "POST",
        data: {
            userId: userId
        },
        dataType: 'json',
        success: function(data) {
			$("#i_role_id_chosen").width('300px');
			//$(".chosen-select").trigger("liszt:updated");
			var frmtdHtml = '<option value=""> -- Select -- </option>';
            
			//frmtdHtml = frmtdHtml + data.childLocations;
            for (var i = 0; i <= data.childLocations.length - 1; i++) {
                frmtdHtml = frmtdHtml + '<option value="' + data.childLocations[i]['role_id'] + '">' + data.childLocations[i]['role_name'] + '</option>';
            }
			$(roleElementId).html(frmtdHtml);
			$("#i_original_role_id").val(data.current_roleId);
            $(".chosen-select").trigger("chosen:updated");
			if ($(roleElementId).css('display') == 'none') 
			{
				hideLoader('#i_role_id_chosen');
			}
			else
			{
				hideLoader(roleElementId);
			}            
        },
        complete: function(xhr, textStatus) {
            checkIfLogout(xhr);
        }
    });
}

function getApplicationListByuserId(userId, appElementId){
	
	if ($(appElementId).css('display') == 'none') 
	{
		showLoader('#i_app_alias_name_chosen', 'position:absolute; top: 25px; right: 1px;');
	}
	else
	{
		showLoader(appElementId, 'position:absolute; top: 25px; right: 1px;');
	}
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        url: base_url + 'applicationuserroles/getAppListByuserId',
        type: "POST",
        data: {
            userId: userId
        },
        dataType: 'json',
        success: function(data) {
			$("#i_app_alias_name_chosen").width('300px');
			//$(".chosen-select").trigger("liszt:updated");
			var frmtdHtml = '<option value=""> -- Select -- </option>';
            
			//frmtdHtml = frmtdHtml + data.childLocations;
            for (var i = 0; i <= data.childLocations.length - 1; i++) {
                frmtdHtml = frmtdHtml + '<option value="' + data.childLocations[i]['s_application_alias_name'] + '">' + data.childLocations[i]['s_application_name'] + '</option>';
            }
			$(appElementId).html(frmtdHtml);
			//$("#i_original_role_id").val(data.current_roleId);
            $(".chosen-select").trigger("chosen:updated");
			if ($(appElementId).css('display') == 'none') 
			{
				hideLoader('#i_app_alias_name_chosen');
			}
			else
			{
				hideLoader(appElementId);
			}            
        },
        complete: function(xhr, textStatus) {
            checkIfLogout(xhr);
        }
    });
}

function changeOrderStatus(thisObj, typePst, prevValue, adjustVal){
    showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 99999999999;");
    $("body").addClass('only-read-view');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: base_url + 'changeOrderStatus',
        type: "POST",
        data: {
            selectId: $(thisObj).attr('data-id'),
            selectValue: $(thisObj).val(),
            reasonType: $("#reasonType").val(),
            reasonText: $("#reasonText").val(),
            type: typePst,
            previousValue: prevValue,
            adjustVal: adjustVal
        },
        dataType: 'json',
        success: function(data) {
            hideLoader("body");
            $("body").removeClass('only-read-view');
            if(data.status != 'error'){ 
                var msgHdng = '<h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3>';
            }else{
                var msgHdng = '<h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3>';
            }
            var urlString = window.location.href.replace(base_url,'');
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+urlString+'\')">Ok</button></div></div>';
            showPopUp(divElementSuccess);
        },
        complete: function(xhr, textStatus) {
            checkIfLogout(xhr);
        }
    });
}

function sendToHub(thisObj){
    showLoader("body", 'position:fixed; top: 40%; left: 40%;');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        url: base_url + 'sendToHub',
        type: "POST",
        data: {
            orderId: $(thisObj).attr('data-ordrid')
        },
        dataType: 'json',
        success: function(data) {
            hideLoader("body");
            if(data.status != 'error'){ 
                var msgHdng = '<h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3>';
            }else{
                var msgHdng = '<h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3>';
            }
            var urlString = window.location.href.replace(base_url,'');
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+urlString+'\')">Ok</button></div></div>';
            showPopUp(divElementSuccess);
        },
        complete: function(xhr, textStatus) {
            checkIfLogout(xhr);
        }
    });
}

function addCommas(nStr){
    nStr += '';
    x = nStr.split('.');
    x1 = x[0];
    x2 = x.length > 1 ? '.' + x[1] : '.00';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + ',' + '$2');
    }
    return x1 + x2;
}

$(function () {
    $('.selectCustom').multiselect({
        columns  : 1,
        search   : true,
        selectAll: true,
        texts    : {
            placeholder: ' -- Select -- ',
            search     : 'Search Here'
        },
        maxHeight: '289px'
    });

    $('.selectCustomrgnLoad, .selectCustomrgn').multiselect({
        columns  : 1,
        search   : true,
        selectAll: true,
        texts    : {
            placeholder: ' -- Select -- ',
            search     : 'Search Here'
        },
        minHeight: '150px',
        onControlClose: function( element ){
        }
    });

    $(".dltRgnPricing").click(function(){
        var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Delete</h3><p class="margin-bottom-0">Are you sure you want to delete this record?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss">Cancel</button><button type="button" class="button popup-modal-dismiss" id="deleteYesInvntry">Delete</button></div></div>';
        showPopUp(divElement);
        
        $('#deleteYesInvntry').attr('data-id', $(this).attr('data-id'));

        $("#deleteYesInvntry").click(function(){
            deletePricingRgnWise(this);
        });
    });
});

$(document).ready(function() {

    

    $('.sidebar-toggle').click(function(e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $.ajax({
            url: base_url + 'setMenu',
            type: "POST",
            data: {
                menuClass: $("body").attr('class')
            },
            dataType: 'json',
            success: function(data) {
            }
        });
    });

    $("[name='categoryId']").change(function() {
        var categoryId = $(this).val();
        getSubCategoryByCatId(categoryId, "#subCategoryId");

        if($(this).find('option:selected').attr('data-cattype') == '1') {
            $("#paymentDiv").addClass('only-read-view');
            $("#cash").prop('checked', true);
            $("#credit").prop('checked', false);
        }else if($(this).find('option:selected').attr('data-cattype') == '2') {
            $("#paymentDiv").addClass('only-read-view');
            $("#credit").prop('checked', true);
            $("#cash").prop('checked', false);
        }else if($(this).find('option:selected').attr('data-cattype') == '3') {
            $("#paymentDiv").removeClass('only-read-view');
            $("#cash").prop('checked', true);
            $("#credit").prop('checked', true);
        }
    });

    $("[name='categoryIdSrch']").change(function() {
        var categoryId = $(this).val();
        getSubCategoryByCatId(categoryId, "#subCategoryIdSrch");
    });

    $('.notiTr').click(function(){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
            url: base_url+"notificationReadSubmit",
            type:"POST",
            data: {
                notiId: $(this).attr('data-notiid'), 
                url: $(this).attr('data-url')
            },
            dataType: "json",
            success:function(data){
                window.location.href=base_url+data.url;
            }
        });
    });

    if (window.location.hash.substr(1) != '') {
        $("body").addClass('only-read-view');
        showLoader("body", 'position: fixed; top: 50%; right: 50%; z-index:9999');
        $("[name='nameSearch']").val(window.location.hash.substr(1));
        sortData(window.location.href.replace("#"+window.location.hash.substr(1), ''));
    }
    
    //forceNumber($(".price"));

    $('#submitPricing').click(function(){
        var b_valid=true;
        var s_err='';
        
        $("#div_err").hide("slow");
        if ($("#statePricing").val() == '') {
            $("#statePricing").nextAll('.error-message').html('Select a Region!').show();;
            b_valid = false;
        }else{
            if ($("#statePricing").val() != '') {
                $("#statePricing").nextAll('.error-message').html('').hide();;
                b_valid = true;
            }

            if($("[name='cashEffectiveDate']").val()==''){
                markAsError($("[name='cashEffectiveDate']"),'Effective Date is required!');
                b_valid = false;
            }else if($("[name='vendorPrice']").val()==''){
                markAsError($("[name='vendorPrice']"),'Vendor Price is required!');
                b_valid = false;
            }else if($("[name='customerPrice']").val()==''){
                markAsError($("[name='customerPrice']"),'Customer Price is required!');
                b_valid = false;
            }else if($("[name='margins']").val()==''){
                markAsError($("[name='margins']"),'Margin is required!');
                b_valid = false;
            // }else if($("[name='deliveryCharges']").val()==''){
            //     markAsError($("[name='deliveryCharges']"),'Delivery Charges is required!');
            //     b_valid = false;
            }else if($("[name='loanAmmount']").val()==''){
                markAsError($("[name='loanAmmount']"),'Loan Amount is required!');
                b_valid = false;
            }else if($("[name='downPayment']").val()==''){
                markAsError($("[name='downPayment']"),'Down Payment is required!');
                b_valid = false;
            }else if($("[name='processingFee']").val()==''){
                markAsError($("[name='processingFee']"),'Processing Fee is required!');
                b_valid = false;
            }else if($("[name='tenure']").val()==''){
                markAsError($("[name='tenure']"),'Tenure is required!');
                b_valid = false;
            }else if($("[name='interestRate']").val()==''){
                markAsError($("[name='interestRate']"),'Interest Rate is required!');
                b_valid = false;
            }
        }

                 
        if(!b_valid){        
            $("#div_err").html('<div id="err_msg" class="error_massage">'+s_err+'</div>').show("slow");
            return b_valid;
        }

        // if($("[name='productIdPricing']").val() != ''){
        //     var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Delete</h3><p class="margin-bottom-0">Do you want to overwrite existing data?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="overwriteNoInvntry">No</button><button type="button" class="button popup-modal-dismiss" id="overwriteYesInvntry">Yes</button></div></div>';
        //     showPopUp(divElement);
        // }else{
            productPricingList(2);
        //}

        // $('#overwriteYesInvntry').click(function(){
        //     productPricingList(1);
        // });

        // $('#overwriteNoInvntry').click(function(){
        //     productPricingList(2);
        // });
    });

    $(".mainCls li a").click(function(){
        var selText = $(this).text();
        $(this).parents('.form-panel').find('.dropdown-toggle').html(selText);
        $("[name='discountType']").val($(this).attr('value'));
        $(".dropdown").removeClass('open');
    });

    $(".mainClsTr li a").click(function(){
        var selText = $(this).text();
        $(this).parents('.form-panel').find('.dropdown-toggle').html(selText);
        $(this).parents('tr').find("[name='discountTypeRegnWise[]']").val($(this).attr('value'));
        $(".dropdown").removeClass('open');
    });
	
	$("[name='zonal_id_srch']").change(function() {
        var zonalId = $(this).val();
        getChildLocationByParentId(zonalId, "#regional_id_srch");
    });
	$("[name='regional_id_srch']").change(function() {
        var regionalId = $(this).val();
        getChildLocationByParentId(regionalId, "#branch_id_srch");
    });
	
	$("[name='zonal_id']").change(function() {
        var zonalId = $(this).val();
        getChildLocationByParentId(zonalId, "#regional_id");
    });
	$("[name='regional_id']").change(function() {
        var regionalId = $(this).val();
        getChildLocationByParentId(regionalId, "#branch_id");
    });
	
	$("[name='i_user_id']").change(function() {
        var userId = $(this).val();
		$("#application_role_div").show();
		$("#application_name_div").show();
		$("#original_role_div").show();
        getRoleListByuserId(userId, "#i_role_id");
		getApplicationListByuserId(userId, "#i_app_alias_name");
    });

    $("[name='loanAmmount'], [name='customerPrice']").on("input", function() {
        downPaymentCalculation();
    });

    $("[name='loanAmmountRegnWise[]'], [name='customerPriceRegnWise[]']").on("input", function() {
        downPaymentCalculationRegnWise(this);
    });

    $("[name='vendorPrice'], [name='customerPrice']").on("input change", function() {
        marginCalculation();
    });

    $("[name='vendorPriceRegnWise[]'], [name='customerPriceRegnWise[]']").on("input", function() {
        marginCalculationRegnWise(this);
    });

    $("[name='loanAmmount']").on("input", function() {
        lpfCalculation();
        gstCreditCalculation();
    });

    $("[name='loanAmmountRegnWise[]']").on("input", function() {
        lpfCalculationRegnWise(this);
        gstCreditCalculationRegnWise(this)
    });

    $("#displayEmiCalc").click(function() {
        showEMIPopup();
    });

    $(".emiCalc").click(function() {
        showEMIPopupRegnWise(this);
    });


    $(".viewOrder").click(function(){
        showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
        $("body").addClass('only-read-view');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
            url: base_url+"orderDetail",
            type:"POST",
            data: {
                orderId: $(this).attr('data-ordrid')
            },
            dataType: "json",
            success:function(data){
                var dispData = data.dataDetail[0];

                if(dispData.s_status == 'Approved')
                    var clrStat = 'primary';
                else if(dispData.s_status == 'Order Executed')
                    var clrStat = 'warning';
                else if(dispData.s_status == 'Send To Hub')
                    var clrStat = 'secondary';
                else if(dispData.s_status == 'Delivered')
                    var clrStat = 'success';
                else if(dispData.s_status == 'Cancelled' || dispData.s_status == 'Request to cancel')
                    var clrStat = 'error';
                else
                    var clrStat = 'primary';

                if(dispData.dt_refund_initiate_date != '' && dispData.dt_refund_initiate_date != null && dispData.i_neft_file_sent == 0){
                    var statusOrg = 'Refund Initiated';
                }else if(dispData.dt_refund_initiate_date != '' && dispData.dt_refund_initiate_date != null && dispData.i_neft_file_sent == 1 && dispData.i_neft_status != 1){
                    var statusOrg = 'Refund In Progress';
                }else if(dispData.dt_refund_initiate_date != '' && dispData.dt_refund_initiate_date != null && dispData.i_neft_status == 1){
                    var statusOrg = 'Refunded';
                }else{
                    var statusOrg = dispData.s_status;
                }
                
                var divElement = '<div class="order-details-center"><div class="popup-container popup-container-la">';
                divElement += '<h5 class="float-left primary-color margin-bottom-0">Document No: '+dispData.s_document_number+((dispData.userType == 'super_admin' && (dispData.s_app_version != '' && dispData.s_app_version != null))?'<small style="color: red;"> (V'+dispData.s_app_version+')</small>':'')+'</h5><h3 class="position-center align-center primary-color margin-bottom-0"><u>Order Details</u></h3>';
                divElement += '<div class=" float-right-sm align-right margin-right-sm"><div class=" float-right-sm "><span class="bagde bagde-'+clrStat+'" id="popupStatus">'+statusOrg+'</span></div></div><div class="clearfix"></div>';
                divElement += '<div class="row"><div class="col-me-12"><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                
                divElement += '<tr><td class="font-bold text-nowrap sort-highlight">Order Date</td><td class="text-nowrap">'+dispData.orderDate+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">CSR</td><td class="text-nowrap">'+dispData.CSR+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Branch</td><td class="text-nowrap">'+dispData.branch+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Mobile No.</td><td class="text-nowrap">'+((dispData.s_csr_mobile_number == '' || dispData.s_csr_mobile_number == null)?'-':dispData.s_csr_mobile_number)+'</td></tr>';
                divElement += '</tr></tbody></table></div></div>';
                
                
                
                if(dispData.i_payment_type == '2'){
                    divElement += '<div class="row">';
                    divElement += '<div class="col-me-2"><h5 class="primary-color margin-top-es margin-bottom-0">Customer Details</h5><div class="align-left"><img style="width: 16.9rem; border:1px solid; height: 21.49rem;" src="'+dispData.custProfImage+'"></div></div>';
                    divElement += '<div class="col-me-10"><h5 class="primary-color margin-top-es margin-bottom-0">&nbsp;</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';  
                }else{
                   divElement += '<div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-0">Customer Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';  
                }

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Customer</td><td class="text-nowrap">'+dispData.customerDetail.s_salutation+' '+dispData.customer+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Profile Id</td><td class="text-nowrap">'+((dispData.customerDetail.s_customer_profile_id == '' || dispData.customerDetail.s_customer_profile_id == null)?'-':dispData.customerDetail.s_customer_profile_id)+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Mobile No.</td><td class="text-nowrap">'+dispData.customerDetail.s_mobile_no+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Alternate Mobile No.</td><td class="text-nowrap">'+((dispData.customerDetail.s_alternate_mobile_no == '' || dispData.customerDetail.s_alternate_mobile_no == null)?'-':dispData.customerDetail.s_alternate_mobile_no)+'</td>';
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">DOB</td><td class="text-nowrap">'+dispData.customerDOb+' ('+dispData.customerDetail.i_age+' years)</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Center</td><td class="text-nowrap">'+((dispData.customerDetail.s_center_name == '' || dispData.customerDetail.s_center_name == null)?'-':dispData.customerDetail.s_center_name+' ('+dispData.customerDetail.s_center_code+')')+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Gender</td><td class="text-nowrap">'+dispData.customerDetail.e_gender+'</td>';

                //if(dispData.i_payment_type == '2'){
                dispData.customerDetail.e_marital_status = dispData.customerDetail.e_marital_status.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                    return letter.toUpperCase();
                });
                divElement += '<td class="font-bold text-nowrap sort-highlight">Marital Status</td><td class="text-nowrap">'+dispData.customerDetail.e_marital_status+'</td>';
                // }else{
                //     divElement += '<td class="font-bold text-nowrap" colspan="2"></td>';
                // }

                
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Father Name</td><td class="text-nowrap">'+((dispData.customerDetail.s_father_name == '' || dispData.customerDetail.s_father_name == null)?'-':dispData.customerDetail.s_father_salutation+' '+dispData.customerDetail.s_father_name)+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Spouse Name</td><td class="text-nowrap">'+((dispData.customerDetail.s_spouse_name == '' || dispData.customerDetail.s_spouse_name == null)?'-':dispData.customerDetail.s_spouse_salutation+' '+dispData.customerDetail.s_spouse_name)+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Branch Code</td><td class="text-nowrap">'+((dispData.s_customer_branch_code == '' || dispData.s_customer_branch_code == null || dispData.s_customer_branch_code == "null")?'-':dispData.s_customer_branch_code)+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td class="text-nowrap"></td>';
                divElement += '</tr>';

                divElement += '<tr>';

                if(dispData.i_payment_type == '2'){
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Delivery Address</td><td class="" colspan="3">'+dispData.customerDetail.s_current_address+', '+dispData.customerDetail.s_current_village+', '+dispData.customerCurrentDistrict+', '+dispData.customerCurrentState+', '+dispData.customerDetail.s_current_zip;
                    
                    divElement += '<br><b>Taluka/Block: </b>'+((dispData.customerDetail.s_current_taluka_block == '' || dispData.customerDetail.s_current_taluka_block == null)?'-':dispData.customerDetail.s_current_taluka_block);
                    divElement += '<br><b>Police Station: </b>'+((dispData.customerDetail.s_current_police_station == '' || dispData.customerDetail.s_current_police_station == null)?'-':dispData.customerDetail.s_current_police_station);
                    divElement += '<br><b>Post Office: </b>'+((dispData.customerDetail.s_current_post_office == '' || dispData.customerDetail.s_current_post_office == null)?'-':dispData.customerDetail.s_current_post_office);
                    
                    if (dispData.customerDetail.e_current_area == '' || dispData.customerDetail.e_current_area == null) {
                        dispData.customerDetail.e_current_area = '';
                    }else{
                        dispData.customerDetail.e_current_area = dispData.customerDetail.e_current_area.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                            return letter.toUpperCase();
                        });
                    }
                    

                    divElement += '<br><b>Area: </b>'+((dispData.customerDetail.e_current_area == '' || dispData.customerDetail.e_current_area == null)?'-':dispData.customerDetail.e_current_area);
                    divElement += '<br><b>Landmark: </b>'+((dispData.customerDetail.s_current_landmark == '' || dispData.customerDetail.s_current_landmark == null)?'-':dispData.customerDetail.s_current_landmark);
                }

                divElement += '</td>';

                if(dispData.i_payment_type == '1'){
                    var clspn = 7;
                    var lblPAddress = 'Delivery ';
                }else{
                    var clspn = 3;
                    var lblPAddress = 'Permanant ';
                }

                divElement += '<td class="font-bold text-nowrap sort-highlight">'+lblPAddress+'Address</td><td class="" colspan="'+clspn+'">'+dispData.customerDetail.s_permanent_address+', '+dispData.customerDetail.s_village+', '+dispData.customerDistrict+', '+dispData.customerState+', '+dispData.customerDetail.s_zip;
                //if(dispData.i_payment_type == '2'){
                    divElement += '<br><b>Taluka/Block: </b>'+((dispData.customerDetail.s_taluka_block == '' || dispData.customerDetail.s_taluka_block == null)?'-':dispData.customerDetail.s_taluka_block);
                    divElement += '<br><b>Police Station: </b>'+((dispData.customerDetail.s_police_station == '' || dispData.customerDetail.s_police_station == null)?'-':dispData.customerDetail.s_police_station);
                    divElement += '<br><b>Post Office: </b>'+((dispData.customerDetail.s_post_office == '' || dispData.customerDetail.s_post_office == null)?'-':dispData.customerDetail.s_post_office);
                    
                    if (dispData.customerDetail.e_area == '' || dispData.customerDetail.e_area == null) {
                        dispData.customerDetail.e_area = '';
                    }else{
                        dispData.customerDetail.e_area = dispData.customerDetail.e_area.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                            return letter.toUpperCase();
                        });
                    }
                    

                    divElement += '<br><b>Area: </b>'+((dispData.customerDetail.e_area == '' || dispData.customerDetail.e_area == null)?'-':dispData.customerDetail.e_area);
                    divElement += '<br><b>Landmark: </b>'+((dispData.customerDetail.s_landmark == '' || dispData.customerDetail.s_landmark == null)?'-':dispData.customerDetail.s_landmark);
                //}
                divElement += '</td></tr>';

                divElement += '</tbody></table></div></div>';


                if(dispData.i_payment_type == '2'){
                    divElement += '<div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-0">Customer KYC Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                    

                    if(dispData.s_adhar_number != '' && dispData.s_adhar_number != null){
                        divElement += '<tr>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Aadhar No.</td><td class="">'+((dispData.s_adhar_number == '' || dispData.s_adhar_number == null)?'-':dispData.s_adhar_number)+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Aadhar (Front)</td><td class="">'+((dispData.s_adhar_number == '' || dispData.s_adhar_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc2_front+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Aadhar (Back)</td><td class="">'+((dispData.s_adhar_number == '' || dispData.s_adhar_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc2_back+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '</tr>';
                    }

                    if(dispData.s_voter_card_number != '' && dispData.s_voter_card_number != null){
                        divElement += '<tr>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Voter No.</td><td class="">'+((dispData.s_voter_card_number == '' || dispData.s_voter_card_number == null)?'-':dispData.s_voter_card_number)+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Voter (Front)</td><td class="">'+((dispData.s_voter_card_number == '' || dispData.s_voter_card_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc1_front+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Voter (Back)</td><td class="">'+((dispData.s_voter_card_number == '' || dispData.s_voter_card_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc1_back+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '</tr>';
                    }

                    if(dispData.s_pan_number != '' && dispData.s_pan_number != null){
                        divElement += '<tr>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Pan No.</td><td class="">'+((dispData.s_pan_number == '' || dispData.s_pan_number == null)?'-':dispData.s_pan_number)+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Pan (Front)</td><td class="">'+((dispData.s_pan_number == '' || dispData.s_pan_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc4_front+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td></td>';
                        divElement += '</tr>';
                    }

                    if(dispData.s_ration_card_number != '' && dispData.s_ration_card_number != null){
                        divElement += '<tr>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Ration No.</td><td class="">'+((dispData.s_ration_card_number == '' || dispData.s_ration_card_number == null)?'-':dispData.s_ration_card_number)+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Ration (Front)</td><td class="">'+((dispData.s_ration_card_number == '' || dispData.s_ration_card_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc3_front+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Ration (Back)</td><td class="">'+((dispData.s_ration_card_number == '' || dispData.s_ration_card_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc3_back+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '</tr>';
                    }

                    if(dispData.s_driving_licence_number != '' && dispData.s_driving_licence_number != null){
                        divElement += '<tr>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Driving License No.</td><td class="">'+((dispData.s_driving_licence_number == '' || dispData.s_driving_licence_number == null)?'-':dispData.s_driving_licence_number)+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Driving License (Front)</td><td class="">'+((dispData.s_driving_licence_number == '' || dispData.s_driving_licence_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc5_front+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td></td>';
                        divElement += '</tr>';
                    }
                    
                    if(dispData.s_passport_number != '' && dispData.s_passport_number != null){
                        divElement += '<tr>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Passport No.</td><td class="">'+((dispData.s_passport_number == '' || dispData.s_passport_number == null)?'-':dispData.s_passport_number)+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Passport (Front)</td><td class="">'+((dispData.s_passport_number == '' || dispData.s_passport_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc6_front+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Passport (Back)</td><td class="">'+((dispData.s_passport_number == '' || dispData.s_passport_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc6_back+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '</tr>';
                    }

                    if(dispData.s_other_id_number != '' && dispData.s_other_id_number != null){
                        divElement += '<tr>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Other Id No.</td><td class="">'+((dispData.s_other_id_number == '' || dispData.s_other_id_number == null)?'-':dispData.s_other_id_number)+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Other Id (Front)</td><td class="">'+((dispData.s_other_id_number == '' || dispData.s_other_id_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc7_front+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Other Id (Back)</td><td class="">'+((dispData.s_other_id_number == '' || dispData.s_other_id_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc7_back+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '</tr>';
                    }

                    if(dispData.s_job_card_nrega_number != '' && dispData.s_job_card_nrega_number != null){
                        divElement += '<tr>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Job Card NREGA No.</td><td class="">'+((dispData.s_job_card_nrega_number == '' || dispData.s_job_card_nrega_number == null)?'-':dispData.s_job_card_nrega_number)+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">NREGA (Front)</td><td class="">'+((dispData.s_job_card_nrega_number == '' || dispData.s_job_card_nrega_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc8_front+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td class=""></td>';
                        divElement += '</tr>';
                    }

                    if(dispData.s_gaon_burah_certificate_number != '' && dispData.s_gaon_burah_certificate_number != null){
                        divElement += '<tr>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Gaon Burah Certificate No.</td><td class="">'+((dispData.s_gaon_burah_certificate_number == '' || dispData.s_gaon_burah_certificate_number == null)?'-':dispData.s_gaon_burah_certificate_number)+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Gaon Burah Certificate (Front)</td><td class="">'+((dispData.s_gaon_burah_certificate_number == '' || dispData.s_gaon_burah_certificate_number == null || dispData.s_status == 'KYC Pending')?'-':'<a href="'+base_url+dispData.customerDetail.s_kyc9_front+'" target="_blank">Click Here</a>')+'</td>';
                        divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td class=""></td>';
                        divElement += '</tr>';
                    }
                    
                    divElement += '</tbody></table></div></div>';
                }else if(dispData.i_payment_type == '1' && dispData.isInsured > 0){
                    divElement += '<div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-0">Customer KYC Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                    
                    divElement += '<tr>';

                    if(dispData.s_adhar_number != '' && dispData.s_adhar_number != null){
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Aadhar No.</td><td class="">'+((dispData.s_adhar_number == '' || dispData.s_adhar_number == null)?'-':dispData.s_adhar_number)+'</td>';
                    }

                    if(dispData.s_voter_card_number != '' && dispData.s_voter_card_number != null){
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Voter No.</td><td class="">'+((dispData.s_voter_card_number == '' || dispData.s_voter_card_number == null)?'-':dispData.s_voter_card_number)+'</td>';
                    }

                    if(dispData.s_pan_number != '' && dispData.s_pan_number != null){
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Pan No.</td><td class="">'+((dispData.s_pan_number == '' || dispData.s_pan_number == null)?'-':dispData.s_pan_number)+'</td>';
                    }

                    if(dispData.s_ration_card_number != '' && dispData.s_ration_card_number != null){
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Ration No.</td><td class="">'+((dispData.s_ration_card_number == '' || dispData.s_ration_card_number == null)?'-':dispData.s_ration_card_number)+'</td>';
                    }

                    if(dispData.s_driving_licence_number != '' && dispData.s_driving_licence_number != null){
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Driving License No.</td><td class="">'+((dispData.s_driving_licence_number == '' || dispData.s_driving_licence_number == null)?'-':dispData.s_driving_licence_number)+'</td>';
                    }
                    
                    if(dispData.s_passport_number != '' && dispData.s_passport_number != null){
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Passport No.</td><td class="">'+((dispData.s_passport_number == '' || dispData.s_passport_number == null)?'-':dispData.s_passport_number)+'</td>';
                    }

                    if(dispData.s_other_id_number != '' && dispData.s_other_id_number != null){
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Other Id No.</td><td class="">'+((dispData.s_other_id_number == '' || dispData.s_other_id_number == null)?'-':dispData.s_other_id_number)+'</td>';
                    }

                    if(dispData.s_job_card_nrega_number != '' && dispData.s_job_card_nrega_number != null){
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Job Card by NREGA</td><td class="">'+((dispData.s_job_card_nrega_number == '' || dispData.s_job_card_nrega_number == null)?'-':dispData.s_job_card_nrega_number)+'</td>';
                    }

                    if(dispData.s_gaon_burah_certificate_number != '' && dispData.s_gaon_burah_certificate_number != null){
                        divElement += '<td class="font-bold text-nowrap sort-highlight">Gaon Burah Certificate</td><td class="">'+((dispData.s_gaon_burah_certificate_number == '' || dispData.s_gaon_burah_certificate_number == null)?'-':dispData.s_gaon_burah_certificate_number)+'</td>';
                    }

                    divElement += '</tr>';
                    
                    divElement += '</tbody></table></div></div>';
                }

                var pathname = window.location.href; 
                pathname = pathname.replace(base_url, '');
                var parts = pathname.split("/");
                var last_part = parts[0];
                divElement += '<div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-0">Product Details</h5><table class="table-border table-odd-even table-head-color margin-bottom-es td-padding-5"><tbody>';
                
                // if(last_part == 'queryTool' || last_part == 'cancelOrder' || last_part == 'refundOrder' || last_part == 'rejectedOrder'){
                    var hdrStrng = '<th class="align-center text-nowrap">Status</th><th class="align-center text-nowrap">Cancelled By</th><th class="align-center text-nowrap">Reason (If any)</th>';
                // }else{
                //     if(dispData.s_status == 'Order Executed' || dispData.s_status == 'Delivered'){
                //         var hdrStrng = '<th class="align-center text-nowrap">Status</th>';
                //     }else{
                //         var hdrStrng = '';
                //     }
                // }

                divElement += '<th class="align-center text-nowrap">Order No.</th><th class="align-center text-nowrap">Product</th><th class="align-center text-nowrap">Qty.</th><th class="align-center text-nowrap">Total Price</th><th class="align-center text-nowrap">Pick-up</th>'+hdrStrng;
                for (var i = 0; i < dispData.products.length; i++) {

                    if(dispData.products[i].s_status == 'Approved')
                        var clrStatPrd = 'primary';
                    else if(dispData.products[i].s_status == 'Order Executed')
                        var clrStatPrd = 'warning';
                    else if(dispData.products[i].s_status == 'Send To Hub')
                        var clrStatPrd = 'secondary';
                    else if(dispData.products[i].s_status == 'Delivered')
                        var clrStatPrd = 'success';
                    else if(dispData.products[i].s_status == 'Cancelled' || dispData.products[i].s_status == 'Request to cancel')
                        var clrStatPrd = 'error';
                    else
                        var clrStatPrd = 'primary';

                    if(last_part == 'queryTool' || last_part == 'cancelOrder' || last_part == 'refundOrder' || last_part == 'rejectedOrder' || last_part == 'orderReport' || last_part == 'requestCancelOrder'){
                        if(dispData.products[i].s_status == 'Cancelled' || dispData.products[i].s_status == 'Request to cancel'){
                            if(dispData.dt_refund_initiate_date != '' && dispData.dt_refund_initiate_date != null && dispData.i_neft_file_sent == 0){
                                var statusOrgProd = 'Refund Initiated';
                            }else if(dispData.dt_refund_initiate_date != '' && dispData.dt_refund_initiate_date != null && dispData.i_neft_file_sent == 1 && dispData.i_neft_status != 1){
                                var statusOrgProd = 'Refund In Progress';
                            }else if(dispData.dt_refund_initiate_date != '' && dispData.dt_refund_initiate_date != null && dispData.i_neft_status == 1){
                                var statusOrgProd = 'Refunded';
                            }else{
                                var statusOrgProd = dispData.products[i].s_status;
                            }
                            var dlvrdStrng = '<td class="align-center text-nowrap"><span class="error-color">'+statusOrgProd+' '+((dispData.products[i].s_status == 'Cancelled')?('(Refund: &#8377; '+addCommas(parseFloat(dispData.products[i].refundAmt))+'/-)'):'')+'</span></td><td class="align-center text-nowrap">'+dispData.products[i].cancelledBy+'</td><td class="align-center text-nowrap action-tooltip tooltip-width">'+((dispData.products[i].cancelReason == '' || dispData.products[i].cancelReason == null)?'-':'<a class="tooltip left-center" data-tooltip="'+dispData.products[i].cancelReason+'"><i class="fas fa-info-circle"></i><div class="tooltip-content">'+dispData.products[i].cancelReason+'</div></a>')+'</td>';
                        }else{
                            var dlvrdStrng = '<td class="align-center text-nowrap"><span class="'+clrStatPrd+'-color">'+dispData.products[i].s_status+'</span></td><td class="align-center text-nowrap">-</td><td class="align-center text-nowrap">-</td>';
                        }
                    }else{
                        if(dispData.userType == 'checker' || dispData.userType == 'am'){
                            
                            if(dispData.products[i].s_status == 'Cancelled' || dispData.products[i].s_status == 'Request to cancel'){
                                if(dispData.dt_refund_initiate_date != '' && dispData.dt_refund_initiate_date != null && dispData.i_neft_file_sent == 0){
                                    var statusOrgProd = 'Refund Initiated';
                                }else if(dispData.dt_refund_initiate_date != '' && dispData.dt_refund_initiate_date != null && dispData.i_neft_file_sent == 1 && dispData.i_neft_status != 1){
                                    var statusOrgProd = 'Refund In Progress';
                                }else if(dispData.dt_refund_initiate_date != '' && dispData.dt_refund_initiate_date != null && dispData.i_neft_status == 1){
                                    var statusOrgProd = 'Refunded';
                                }else{
                                    var statusOrgProd = dispData.products[i].s_status;
                                }
                                var dlvrdStrng = '<td class="align-center text-nowrap"><span class="error-color">'+statusOrgProd+' '+((dispData.products[i].adjustType == '2')?'(Refund: &#8377; '+addCommas(parseFloat(dispData.products[i].refundAmt))+'/-)':((dispData.products[i].adjustType == '1')?'(Loan Amt. Adjusted)':''))+'</span></td><td class="align-center text-nowrap">'+dispData.products[i].cancelledBy+'</td><td class="align-center text-nowrap action-tooltip tooltip-width">'+((dispData.products[i].cancelReason == '' || dispData.products[i].cancelReason == null)?'-':'<a class="tooltip left-center" data-tooltip="'+dispData.products[i].cancelReason+'"><i class="fas fa-info-circle"></i><div class="tooltip-content">'+dispData.products[i].cancelReason+'</div></a>')+'</td>';
                            }else{
                                if(dispData.products[i].vendorId == '2' || dispData.products[i].vendorId == '3'){
                                    var dlvrdStrng = '<td class="align-center text-nowrap"><div class="input-inline align-center"><div class="checkbox"><input type="checkbox" onclick="saveOrderStatProdWise(\''+dispData.products[i].orderId+'\');" id="delivered_'+dispData.products[i].orderId+'" name="deliveryProduct_'+dispData.products[i].orderId+'" value="1" '+((dispData.products[i].s_status == 'Delivered')?'checked disabled':'')+'><label for="delivered_'+dispData.products[i].orderId+'">Delivered</label></div><div></td><td class="align-center">-</td><td class="align-center">-</td>';
                                }else{
                                    var dlvrdStrng = '<td class="align-center text-nowrap"><span class="'+clrStatPrd+'-color">'+dispData.products[i].s_status+'</span></td><td class="align-center text-nowrap">-</td><td class="align-center text-nowrap">-</td>';
                                }
                            }
                        }else{
                            if(dispData.products[i].s_status == 'Cancelled' || dispData.products[i].s_status == 'Request to cancel'){
                                if(dispData.dt_refund_initiate_date != '' && dispData.dt_refund_initiate_date != null && dispData.i_neft_file_sent == 0){
                                    var statusOrgProd = 'Refund Initiated';
                                }else if(dispData.dt_refund_initiate_date != '' && dispData.dt_refund_initiate_date != null && dispData.i_neft_file_sent == 1 && dispData.i_neft_status != 1){
                                    var statusOrgProd = 'Refund In Progress';
                                }else if(dispData.dt_refund_initiate_date != '' && dispData.dt_refund_initiate_date != null && dispData.i_neft_status == 1){
                                    var statusOrgProd = 'Refunded';
                                }else{
                                    var statusOrgProd = dispData.products[i].s_status;
                                }
                                var dlvrdStrng = '<td class="align-center text-nowrap"><span class="error-color">'+statusOrgProd+' '+((dispData.products[i].adjustType == '2')?'(Refund: &#8377; '+addCommas(parseFloat(dispData.products[i].refundAmt))+'/-)':((dispData.products[i].adjustType == '1')?'(Loan Amt. Adjusted)':''))+'</span></td><td class="align-center text-nowrap">'+dispData.products[i].cancelledBy+'</td><td class="align-center text-nowrap action-tooltip tooltip-width">'+((dispData.products[i].cancelReason == '' || dispData.products[i].cancelReason == null)?'-':'<a class="tooltip left-center" data-tooltip="'+dispData.products[i].cancelReason+'"><i class="fas fa-info-circle"></i><div class="tooltip-content">'+dispData.products[i].cancelReason+'</div></a>')+'</td>';
                            }else if(dispData.products[i].s_status == 'Delivered' || dispData.products[i].s_status == 'Order Executed'){
                                var dlvrdStrng = '<td class="align-center text-nowrap"><div class="input-inline align-center"><div class="checkbox"><input type="checkbox" onclick="saveOrderStatProdWise(\''+dispData.products[i].orderId+'\');" id="delivered_'+dispData.products[i].orderId+'" name="deliveryProduct_'+dispData.products[i].orderId+'" value="1" '+((dispData.products[i].s_status == 'Delivered')?'checked disabled':'')+'><label for="delivered_'+dispData.products[i].orderId+'">Delivered</label></div><div></td><td class="align-center text-nowrap">-</td><td class="align-center text-nowrap">-</td>';
                            }else{
                                var dlvrdStrng = '<td class="align-center text-nowrap"><span class="'+clrStatPrd+'-color">'+dispData.products[i].s_status+'</span></td><td class="align-center text-nowrap">-</td><td class="align-center text-nowrap">-</td>';
                            }
                        }
                    }

                    divElement += '<tr><td class="align-center text-nowrap">'+dispData.products[i].s_order_number+'</td><td class="align-left text-nowrap">'+dispData.products[i].s_product_name+'</td><td class="align-center text-nowrap">'+dispData.products[i].i_quantity+'</td><td class="align-right text-nowrap">&#8377; '+addCommas(dispData.products[i].d_price)+'/-</td><td class="align-left text-nowrap">'+dispData.products[i].s_pickup_address+'</td>'+dlvrdStrng+'</tr>';
                }
                
                divElement += '</tbody></table></div></div>';

                if(dispData.i_payment_type == '2'){
                    divElement += '<div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-0">Loan Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                    divElement += '<tr>';

                    divElement += '<td class="font-bold text-nowrap sort-highlight">Loan Amt.</td><td class="align-right text-nowrap">&#8377; '+addCommas(dispData.d_loan_amount)+'/-</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Interest Rate</td><td class="align-right text-nowrap">'+dispData.d_interest_rate+'%</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Tenure</td><td class="align-left text-nowrap">'+dispData.i_tenure+' Months</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Monthly EMI</td><td class="align-right text-nowrap">&#8377; '+addCommas(dispData.d_monthly_emi)+'/-</td>';
                    divElement += '</tr>';
                    
                    divElement += '</tbody></table></div></div>';
                }

                divElement += '<div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-0">Payment Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';  
                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Payment Type</td><td class="text-nowrap">'+dispData.paymentType+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Receipt No.</td><td class="text-nowrap">'+dispData.s_receipt_number+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Book No.</td><td class="text-nowrap">'+dispData.s_book_number+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Delivery Charge</td><td class="align-right text-nowrap">&#8377; '+((dispData.d_delivery_charges == '' || dispData.d_delivery_charges == null)?'0.00':addCommas(dispData.d_delivery_charges))+'/-</td>';
                divElement += '</tr>';


                if(dispData.i_payment_type == '2'){
                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Down Payment</td><td class="align-right text-nowrap">&#8377; '+addCommas(dispData.d_down_payment)+'/-</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Loan Processing Fee (LPF)</td><td class="align-right text-nowrap">&#8377; '+addCommas(dispData.d_processing_fees)+'/-</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">GST on LPF</td><td class="align-right text-nowrap">&#8377; '+addCommas(dispData.d_gst_credit)+'/-</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Insurance Amt.</td><td class="align-right text-nowrap">&#8377; '+addCommas(dispData.d_insurance_amt)+'/-</td>';
                    divElement += '</tr>';
                }

                if(dispData.i_payment_type == '2'){
                    var payableAmtRaw = Math.round(parseFloat(dispData.d_down_payment)+Math.round(parseFloat(dispData.d_processing_fees))+Math.round(parseFloat(dispData.d_gst_credit))+Math.round(parseFloat(dispData.d_insurance_amt))+parseFloat((dispData.d_delivery_charges == '' || dispData.d_delivery_charges == null)?0.00:dispData.d_delivery_charges));
                    var payableAmt = addCommas(Math.round(parseFloat(dispData.d_down_payment)+Math.round(parseFloat(dispData.d_processing_fees))+Math.round(parseFloat(dispData.d_gst_credit))+Math.round(parseFloat(dispData.d_insurance_amt))+parseFloat((dispData.d_delivery_charges == '' || dispData.d_delivery_charges == null)?0.00:dispData.d_delivery_charges)));
                    var revisedPayableAmt = addCommas(payableAmtRaw-dispData.refundAmtTotal);
                }else{
                    var payableAmt = addCommas(parseFloat(dispData.products[dispData.products.length - 1].totPrice)+parseFloat(dispData.products[dispData.products.length - 1].totDelCharges));
                    var revisedPayableAmt = addCommas(parseFloat(dispData.products[dispData.products.length - 1].totPriceRevised)+parseFloat(dispData.products[dispData.products.length - 1].totDelChargesRevised));
                }

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Payable Amount</td><td class="align-right text-nowrap" colspan="7">&#8377; '+payableAmt+'/-</td>';
                divElement += '</tr>';

                if(dispData.hasCancldOrdr == '1'){
                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Revised Payable Amount</td><td class="align-right text-nowrap" colspan="7">&#8377; '+revisedPayableAmt+'/-</td>';
                    divElement += '</tr>';
                }

                divElement += '</tbody></table></div></div>';

                if(dispData.i_payment_type == '2'){
                    divElement += '<div class="row"><div class="col-me-6"><h5 class="primary-color margin-top-es margin-bottom-0">Income Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                    
                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">(A) Business Income</td><td class="align-right text-nowrap">'+((dispData.d_business_income == '' || dispData.d_business_income == null)?'&#8377; 0.00/-':'&#8377; '+addCommas(dispData.d_business_income)+'/-')+'</td>';
                    divElement += '</tr>';
                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">(B) Other Income</td><td class="align-right text-nowrap">'+((dispData.d_other_income == '' || dispData.d_other_income == null)?'&#8377; 0.00/-':'&#8377; '+addCommas(dispData.d_other_income)+'/-')+'</td>';
                    divElement += '</tr>';
                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">(C) Existing EMI</td><td class="align-right text-nowrap">'+((dispData.d_existing_emi == '' || dispData.d_existing_emi == null)?'&#8377; 0.00/-':'&#8377; '+addCommas(dispData.d_existing_emi)+'/-')+'</td>';
                    divElement += '</tr>';

                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Total Income (A+B-C)</td><td class="align-right text-nowrap font-bold" colspan="5">'+((dispData.d_total_income == '' || dispData.d_total_income == null)?'&#8377; 0.00/-':'&#8377; '+addCommas(dispData.d_total_income)+'/-')+'</td>';
                    divElement += '</tr>';
                    divElement += '</tbody></table></div>';

                    divElement += '<div class="col-me-6"><h5 class="primary-color margin-top-es margin-bottom-0">Expense Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">(D) Other Payment</td><td class="align-right text-nowrap">'+((dispData.d_other_payment == '' || dispData.d_other_payment == null)?'&#8377; 0.00/-':'&#8377; '+addCommas(dispData.d_other_payment)+'/-')+'</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">(E) Fuel/Electricity</td><td class="align-right text-nowrap">'+((dispData.d_fuel == '' || dispData.d_fuel == null)?'&#8377; 0.00/-':'&#8377; '+addCommas(dispData.d_fuel)+'/-')+'</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">(F) Food</td><td class="align-right text-nowrap">'+((dispData.d_food == '' || dispData.d_food == null)?'&#8377; 0.00/-':'&#8377; '+addCommas(dispData.d_food)+'/-')+'</td>';
                    divElement += '</tr>';

                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">(G) Education</td><td class="align-right text-nowrap">'+((dispData.d_other_payment == '' || dispData.d_education == null)?'&#8377; 0.00/-':'&#8377; '+addCommas(dispData.d_education)+'/-')+'</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">(H) Rent</td><td class="align-right text-nowrap">'+((dispData.d_other_payment == '' || dispData.d_rent == null)?'&#8377; 0.00/-':'&#8377; '+addCommas(dispData.d_rent)+'/-')+'</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">(I) Medical</td><td class="align-right text-nowrap">'+((dispData.d_medical == '' || dispData.d_medical == null)?'&#8377; 0.00/-':'&#8377; '+addCommas(dispData.d_medical)+'/-')+'</td>';
                    divElement += '</tr>';

                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">(J) Other Expenses</td><td class="align-right text-nowrap">'+((dispData.d_other_expenses == '' || dispData.d_other_expenses == null)?'&#8377; 0.00/-':'&#8377; '+addCommas(dispData.d_other_expenses)+'/-')+'</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td class="align-right text-nowrap"></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td class="align-right text-nowrap"></td>';
                    divElement += '</tr>';

                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Total Expense (D to J)</td><td class="align-right text-nowrap font-bold" colspan="9">&#8377; '+addCommas(dispData.d_total_expense)+'/-</td>';
                    divElement += '</tr>';

                    
                    
                    divElement += '</tbody></table></div></div>';

                    divElement += '<div class="row"><div class="col-me-12"><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                    
                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight primary-color">Surplus (Total Income - Total Expense)</td><td class="align-right text-nowrap font-bold" colspan="9">&#8377; '+addCommas(dispData.d_surplus)+'/-</td>';
                    divElement += '</tr>';

                    divElement += '</tbody></table></div></div>';
                }

                if(dispData.s_ifsc != '' && dispData.s_ifsc != null){
                    divElement += '<div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-es">Bank Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>'; 
                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Account Number</td><td class="align-right text-nowrap">'+((dispData.s_account_number == '' || dispData.s_account_number == null)?'-':dispData.s_account_number)+'</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Account Holder Name</td><td class="align-right text-nowrap">'+((dispData.s_account_holder_name == '' || dispData.s_account_holder_name == null)?'-':dispData.s_account_holder_name)+'</td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">IFSC</td><td class="align-right text-nowrap">'+((dispData.s_ifsc == '' || dispData.s_ifsc == null)?'-':dispData.s_ifsc)+'</td>';
                    divElement += '</tr>';
                    divElement += '</tbody></table></div></div>';
                }

                
                // if(dispData.s_status == 'Cancelled'){

                //     if(dispData.i_payment_type == '2'){
                //         if(dispData.i_reason_type == '1'){
                //             var refundAmt = addCommas(Math.round(parseFloat(dispData.d_down_payment)+Math.round(parseFloat(dispData.d_gst_credit))+Math.round(parseFloat(dispData.d_insurance_amt))+parseFloat((dispData.d_delivery_charges == '' || dispData.d_delivery_charges == null)?0.00:dispData.d_delivery_charges)));
                //         }else{
                //             var refundAmt = addCommas(Math.round(parseFloat(dispData.d_down_payment)+Math.round(parseFloat(dispData.d_processing_fees))+Math.round(parseFloat(dispData.d_gst_credit))+Math.round(parseFloat(dispData.d_insurance_amt))+parseFloat((dispData.d_delivery_charges == '' || dispData.d_delivery_charges == null)?0.00:dispData.d_delivery_charges)));
                //         }
                //     }else{
                //         var refundAmt = addCommas(parseFloat(dispData.products[dispData.products.length - 1].totPrice)+parseFloat(dispData.products[dispData.products.length - 1].totDelCharges));
                //     }

                //     divElement += '<div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-es">Cancellation Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>'; 
                //     divElement += '<tr>';
                //     divElement += '<td class="font-bold text-nowrap sort-highlight">Refund Amt.</td><td class="align-right text-nowrap">&#8377; '+refundAmt+'/-</td>';
                //     divElement += '<td class="font-bold text-nowrap sort-highlight">Cancelled By</td><td class="align-right text-nowrap">'+((dispData.i_reason_type == '1')?'Head Office':'Customer/BH/BQH')+'</td>';
                //     divElement += '<td class="font-bold text-nowrap sort-highlight">Reason (If any)</td><td class="align-right text-nowrap">'+((dispData.s_reason_text == '' || dispData.s_reason_text == null)?'-':dispData.s_reason_text)+'</td>';
                //     divElement += '</tr>';
                //     divElement += '</tbody></table></div></div>';
                // }

                divElement += '<div class="row"><div class="col-me-3"><h5 class="primary-color margin-top-es margin-bottom-es">Customer Signature</h5>';  
                divElement += '<div><img style="width: 7.5rem;" src="'+dispData.custSignImage+'"></div>';
                divElement += '</div></div>';

                if(dispData.i_is_loan_override == '1'){

                    if(dispData.s_cb_fail_reason == 'Borrower has active loan from 3 Lender'){
                        dispData.s_cb_fail_reason = 'NOC submitted against more than 3 lender';
                    }else if(dispData.s_cb_fail_reason == 'Borrower has more than one Active MFIs Except Arohan.'){
                        dispData.s_cb_fail_reason = 'NOC submitted against more than one MFI';
                    }else if(dispData.s_cb_fail_reason == 'Overdue amount is greater than Rs. 100/-'){
                        dispData.s_cb_fail_reason = 'NOC submitted against Overdue/ default';
                    }else if(dispData.s_cb_fail_reason == 'Borrower Defaulted in One or more MFIs.'){
                        dispData.s_cb_fail_reason = 'NOC submitted against Overdue/ default';
                    }
                    
                    divElement += '<form id="formNocUpload" method="POST" enctype="multipart/form-data"><input type="hidden" name="_token" value="'+$('meta[name="csrf-token"]').attr('content')+'"><input type="hidden" name="document_number" value="'+dispData.s_document_number+'"><input type="hidden" name="customerId" value="'+dispData.i_customer_id+'"><div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-es">Supporting NOC Documents</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>'; 
                    divElement += '<tr><td class="font-bold text-nowrap sort-highlight">Loan Override Reason</td><td colspan="7">'+((dispData.s_cb_fail_reason == '' || dispData.s_cb_fail_reason == null)?'-':dispData.s_cb_fail_reason)+'</td></tr>'; 
                    if(last_part == 'newOrder' && dispData.s_status == 'New' && (dispData.userType == 'checker' || dispData.userType == 'am')){   
                        divElement += '<tr><td class="text-nowrap" colspan="2">';
                        divElement += '<div class="col-sm-12"><div class="file-upload-part"><div class="upload-file-container"><input type="file" class="file-upload" name="nocDoc1" id="nocDoc1" accept="image/*"></div><a href="javascript:void(0);" class="link-gray text-decoration upload-file-btn"><i class="material-icons">cloud_upload</i>Upload Document 1 </a><ul class="list-no-bullet file-name-list" style="margin: 0 0 1rem;"></ul></div></td>';
                        
                        divElement += '<td class="text-nowrap" colspan="2">';
                        divElement += '<div class="col-sm-12"><div class="file-upload-part"><div class="upload-file-container"><input type="file" class="file-upload" name="nocDoc2" id="nocDoc2" accept="image/*"></div><a href="javascript:void(0);" class="link-gray text-decoration upload-file-btn"><i class="material-icons">cloud_upload</i>Upload Document 2</a><ul class="list-no-bullet file-name-list" style="margin: 0 0 1rem;"></ul></div></td>';
                        
                        divElement += '<td class="text-nowrap" colspan="3">';
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
                            modhtml += '<td class="font-bold text-nowrap sort-highlight">Document '+(i+1)+'</td><td class="text-nowrap" style="width: 25%;"">'+((i in docPathSplit && (docPathSplit[i] != ''))?'<a data-fileName="'+docPathSplit[i]+'" href="'+base_url+docPathSplit[i]+'" target="_blank">'+docPathSplit[i].substring(docPathSplit[i].lastIndexOf('/') + 1)+'</a>'+((last_part == 'newOrder' && dispData.s_status == 'New' && (dispData.userType == 'checker' || dispData.userType == 'am'))?'<a href="javascript:void(0);"" class="icon-button button-red file-close dltNocDocs" style="padding: 0;" data-fileName="'+docPathSplit[i]+'"><i class="material-icons">close</i></a>':''):'-')+'</td>';
                            if(docPathSplit[i] != ''){
                                uploadedFileCnt++;  
                            }  
                        }
                        modhtml = modhtml.replace(/,\s*$/, "");
                        divElement += modhtml;
                        divElement += '</tr>';
                    }
                    //else{
                    //     divElement += '<tr><td class="text-nowrap" colspan="8"><div class="col-sm-12">No documents uploaded yet.</div></td></tr>';
                    // }
                    divElement += '</tbody></table></div></div></form>';
                }

                var urlToHit = base_url+window.location.href.replace(base_url,'');

                if(dispData.userType == 'checker' || dispData.userType == 'bp' || dispData.userType == 'am'){
                    divElement += '<button title="Close" type="button" class="mfp-close" onclick="sortData(\''+urlToHit+'\', \'\', \'1\')">×</button>';
                }else{
                    divElement += '<button title="Close" type="button" class="mfp-close">×</button>';
                }

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
                            fragment += "<li><strong>Attachment: </strong>" + fileName + "(" + fileSize + " bytes) - <strong> Type: </strong>" + fileType + "<a href='javascript:void(0);' class='icon-button button-red file-close custom-file-class'><i class='material-icons'>close</i></a></li>";
                        }
                        $(this).parents(".file-upload-part").find(".file-name-list").append(fragment);
                    }
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
                        $("body").addClass('only-read-view');
                        $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                        });

                        $.ajax({
                            url: base_url+"deleteNocDoc",
                            type:"POST",
                            data: {
                                document_number: $('[name="document_number"]').val(),
                                fileName: fileName
                            },
                            dataType: "json",
                            success:function(data){
                                hideLoader("body");
                                $("body").removeClass('only-read-view');
                                if(data.status != 'error'){ 
                                    var msgHdng = '<h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3>';
                                }else{
                                    var msgHdng = '<h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3>';
                                }
                                var divElementSuccess = '<div class="mfp-bg mfp-ready" id="scndBg"><div id="nocDeleteSuccPopup" style="position:fixed; z-index:9999; top: 40%; left: 35%;" class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" id="okbtnNocDoc">Ok</button></div></div>';
                                $(".order-details-center").after(divElementSuccess);

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
                    $(".order-details-center").addClass('only-read-view');

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
                            $("body").removeClass('only-read-view');
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
                
                hideLoader("body");
                $(".order-details-center").removeClass('only-read-view');
            },
            complete: function(xhr, textStatus) {
                checkIfLogout(xhr);
            }
        });
    });

    
    var tempKYCArr = [];
    $(".editOrder").click(function(){
        showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
        $("body").addClass('only-read-view');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
            url: base_url+"orderDetailEdit",
            type:"POST",
            data: {
                orderId: $(this).attr('data-ordrid')
            },
            dataType: "json",
            success:function(data){
                var dispData = data.dataDetail[0];

                if(dispData.s_status == 'Approved')
                    var clrStat = 'primary';
                else if(dispData.s_status == 'Order Executed')
                    var clrStat = 'warning';
                else if(dispData.s_status == 'Pending Delivery')
                    var clrStat = 'warning';
                else if(dispData.s_status == 'Delivered')
                    var clrStat = 'success';
                else if(dispData.s_status == 'Cancelled' || dispData.s_status == 'Request to cancel')
                    var clrStat = 'error';
                else
                    var clrStat = 'primary';
                
                var divElement = '<div class="order-details-center"><div class="popup-container popup-container-la">';
                divElement += '<h5 class="float-left primary-color margin-bottom-0">Document No: '+dispData.s_document_number+'</h5><h3 class="position-center align-center primary-color margin-bottom-0"><u>Order Details</u></h3>';
                divElement += '<div class=" float-right-sm align-right margin-right-sm"><div class=" float-right-sm "><span class="bagde bagde-'+clrStat+'" id="popupStatus">'+dispData.s_status+'</span></div></div><div class="clearfix"></div>';
                divElement += '<div class="row"><div class="col-me-12 table-responsive margin-bottom-sm"><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                
                divElement += '<tr><td class="font-bold text-nowrap sort-highlight">Order Date</td><td class="text-nowrap">'+dispData.orderDate+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">CSR</td><td class="text-nowrap">'+dispData.CSR+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Branch</td><td class="text-nowrap">'+dispData.branch+'</td></tr>';

                divElement += '</tbody></table></div></div>';

                divElement += '<form id="saveOrderForm" method="POST" enctype="multipart/form-data" action="'+base_url+'saveOrder"><div class="row"><div class="col-me-12 table-responsive margin-bottom-sm"><h5 class="primary-color margin-top-es margin-bottom-0">Delivery Address</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';  
                
                divElement += '<input type="hidden" name="documentNumberEdit" value="'+dispData.s_document_number+'">';
                divElement += '<tr><td class="font-bold text-nowrap sort-highlight">Address Line</td><td class="" colspan="7"><div class="form-panel"><input type="text" placeholder="Delivery Address Line" class="input-panel" name="currentAddrEdit" id="currentAddrEdit" value="'+dispData.customerDetail.s_current_address+'"><span class="error-message"></span></div></td></tr>';
                
                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">City/Village</td><td class=""><div class="form-panel"><input type="text" placeholder="City/Village" class="input-panel" name="currentCityEdit" id="currentCityEdit" value="'+dispData.customerDetail.s_current_village+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">State</td><td class=""><div class="form-panel"><select class="input-panel" name="currentStateEdit" id="currentStateEdit">'+dispData.customerCurrentStateList+'</select></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">District</td><td class=""><div class="form-panel"><select class="input-panel" name="currentDistrictEdit" id="currentDistrictEdit"><option value=""> -- Select District -- </option>'+dispData.customerCurrentDistrictList+'</select></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Pincode</td><td class=""><div class="form-panel"><input type="text" class="input-panel numeric" name="currentPincodeEdit" id="currentPincodeEdit" value="'+dispData.customerDetail.s_current_zip+'" minlength="6" maxlength="6"></div></td>';
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Taluka/Block</td><td class=""><div class="form-panel"><input type="text" placeholder="City/Village" class="input-panel" name="currentTalukaEdit" id="currentTalukaEdit" value="'+dispData.customerDetail.s_current_taluka_block+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Police Station</td><td class=""><div class="form-panel"><input type="text" class="input-panel" name="currentPoliceStationEdit" id="currentPoliceStationEdit" value="'+dispData.customerDetail.s_current_police_station+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Post Office</td><td class=""><div class="form-panel"><input type="text" class="input-panel" name="currentPostOfficeEdit" id="currentPostOfficeEdit" value="'+dispData.customerDetail.s_current_post_office+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Landmark</td><td class=""><div class="form-panel"><input type="text" class="input-panel" name="currentLandmarkEdit" id="currentLandmarkEdit" value="'+dispData.customerDetail.s_current_landmark+'"></div></td>';
                divElement += '</tr>';
                
                divElement += '</tbody></table></div></div>';



                if(dispData.i_payment_type == '1'){
                    var lblPAddress = '';
                }else{
                    var lblPAddress = 'Permanant ';
                }

                divElement += '<div class="row"><div class="col-me-12 table-responsive margin-bottom-sm"><h5 class="primary-color margin-top-es margin-bottom-0">Permanent Address</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';  
            
                divElement += '<tr><td class="font-bold text-nowrap sort-highlight">Address Line</td><td class="" colspan="7"><div class="form-panel"><input type="text" placeholder="Delivery Address Line" class="input-panel" name="addrEdit" id="addrEdit" value="'+dispData.customerDetail.s_permanent_address+'"></div></td></tr>';
                
                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">City/Village</td><td class=""><div class="form-panel"><input type="text" placeholder="City/Village" class="input-panel" name="cityEdit" id="cityEdit" value="'+dispData.customerDetail.s_village+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">State</td><td class=""><div class="form-panel"><select class="input-panel" name="stateEdit" id="stateEdit">'+dispData.customerStateList+'</select></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">District</td><td class=""><div class="form-panel"><select class="input-panel" name="districtEdit" id="districtEdit"><option value=""> -- Select District -- </option>'+dispData.customerDistrictList+'</select></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Pincode</td><td class=""><div class="form-panel"><input type="text" class="input-panel numeric" name="pincodeEdit" id="pincodeEdit" value="'+dispData.customerDetail.s_zip+'" minlength="6" maxlength="6"></div></td>';
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Taluka/Block</td><td class=""><div class="form-panel"><input type="text" placeholder="City/Village" class="input-panel" name="talukaEdit" id="talukaEdit" value="'+dispData.customerDetail.s_taluka_block+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Police Station</td><td class=""><div class="form-panel"><input type="text" class="input-panel" name="policeStationEdit" id="policeStationEdit" value="'+dispData.customerDetail.s_police_station+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Post Office</td><td class=""><div class="form-panel"><input type="text" class="input-panel" name="postOfficeEdit" id="postOfficeEdit" value="'+dispData.customerDetail.s_post_office+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Landmark</td><td class=""><div class="form-panel"><input type="text" class="input-panel" name="landmarkEdit" id="landmarkEdit" value="'+dispData.customerDetail.s_landmark+'"></div></td>';
                divElement += '</tr>';
                

                divElement += '</tbody></table></div></div>';


                divElement += '<div class="row"><div class="col-me-12 table-responsive margin-bottom-sm"><h5 class="primary-color margin-top-es margin-bottom-0">Customer KYC Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';  
                
                
                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Aadhar No.</td><td class=""><div class="form-panel"><input type="text" placeholder="Aadhar Number" class="input-panel numeric kycfld" name="aadharNumEdit" id="aadharNumEdit" value="'+dispData.s_adhar_number+'" maxlength="12"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Aadhar (Front)</td><td class=""><div class="form-panel"><input '+((dispData.s_adhar_number.trim() == '')?'':'')+' type="file" accept="image/jpg, image/jpeg, image/png" placeholder="Aadhar Number" class="input-panel" name="aadharFrontEdit" id="aadharFrontEdit"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Aadhar (Back)</td><td class=""><div class="form-panel"><input '+((dispData.s_adhar_number.trim() == '')?'':'')+' type="file" accept="image/jpg, image/jpeg, image/png" placeholder="Aadhar Number" class="input-panel" name="aadharBackEdit" id="aadharBackEdit"></div></td>';
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Voter No.</td><td class=""><div class="form-panel"><input type="text" placeholder="Voter Number" class="input-panel kycfld" name="voterNumEdit" id="voterNumEdit" value="'+dispData.s_voter_card_number+'" minlength="10" maxlength="25"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Voter (Front)</td><td class=""><div class="form-panel"><input '+((dispData.s_voter_card_number.trim() == '')?'':'')+' type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="voterFrontEdit" id="voterFrontEdit"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Voter (Back)</td><td class=""><div class="form-panel"><input '+((dispData.s_voter_card_number.trim() == '')?'':'')+' type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="voterBackEdit" id="voterBackEdit"></div></td>';
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Pan No.</td><td class=""><div class="form-panel"><input type="text" placeholder="Pan Number" class="input-panel kycfld" name="panNumEdit" id="panNumEdit" value="'+dispData.s_pan_number+'" maxlength="10"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Pan (Front)</td><td class=""><div class="form-panel"><input '+((dispData.s_pan_number.trim() == '')?'':'')+' type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="panFrontEdit" id="panFrontEdit"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td class=""></td>';
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Ration No.</td><td class=""><div class="form-panel"><input type="text" placeholder="Ration Number" class="input-panel kycfld" name="rationNumEdit" id="rationNumEdit" value="'+dispData.s_ration_card_number+'" minlength="5" maxlength="25"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Ration (Front)</td><td class=""><div class="form-panel"><input '+((dispData.s_ration_card_number.trim() == '')?'':'')+' type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="rationFrontEdit" id="rationFrontEdit"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Ration (Back)</td><td class=""><div class="form-panel"><input '+((dispData.s_ration_card_number.trim() == '')?'':'')+' type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="rationBackEdit" id="rationBackEdit"></div></td>';
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Driving License No.</td><td class=""><div class="form-panel"><input type="text" placeholder="Driving License Number" class="input-panel kycfld" name="drivingNumEdit" id="drivingNumEdit" value="'+dispData.s_driving_licence_number+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Driving License (Front)</td><td class=""><div class="form-panel"><input '+((dispData.s_driving_licence_number.trim() == '')?'':'')+' type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="drivingFrontEdit" id="drivingFrontEdit"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td class=""></td>';
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Passport No.</td><td class=""><div class="form-panel"><input type="text" placeholder="Passport Number" class="input-panel kycfld" name="passportNumEdit" id="passportNumEdit" value="'+dispData.s_passport_number+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Passport (Front)</td><td class=""><div class="form-panel"><input '+((dispData.s_passport_number.trim() == '')?'':'')+' type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="passportFrontEdit" id="passportFrontEdit"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Passport (Back)</td><td class=""><div class="form-panel"><input '+((dispData.s_passport_number.trim() == '')?'':'')+' type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="passportBackEdit" id="passportBackEdit"></div></td>';
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Other Id No.</td><td class=""><div class="form-panel"><input type="text" placeholder="Other Id Number" class="input-panel kycfld" name="otherNumEdit" id="otherNumEdit" value=""></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Other Id (Front)</td><td class=""><div class="form-panel"><input '+((dispData.s_adhar_number.trim() == '')?'':'')+' type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="otherFrontEdit" id="otherFrontEdit"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Other Id (Back)</td><td class=""><div class="form-panel"><input '+((dispData.s_adhar_number.trim() == '')?'':'')+' type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="otherBackEdit" id="otherBackEdit"></div></td>';
                divElement += '</tr>';

                divElement += '</tbody></table></div></div>';


                if(dispData.nominee.length > 0){

                    divElement += '<div class="row"><div class="col-me-12 table-responsive margin-bottom-sm"><h5 class="primary-color margin-top-es margin-bottom-0">Nominee Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';  
                    
                    
                    var rltnshpDrp = '';

                    for(var i in dispData.nominee[0].relationshipList) {
                        if(i == dispData.nominee[0].relationship_id){
                            var slctdData = ' selected';
                        }else{
                            var slctdData = '';
                        }

                        rltnshpDrp += '<option value="'+i+'"'+slctdData+'>'+dispData.nominee[0].relationshipList[i]+'</option>';
                    }

                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Relationship</td><td class=""><div class="form-panel"><select class="input-panel" name="nomineerltnshpEdit" id="nomineerltnshpEdit">'+rltnshpDrp+'</select></div></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Title</td><td class=""><div class="form-panel"><select class="input-panel" name="nomineeTitleEdit" id="nomineeTitleEdit"><option value="Mr." '+((dispData.nominee[0].s_nominee_salutation == 'Mr.')?'selected':'')+'>Mr.</option><option value="Mrs." '+((dispData.nominee[0].s_nominee_salutation == 'Mrs.')?'selected':'')+'>Mrs.</option><option value="Miss" '+((dispData.nominee[0].s_nominee_salutation == 'Miss')?'selected':'')+'>Miss</option></select></div></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Name</td><td class=""><div class="form-panel"><input type="text" placeholder="Nominee Name" class="input-panel" name="nomineeNameEdit" id="nomineeNameEdit" value="'+dispData.nominee[0].s_name+'"></div></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Nickname</td><td class=""><div class="form-panel"><div class=""><input type="text" placeholder="Nominee Nickname" class="input-panel" name="nomineeNickNameEdit" id="nomineeNickNameEdit" value="'+((dispData.nominee[0].s_nick_name == '' || dispData.nominee[0].s_nick_name == null)?'':dispData.nominee[0].s_nick_name)+'"></div></td>';
                    divElement += '</tr>';

                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Title</td><td class=""><div class="form-panel"><select class="input-panel" name="nomineeFatherTitleEdit" id="nomineeFatherTitleEdit"><option value="Mr." '+((dispData.nominee[0].s_father_husband_salutation == 'Mr.')?'selected':'')+'>Mr.</option><option value="Late" '+((dispData.nominee[0].s_father_husband_salutation == 'Late')?'selected':'')+'>Late</option></select></div></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Father/Husband Name</td><td class=""><div class="form-panel"><input type="text" placeholder="Nominee Father/Husband Name" class="input-panel" name="nomineeFatherNameEdit" id="nomineeFatherNameEdit" value="'+dispData.nominee[0].s_father_husband_name+'"></div></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Mobile Number</td><td class=""><div class="form-panel"><input type="text" placeholder="Nominee Mobile Number" class="input-panel numeric" name="nomineeMobileEdit" id="nomineeMobileEdit" value="'+dispData.nominee[0].s_mobile_number+'"></div></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Gender</td><td class=""><div class="form-panel"><select class="input-panel" name="nomineeGenderEdit" id="nomineeGenderEdit"><option value="Male" '+((dispData.nominee[0].e_gender == 'Male')?'selected':'')+'>Male</option><option value="Female" '+((dispData.nominee[0].e_gender == 'Female')?'selected':'')+'>Female</option><option value="Transgender" '+((dispData.nominee[0].e_gender == 'Transgender')?'selected':'')+'>Transgender</option></select></div></td>';
                    divElement += '</tr>';

                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">DOB</td><td class=""><div class="form-panel"><input readonly type="text" data-role="datepickerAltPop" placeholder="Co-Borrower Name" class="input-panel" name="nomineeDobEdit" id="nomineeDobEdit" value="'+dispData.nominee[0].dob+'"></div></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">Age</td><td class=""><div class="form-panel"><input readonly type="text" placeholder="Co-Borrower Name" class="input-panel numeric" name="nomineeAgeEdit" id="nomineeAgeEdit" value="'+dispData.nominee[0].i_age+'"></div></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td class=""></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td class=""></td>';
                    divElement += '</tr>';

                    divElement += '</tbody></table></div></div>';


                    divElement += '<div class="row"><div class="col-me-12 table-responsive margin-bottom-sm"><h5 class="primary-color margin-top-es margin-bottom-0">Nominee KYC Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';  
                    

                    var kycTypeDrp = '';

                    for(var key in dispData.nominee[0].kycTypeList) {
                         if(key == dispData.nominee[0].kycType){
                             var slctdData = ' selected';
                         }else{
                             var slctdData = '';
                         }

                         kycTypeDrp += '<option value="'+key+'"'+slctdData+'>'+dispData.nominee[0].kycTypeList[key]+'</option>';
                    } 

                    
                    if(dispData.nominee[0].kycType == '4'){
                        var maxLngthStr = 'maxlength="10"';
                    }else if(dispData.nominee[0].kycType == '3' || dispData.nominee[0].kycType == '1'){
                        var maxLngthStr = 'maxlength="25"';
                    }else if(dispData.nominee[0].kycType == '2'){
                        var maxLngthStr = 'maxlength="12"';
                    }else{
                        var maxLngthStr = '';
                    }
                    
                    divElement += '<tr>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">KYC Type</td><td class=""><div class="form-panel"><select class="input-panel" name="nomineeKycTypeEdit" id="nomineeKycTypeEdit">'+kycTypeDrp+'</select></div></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">KYC Number</td><td class=""><div class="form-panel"><input type="text" placeholder="KYC Number" class="input-panel" name="nomineeKycNumEdit" id="nomineeKycNumEdit" value="'+dispData.nominee[0].kycNumber+'" '+maxLngthStr+'></div></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight">KYC Doc (Front)</td><td class=""><div class="form-panel"><input type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="nomineeKycDocFront" id="nomineeKycDocFront"></div></td>';
                    divElement += '<td class="font-bold text-nowrap sort-highlight coBorKyc">KYC Doc (Back)</td><td class="nomKyc"><div class="form-panel"><input '+((dispData.nominee[0].kycType == '4' || dispData.nominee[0].kycType == '5')?'disabled':'')+' type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="nomineeKycDocBack" id="nomineeKycDocBack"></div></td>';
                    divElement += '</tr>';
                    divElement += '<tr>';
                    
                    divElement += '</tbody></table></div></div>';
                }





                divElement += '<div class="row"><div class="col-me-12 table-responsive margin-bottom-sm"><h5 class="primary-color margin-top-es margin-bottom-0">Co-Borrower Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';  
                
                
                var rltnshpDrp = '';

                for(var i in dispData.coborrower[0].relationshipList) {
                    if(i == dispData.coborrower[0].relationship_id){
                        var slctdData = ' selected';
                    }else{
                        var slctdData = '';
                    }

                    rltnshpDrp += '<option value="'+i+'"'+slctdData+'>'+dispData.coborrower[0].relationshipList[i]+'</option>';
                }

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Relationship</td><td class=""><div class="form-panel"><select class="input-panel" name="coBorrowerrltnshpEdit" id="coBorrowerrltnshpEdit">'+rltnshpDrp+'</select></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Title</td><td class=""><div class="form-panel"><select class="input-panel" name="coBorrowerTitleEdit" id="coBorrowerTitleEdit"><option value="Mr." '+((dispData.coborrower[0].s_nominee_salutation == 'Mr.')?'selected':'')+'>Mr.</option><option value="Mrs." '+((dispData.coborrower[0].s_nominee_salutation == 'Mrs.')?'selected':'')+'>Mrs.</option><option value="Miss" '+((dispData.coborrower[0].s_nominee_salutation == 'Miss')?'selected':'')+'>Miss</option></select></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Name</td><td class=""><div class="form-panel"><input type="text" placeholder="Co-Borrower Name" class="input-panel" name="coBorrowerNameEdit" id="coBorrowerNameEdit" value="'+dispData.coborrower[0].s_name+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Nickname</td><td class=""><div class="form-panel"><input type="text" placeholder="Co-Borrower Nickname" class="input-panel" name="coBorrowerNickNameEdit" id="coBorrowerNickNameEdit" value="'+((dispData.coborrower[0].s_nick_name == '' || dispData.coborrower[0].s_nick_name == null)?'':dispData.coborrower[0].s_nick_name)+'"></div></td>';
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Title</td><td class=""><div class="form-panel"><select class="input-panel" name="coBorrowerFatherTitleEdit" id="coBorrowerFatherTitleEdit"><option value="Mr." '+((dispData.coborrower[0].s_father_husband_salutation == 'Mr.')?'selected':'')+'>Mr.</option><option value="Late" '+((dispData.coborrower[0].s_father_husband_salutation == 'Late')?'selected':'')+'>Late</option></select></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Father/Husband Name</td><td class=""><div class="form-panel"><input type="text" placeholder="Co-Borrower Father/Husband Name" class="input-panel" name="coBorrowerFatherNameEdit" id="coBorrowerFatherNameEdit" value="'+dispData.coborrower[0].s_father_husband_name+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Mobile Number</td><td class=""><div class="form-panel"><input type="text" placeholder="Co-Borrower Mobile Number" class="input-panel numeric" name="coBorrowerMobileEdit" id="coBorrowerMobileEdit" value="'+dispData.coborrower[0].s_mobile_number+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Gender</td><td class=""><div class="form-panel"><select class="input-panel" name="coBorrowerGenderEdit" id="coBorrowerGenderEdit"><option value="Male" '+((dispData.coborrower[0].e_gender == 'Male')?'selected':'')+'>Male</option><option value="Female" '+((dispData.coborrower[0].e_gender == 'Female')?'selected':'')+'>Female</option><option value="Transgender" '+((dispData.coborrower[0].e_gender == 'Transgender')?'selected':'')+'>Transgender</option></select></div></td>';
                divElement += '</tr>';

                divElement += '<tr>';
                
                divElement += '<td class="font-bold text-nowrap sort-highlight">DOB</td><td class=""><div class="form-panel"><input readonly type="text" data-role="datepickerAltPop" placeholder="Co-Borrower Name" class="input-panel" name="coBorrowerDobEdit" id="coBorrowerDobEdit" value="'+dispData.coborrower[0].dob+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Age</td><td class=""><div class="form-panel"><input readonly type="text" placeholder="Co-Borrower Name" class="input-panel numeric" name="coBorrowerAgeEdit" id="coBorrowerAgeEdit" value="'+dispData.coborrower[0].i_age+'"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td class=""></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight"></td><td class=""></td>';
                divElement += '</tr>';

                divElement += '</tbody></table></div></div>';


                divElement += '<div class="row"><div class="col-me-12 table-responsive margin-bottom-sm"><h5 class="primary-color margin-top-es margin-bottom-0">Co-Borrower KYC Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';  
                

                var kycTypeDrp = '';

                for(var key in dispData.coborrower[0].kycTypeList) {
                     if(key == dispData.coborrower[0].kycType){
                         var slctdData = ' selected';
                     }else{
                         var slctdData = '';
                     }

                     kycTypeDrp += '<option value="'+key+'"'+slctdData+'>'+dispData.coborrower[0].kycTypeList[key]+'</option>';
                } 

                if(dispData.coborrower[0].kycType == '4'){
                    var maxLngthStr = 'maxlength="10"';
                }else if(dispData.coborrower[0].kycType == '3' || dispData.coborrower[0].kycType == '1'){
                    var maxLngthStr = 'maxlength="25"';
                }else if(dispData.coborrower[0].kycType == '2'){
                    var maxLngthStr = 'maxlength="12"';
                }else{
                    var maxLngthStr = '';
                }
                
                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">KYC Type</td><td class=""><div class="form-panel"><select class="input-panel" name="coBorrowerKycTypeEdit" id="coBorrowerKycTypeEdit">'+kycTypeDrp+'</select></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">KYC Number</td><td class=""><div class="form-panel"><input type="text" placeholder="KYC Number" class="input-panel" name="coBorrowerKycNumEdit" id="coBorrowerKycNumEdit" value="'+dispData.coborrower[0].kycNumber+'" '+maxLngthStr+'></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">KYC Doc (Front)</td><td class=""><div class="form-panel"><input type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="coBorrowerKycDocFront" id="coBorrowerKycDocFront"></div></td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight coBorKyc">KYC Doc (Back)</td><td class="coBorKyc"><div class="form-panel"><input '+((dispData.coborrower[0].kycType == '4' || dispData.coborrower[0].kycType == '5')?'disabled':'')+' type="file" accept="image/jpg, image/jpeg, image/png" class="input-panel" name="coBorrowerKycDocBack" id="coBorrowerKycDocBack"></div></td>';
                divElement += '</tr>';
                divElement += '<tr>';
                
                divElement += '</tbody></table></div></div>';


                divElement += '<div class="row"><div class="col-me-12 table-responsive margin-bottom-sm">';
                divElement += '<div class="form-panel">';
                divElement += '<button type="button" class="button button-info" id="saveOrder"><i class="material-icons">save</i> Save</button>';
                divElement += '<button type="reset" class="button button-gray"><i class="material-icons">not_interested</i> Reset</button>';
                divElement += '</div></div><form>';

                divElement += '<button title="Close" type="button" class="mfp-close">×</button>';

                showPopUp(divElement);
                hideLoader("body");
                $("body").removeClass('only-read-view');


                $('[data-role="datepickerAltPop"]' ).datepicker({
                    showOn: "both",
                    changeMonth: true,
                    changeYear: true,
                    showAnim: "fade",
                    dateFormat: 'dd-mm-yy',
                    maxDate: '-18Y',
                    yearRange: '-60:-18',
                    onSelect: function(date) {
                        var dateAlt = date.split('-')[2]+'-'+date.split('-')[1]+'-'+date.split('-')[0];

                        dob = new Date(dateAlt);
                        var today = new Date();
                        var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                        $(this).parents('td').next().next().find('input').val(age);
                    },
                });


                $("#currentStateEdit").change(function(){
                    changeDistrict(this, "#currentDistrictEdit");
                });

                $("#stateEdit").change(function(){
                    changeDistrict(this, "#districtEdit");
                });

                $('.numeric').on('input', function (event) { 
                    this.value = this.value.replace(/[^0-9]/g, '');
                });

                $('#coBorrowerKycTypeEdit').on('change', function (event) {
                    if(this.value == '4' || this.value == '5'){
                        $(".coBorKyc").find('input').prop('disabled', 'disabled');
                    }else{
                        $(".coBorKyc").find('input').removeAttr('disabled');
                    }

                    if(this.value == '4'){
                        $("#coBorrowerKycNumEdit").prop('maxlength', 10);
                    }else if(this.value == '3' || this.value == '1'){
                        $("#coBorrowerKycNumEdit").prop('maxlength', 25);
                    }else if(this.value == '2'){
                        $("#coBorrowerKycNumEdit").prop('maxlength', 12);
                    }else{
                        $("#coBorrowerKycNumEdit").removeAttr('maxlength');
                    }
                });

                $('#nomineeKycTypeEdit').on('change', function (event) {
                    if(this.value == '4' || this.value == '5'){
                        $(".nomKyc").find('input').prop('disabled', 'disabled');
                    }else{
                        $(".nomKyc").find('input').removeAttr('disabled');
                    }

                    if(this.value == '4'){
                        $("#nomineeKycNumEdit").prop('maxlength', 10);
                    }else if(this.value == '3' || this.value == '1'){
                        $("#nomineeKycNumEdit").prop('maxlength', 25);
                    }else if(this.value == '2'){
                        $("#nomineeKycNumEdit").prop('maxlength', 12);
                    }else{
                        $("#nomineeKycNumEdit").removeAttr('maxlength');
                    }
                });

                $('#coBorrowerrltnshpEdit').on('change', function (event) {
                    if(this.value != '7'){
                        if(this.value == '1' || this.value == '3' || this.value == '5' || this.value == '10' || this.value == '12'){
                            $("#coBorrowerTitleEdit").val('Mr.');
                            $("#coBorrowerGenderEdit").val('Male');
                            $("#coBorrowerGenderEdit").find('option[value="Male"]').show();
                            $("#coBorrowerGenderEdit").find('option[value="Female"]').hide();
                            $("#coBorrowerTitleEdit").find('option').each(function(index){
                                if($(this).val() != 'Mr.'){
                                    $(this).hide();
                                }else{
                                    $(this).show();
                                }
                            });
                        }else{
                            $("#coBorrowerTitleEdit").val('Mrs.');
                            $("#coBorrowerGenderEdit").val('Female');
                            $("#coBorrowerGenderEdit").find('option[value="Female"]').show();
                            $("#coBorrowerGenderEdit").find('option[value="Male"]').hide();
                            $("#coBorrowerTitleEdit").find('option').each(function(index){
                                if($(this).val() != 'Mrs.' && $(this).val() != 'Miss'){
                                    $(this).hide();
                                }else{
                                    $(this).show();
                                }
                            });
                        }
                    }else{
                        $("#coBorrowerGenderEdit").find('option').show();
                        $("#coBorrowerTitleEdit").find('option').show();
                    }
                });

                $('#nomineerltnshpEdit').on('change', function (event) {
                    if(this.value != '7'){
                        if(this.value == '1' || this.value == '3' || this.value == '5' || this.value == '10' || this.value == '12'){
                            $("#nomineeTitleEdit").val('Mr.');
                            $("#nomineeGenderEdit").val('Male');
                            $("#nomineeGenderEdit").find('option[value="Male"]').show();
                            $("#nomineeGenderEdit").find('option[value="Female"]').hide();
                            $("#nomineeTitleEdit").find('option').each(function(index){
                                if($(this).val() != 'Mr.'){
                                    $(this).hide();
                                }else{
                                    $(this).show();
                                }
                            });
                        }else{
                            $("#nomineeTitleEdit").val('Mrs.');
                            $("#nomineeGenderEdit").val('Female');
                            $("#nomineeGenderEdit").find('option[value="Female"]').show();
                            $("#nomineeGenderEdit").find('option[value="Male"]').hide();
                            $("#nomineeTitleEdit").find('option').each(function(index){
                                if($(this).val() != 'Mrs.' && $(this).val() != 'Miss'){
                                    $(this).hide();
                                }else{
                                    $(this).show();
                                }
                            });
                        }
                    }else{
                        $("#nomineeGenderEdit").find('option').show();
                        $("#nomineeTitleEdit").find('option').show();
                    }
                });

                $(".kycfld").on('input', function(){
                    $(this).val (function () {
                        return this.value.toUpperCase();
                    });
                });


                function saveOrderFornAndCheck(e, nomLength){
                    var b_valid=true;
                    var s_err='';
                    
                    $("#div_err").hide("slow");

                    if($("#currentAddrEdit").val()==''){
                        errorMarkAlt("#currentAddrEdit", 'Address Line is required!');
                        b_valid = false;
                    }else if($("#currentCityEdit").val()==''){
                        errorMarkAlt("#currentCityEdit", 'City is required!');
                        b_valid = false;
                    }else if($("#currentDistrictEdit").val()==''){
                        errorMarkAlt("#currentDistrictEdit", 'District is required!');
                        b_valid = false;
                    }else if($("#currentPincodeEdit").val()==''){
                        errorMarkAlt("#currentPincodeEdit", 'Pincode is required!');
                        b_valid = false;
                    }else if($("#currentTalukaEdit").val()==''){
                        errorMarkAlt("#currentTalukaEdit", 'Taluka is required!');
                        b_valid = false;
                    }else if($("#currentPoliceStationEdit").val()==''){
                        errorMarkAlt("#currentPoliceStationEdit", 'Police Station is required!');
                        b_valid = false;
                    }else if($("#currentPostOfficeEdit").val()==''){
                        errorMarkAlt("#currentPostOfficeEdit", 'Post Office is required!');
                        b_valid = false;
                    }else if($("#currentLandmarkEdit").val()==''){
                        errorMarkAlt("#currentLandmarkEdit", 'Landmark is required!');
                        b_valid = false;
                    }else if($("#addrEdit").val()==''){
                        errorMarkAlt("#addrEdit", 'Address Line is required!');
                        b_valid = false;
                    }else if($("#cityEdit").val()==''){
                        errorMarkAlt("#cityEdit", 'City is required!');
                        b_valid = false;
                    }else if($("#districtEdit").val()==''){
                        errorMarkAlt("#districtEdit", 'District is required!');
                        b_valid = false;
                    }else if($("#pincodeEdit").val()==''){
                        errorMarkAlt("#pincodeEdit", 'Pincode is required!');
                        b_valid = false;
                    }else if($("#talukaEdit").val()==''){
                        errorMarkAlt("#talukaEdit", 'Taluka is required!');
                        b_valid = false;
                    }else if($("#policeStationEdit").val()==''){
                        errorMarkAlt("#policeStationEdit", 'Police Station is required!');
                        b_valid = false;
                    }else if($("#postOfficeEdit").val()==''){
                        errorMarkAlt("#postOfficeEdit", 'Post Office is required!');
                        b_valid = false;
                    }else if($("#landmarkEdit").val()==''){
                        errorMarkAlt("#landmarkEdit", 'Landmark is required!');
                        b_valid = false;
                    }else if($("#nomineeNameEdit").val() == ''){
                        errorMarkAlt("#nomineeNameEdit", 'Nominee Name is required!');
                        b_valid = false;
                    }else if($("#nomineeFatherNameEdit").val() == ''){
                        errorMarkAlt("#nomineeFatherNameEdit", 'Nominee Father/Husband Name is required!');
                        b_valid = false;
                    }else if($("#nomineeMobileEdit").val() == ''){
                        errorMarkAlt("#nomineeMobileEdit", 'Nominee Mobile Number is required!');
                        b_valid = false;
                    }else if($("#nomineeDobEdit").val() == ''){
                        errorMarkAlt("#nomineeDobEdit", 'Nominee DOB is required!');
                        b_valid = false;
                    }else if($("#nomineeAgeEdit").val() == ''){
                        errorMarkAlt("#nomineeAgeEdit", 'Nominee Age is required!');
                        b_valid = false;
                    }else if($("#coBorrowerNameEdit").val() == ''){
                        errorMarkAlt("#coBorrowerNameEdit", 'Co-Borrower Name is required!');
                        b_valid = false;
                    }else if($("#coBorrowerFatherNameEdit").val() == ''){
                        errorMarkAlt("#coBorrowerFatherNameEdit", 'Co-Borrower Father/Husband Name is required!');
                        b_valid = false;
                    }else if($("#coBorrowerMobileEdit").val() == ''){
                        errorMarkAlt("#coBorrowerMobileEdit", 'Co-Borrower Mobile Number is required!');
                        b_valid = false;
                    }else if($("#coBorrowerDobEdit").val() == ''){
                        errorMarkAlt("#coBorrowerDobEdit", 'Co-Borrower DOB is required!');
                        b_valid = false;
                    }else if($("#coBorrowerAgeEdit").val() == ''){
                        errorMarkAlt("#coBorrowerAgeEdit", 'Co-Borrower Age is required!');
                        b_valid = false;
                    }else if($("#currentPincodeEdit").val() != ''){
                        if($("#currentPincodeEdit").val().length != 6){
                            errorMarkAlt("#currentPincodeEdit", 'Pincode must be 6 digit long!');
                            b_valid = false;
                        }
                    }else if($("#pincodeEdit").val() != ''){
                        if($("#pincodeEdit").val().length != 6){
                            errorMarkAlt("#pincodeEdit", 'Pincode must be 6 digit long!');
                            b_valid = false;
                        }
                    }

                    if(b_valid){
                        if($("#currentAddrEdit").val().trim().length < 10){
                            errorMarkAlt("#currentAddrEdit", 'Address Line should have minimum 10 characters!');
                            b_valid = false;
                        }else if($("#addrEdit").val().trim().length < 10){
                            errorMarkAlt("#addrEdit", 'Address Line should have minimum 10 characters!');
                            b_valid = false;
                        }
                    }

                    if(b_valid){
                        var fldBlnk = '';
                        $(".kycfld").each(function(){
                            if(this.value.trim() != ''){
                                tempKYCArr.push(this.value);
                            }
                        });

                        $(".kycfld").each(function(){
                            if(this.value.trim() == ''){
                                fldBlnk = $(this).prop('id');
                                return false;
                            }
                        });

                        
                        if(tempKYCArr.length < 2){
                            errorMarkAlt("#"+fldBlnk, 'Two types of KYC required!');
                            b_valid = false;
                        }
                    }

                    if(b_valid){
                        if($("#aadharNumEdit").val().trim() != ''){
                            if(!$("#aadharNumEdit").val().match(/^\d+$/)){
                                errorMarkAlt("#aadharNumEdit", 'Aadhar Number must be Numeric!');
                                b_valid = false;
                            }else if($("#aadharNumEdit").val().length != 12){
                                errorMarkAlt("#aadharNumEdit", 'Aadhar Number must be 12 digits long!');
                                b_valid = false;
                            }
                        }
                    }

                    if(b_valid){
                        if($("#voterNumEdit").val().trim() != ''){
                            if($("#voterNumEdit").val().length < 10 || $("#voterNumEdit").val().length > 25){
                                errorMarkAlt("#voterNumEdit", 'Voter Number must be between 10 and 25 characters long!');
                                b_valid = false;
                            }
                        }
                    }

                    if(b_valid){
                        if($("#rationNumEdit").val().trim() != ''){
                            if($("#rationNumEdit").val().length < 5 || $("#voterNumEdit").val().length > 25){
                                errorMarkAlt("#rationNumEdit", 'Ration Number must be between 10 and 25 characters long!');
                                b_valid = false;
                            }
                        }
                    }

                    if(b_valid){
                        if($("#panNumEdit").val().trim() != ''){
                            if($("#panNumEdit").val().length != 10){
                                errorMarkAlt("#panNumEdit", 'Pan Number must be 10 characters long!');
                                b_valid = false;
                            }else{
                                var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 
                                if(!$("#panNumEdit").val().match(regExp)){ 
                                    errorMarkAlt("#panNumEdit", 'Not a valid PAN Number!');
                                    b_valid = false;
                                } 
                            }
                        }
                    }

                    if(nomLength > 0){
                        if(b_valid){
                            if($("#nomineeKycTypeEdit").val() == '2'){
                                if(!$("#nomineeKycNumEdit").val().match(/^\d+$/)){
                                    errorMarkAlt("#nomineeKycNumEdit", 'Aadhar Number must be Numeric!');
                                    b_valid = false;
                                }else if($("#nomineeKycNumEdit").val().length != 12){
                                    errorMarkAlt("#nomineeKycNumEdit", 'Aadhar Number must be 12 digits long!');
                                    b_valid = false;
                                }
                            }else if($("#nomineeKycTypeEdit").val() == '1'){
                                if($("#nomineeKycNumEdit").val().length < 10 || $("#nomineeKycNumEdit").val().length > 25){
                                    errorMarkAlt("#nomineeKycNumEdit", 'Voter Number must be between 10 and 25 characters long!');
                                    b_valid = false;
                                }
                            }else if($("#nomineeKycTypeEdit").val() == '3'){
                                if($("#nomineeKycNumEdit").val().length < 5 || $("#nomineeKycNumEdit").val().length > 25){
                                    errorMarkAlt("#nomineeKycNumEdit", 'Ration Number must be between 10 and 25 characters long!');
                                    b_valid = false;
                                }
                            }else if($("#nomineeKycTypeEdit").val() == '4'){
                                if($("#nomineeKycNumEdit").val().length != 10){
                                    errorMarkAlt("#nomineeKycNumEdit", 'Pan Number must be 10 characters long!');
                                    b_valid = false;
                                }else{
                                    var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 
                                    if(!$("#nomineeKycNumEdit").val().match(regExp)){ 
                                        errorMarkAlt("#nomineeKycNumEdit", 'Not a valid PAN Number!');
                                        b_valid = false;
                                    } 
                                }
                            }else{
                                if($("#nomineeKycNumEdit").val().trim() == ''){
                                    errorMarkAlt("#nomineeKycNumEdit", 'KYC number is Required!');
                                    b_valid = false;
                                }
                            }
                        }
                    }

                    if(b_valid){
                        if($("#coBorrowerKycTypeEdit").val() == '2'){
                            if(!$("#coBorrowerKycNumEdit").val().match(/^\d+$/)){
                                errorMarkAlt("#coBorrowerKycNumEdit", 'Aadhar Number must be Numeric!');
                                b_valid = false;
                            }else if($("#coBorrowerKycNumEdit").val().length != 12){
                                errorMarkAlt("#coBorrowerKycNumEdit", 'Aadhar Number must be 12 digits long!');
                                b_valid = false;
                            }
                        }else if($("#coBorrowerKycTypeEdit").val() == '1'){
                            if($("#coBorrowerKycNumEdit").val().length < 10 || $("#coBorrowerKycNumEdit").val().length > 25){
                                errorMarkAlt("#coBorrowerKycNumEdit", 'Voter Number must be between 10 and 25 characters long!');
                                b_valid = false;
                            }
                        }else if($("#coBorrowerKycTypeEdit").val() == '3'){
                            if($("#coBorrowerKycNumEdit").val().length < 5 || $("#coBorrowerKycNumEdit").val().length > 25){
                                errorMarkAlt("#coBorrowerKycNumEdit", 'Ration Number must be between 10 and 25 characters long!');
                                b_valid = false;
                            }
                        }else if($("#coBorrowerKycTypeEdit").val() == '4'){
                            if($("#coBorrowerKycNumEdit").val().length != 10){
                                errorMarkAlt("#coBorrowerKycNumEdit", 'Pan Number must be 10 characters long!');
                                b_valid = false;
                            }else{
                                var regExp = /[a-zA-z]{5}\d{4}[a-zA-Z]{1}/; 
                                if(!$("#coBorrowerKycNumEdit").val().match(regExp)){ 
                                    errorMarkAlt("#coBorrowerKycNumEdit", 'Not a valid PAN Number!');
                                    b_valid = false;
                                } 
                            }
                        }else{
                            if($("#coBorrowerKycNumEdit").val().trim() == ''){
                                errorMarkAlt("#nomineeKycNumEdit", 'KYC number is Required!');
                                b_valid = false;
                            }
                        }
                    }

                    //b_valid = false;
                             
                    if(!b_valid){        
                        $("#div_err").html('<div id="err_msg" class="error_massage">'+s_err+'</div>').show("slow");
                    }else{

                        showLoader("body", "position:fixed; top:45%; left: 47%; z-index: 9999;");
                        $(".order-details-center").addClass('only-read-view');
                        
                        $('#saveOrderForm').ajaxSubmit({
                            beforeSubmit: function() {},
                            uploadProgress: function (event, position, total, percentComplete){},
                            success:function (response){
                                        response = $.parseJSON(response);
                                        var urlToHit = base_url+window.location.href.replace(base_url,'');
                                        var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3><p class="margin-bottom-0">'+response.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button button-primary popup-modal-dismiss" onclick="sortData(\''+urlToHit+'\')">Ok</button></div></div>';
                                        showPopUp(divElement);
                                        hideLoader("body");
                                        $(".order-details-center").removeClass('only-read-view');
                            },
                            error: function(response) {},
                            resetForm: true
                        });
                        return false;
                    }

                    return b_valid;
                }


                $('#saveOrder').find('input').keypress(function (e) {
                    var key = e.which;
                    if(key == 13){
                        saveOrderFornAndCheck(event, dispData.nominee.length);
                    }
                });
                 
                $('#saveOrder').on('click', function (event) {
                    saveOrderFornAndCheck(event, dispData.nominee.length);
                });
            },
            complete: function(xhr, textStatus) {
                checkIfLogout(xhr);
            }
        });
    });

    function errorMarkAlt(selectr, msg){
        $(selectr).focus();
        $(selectr).parents('.form-panel').addClass("error");
        
        $(selectr).parents('tbody').next("#spanCls").remove();
        $(selectr).parents('.table-border').append('<span id="spanCls" class="error-message" style="display:block; text-align:left;"><b>'+msg+'</b></span>');
        
        $(selectr).on('click keyup change', function() {
            $(selectr).parents('tbody').next("#spanCls").remove();
            $(selectr).parents('.form-panel').removeClass("error");
        });
    }


    function changeDistrict(thisElem, changeElem){
        showLoader("body", "position:fixed; top:45%; left: 47%; z-index: 999999999;");
        // $(".order-details-center").addClass('only-read-view');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
            url: base_url+"api/districtList",
            type:"POST",
            data: {
                state_id: $(thisElem).val()
            },
            dataType: "json",
            success:function(data){
                var data = data.data;
                var optnStr = '<option value=""> -- Select District-- </option>';

                for (var i in data) {
                    optnStr += '<option value="'+data[i].district_id+'">'+data[i].district_name+'</option>';
                }
                $(changeElem).html(optnStr);
                hideLoader("body");
                $(".order-details-center").removeClass('only-read-view');
            },
            complete: function(xhr, textStatus) {
                checkIfLogout(xhr);
            }
        });
    }


    $(".viewOrderNominees").click(function(){
        showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
        $("body").addClass('only-read-view');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
            url: base_url+"orderNomineeDetail",
            type:"POST",
            data: {
                orderId: $(this).attr('data-ordrid')
            },
            dataType: "json",
            success:function(data){
                var dispData = data.dataDetail[0];
                
                var divElement = '<div class="order-details-center"><div class="popup-container popup-container-la">';
                divElement += '<h5 class="float-left primary-color margin-bottom-0">Document No.:'+dispData.s_document_number+'<br><small>Customer: '+dispData.customerDetail.s_salutation+' '+dispData.customer+'</small></h5><h3 class="position-center align-center primary-color margin-bottom-0"><u>Nominee Details</u></h3>';
                divElement += '<div class="row"><div class="col-me-12"><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                
                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Nominee Name</td><td class="text-nowrap">'+dispData.s_nominee_salutation+' '+dispData.s_name+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Nickname</td><td class="text-nowrap">'+((dispData.s_nick_name == '' || dispData.s_nick_name == null)?'-':dispData.s_nick_name)+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Father/Husband Name</td><td class="text-nowrap">'+((dispData.s_father_husband_name == '' || dispData.s_father_husband_name == null)?'-':dispData.s_nominee_salutation+' '+dispData.s_father_husband_name)+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Mobile Number</td><td class="text-nowrap">'+((dispData.s_mobile_number == '' || dispData.s_mobile_number == null)?'-':dispData.s_mobile_number)+'</td>';

                
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Relationship with Customer</td><td class="text-nowrap">'+dispData.relationship+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">DOB</td><td class="text-nowrap">'+dispData.dob+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Age</td><td class="text-nowrap">'+dispData.i_age+' years</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Gender</td><td class="text-nowrap">'+dispData.e_gender+'</td>';
                divElement += '</tr>';

                divElement += '</tbody></table></div></div>';

                divElement += '<div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-0">Nominee KYC Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                
                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Document Type</td><td class="text-nowrap">'+dispData.kycType+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Document Number</td><td class="text-nowrap">'+dispData.kycNumber+'</td>';

                if (dispData.orderType == '2') {
                    divElement += '<td class="font-bold text-nowrap sort-highlight">View/Download Document (Front)</td><td class="text-nowrap">'+((dispData.s_kyc_image != '' && dispData.s_kyc_image != null)?'<a download="'+dispData.s_kyc_image.substring(dispData.s_kyc_image.lastIndexOf('/') + 1)+'" href="'+dispData.kycImage+'" target="_blank">Click Here</a>':'-')+'</td>';
                    divElement += ((dispData.kycImageBack != '-')?'<td class="font-bold text-nowrap sort-highlight">View/Download Document (Back)</td><td class="text-nowrap">'+((dispData.kycImageBack == '-')?'-':'<a download="'+dispData.kycImageBack.substring(dispData.kycImageBack.lastIndexOf('/') + 1)+'" href="'+dispData.kycImageBack+'" target="_blank">Click Here</a>')+'</td>':'');
                }
                
                divElement += '</tr>';

                divElement += '</tbody></table></div></div>';

                divElement += '<button title="Close" type="button" class="mfp-close">×</button>';

                showPopUp(divElement);
                hideLoader("body");
                $("body").removeClass('only-read-view');
            },
            complete: function(xhr, textStatus) {
                checkIfLogout(xhr);
            }
        });
    });


    $(".viewOrderCoBorrower").click(function(){
        showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
        $("body").addClass('only-read-view');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
            url: base_url+"orderCoBorrowerDetail",
            type:"POST",
            data: {
                orderId: $(this).attr('data-ordrid')
            },
            dataType: "json",
            success:function(data){
                var dispData = data.dataDetail[0];
                
                var divElement = '<div class="order-details-center"><div class="popup-container popup-container-la">';
                divElement += '<h5 class="float-left primary-color margin-bottom-0">Document No.:'+dispData.s_document_number+'<br><small>Customer: '+dispData.customerDetail.s_salutation+' '+dispData.customer+'</small></h5><h3 class="position-center align-center primary-color margin-bottom-0"><u>Co-Borrower Details</u></h3>';
                
                divElement += '<div class="row">';
                divElement += '<div class="col-me-12"><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                
                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Co-Borrower Name</td><td class="text-nowrap">'+dispData.s_nominee_salutation+' '+dispData.s_name+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Nickname</td><td class="text-nowrap">'+((dispData.s_nick_name == '' || dispData.s_nick_name == null)?'-':dispData.s_nick_name)+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Father/Husband Name</td><td class="text-nowrap">'+((dispData.s_father_husband_name == '' || dispData.s_father_husband_name == null)?'-':dispData.s_nominee_salutation+' '+dispData.s_father_husband_name)+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Mobile Number</td><td class="text-nowrap">'+((dispData.s_mobile_number == '' || dispData.s_mobile_number == null)?'-':dispData.s_mobile_number)+'</td>';

                
                divElement += '</tr>';

                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Relationship with Customer</td><td class="text-nowrap">'+dispData.relationship+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">DOB</td><td class="text-nowrap">'+dispData.dob+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Age</td><td class="text-nowrap">'+dispData.i_age+' years</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Gender</td><td class="text-nowrap">'+dispData.e_gender+'</td>';
                divElement += '</tr>';

                divElement += '</tbody></table></div></div>';

                divElement += '<div class="row"><div class="col-me-12"><h5 class="primary-color margin-top-es margin-bottom-0">C0-Borrower KYC Details</h5><table class="table-border table-head-color margin-bottom-es td-padding-5"><tbody>';
                
                divElement += '<tr>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Document Type</td><td class="text-nowrap">'+dispData.kycType+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">Document Number</td><td class="text-nowrap">'+dispData.kycNumber+'</td>';
                divElement += '<td class="font-bold text-nowrap sort-highlight">View/Download Document (Front)</td><td class="text-nowrap">'+((dispData.s_kyc_image != '' && dispData.s_kyc_image != null)?'<a href="'+dispData.kycImage+'" target="_blank">Click Here</a>':'-')+'</td>';
                divElement += ((dispData.kycImageBack != '-')?'<td class="font-bold text-nowrap sort-highlight">View/Download Document (Back)</td><td class="text-nowrap">'+((dispData.kycImageBack == '-')?'-':'<a href="'+dispData.kycImageBack+'" target="_blank">Click Here</a>')+'</td>':'');
                divElement += '</tr>';

                divElement += '</tbody></table></div></div>';

                divElement += '<div class="row"><div class="col-me-3"><h5 class="primary-color margin-top-es margin-bottom-es">Co-Borrower Photo</h5>';  
                divElement += '<div><img style="width: 14.5rem; border: 1px solid; height: 18.8rem;" src="'+dispData.ProfImage+'"></div>';
                divElement += '</div></div>';

                divElement += '<button title="Close" type="button" class="mfp-close">×</button>';

                showPopUp(divElement);
                hideLoader("body");
                $("body").removeClass('only-read-view');
            },
            complete: function(xhr, textStatus) {
                checkIfLogout(xhr);
            }
        });
    });


    $(".featuredCls").click(function(){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
            url: base_url+"featuredImage",
            type:"POST",
            data: {
                id: $(this).attr('data-image-id'),
                prodId: $(this).attr('data-image-prodId')
            },
            dataType: "json",
            success:function(data){
                $("#featured_"+data.id).attr('checked', true);
            },
            complete: function(xhr, textStatus) {
                checkIfLogout(xhr);
            }
        });
        return false;
    });

    $(".sendToHub").click(function(e) {
        var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm</h3><p class="margin-bottom-0">Are you sure you want to send this order details to HUB?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="confrmNo">No</button><button type="button" class="button popup-modal-dismiss" id="confrmYes">Yes</button></div></div>';
        showPopUp(divElement);

        var thisObj = this;

        $("#confrmYes").click(function(e) {
            sendToHub(thisObj);
        });
    });
});

$(".selectClass").change(function(e) {
    var adtnlTxt = '';
    if($('#paymentType_'+$(this).attr('data-id')).val() == '2' && $(this).find('option:selected').text() == 'Delivered'){
        adtnlTxt = ' By changing the status to "Delivered", the Order will be sent to HUB for integration.';
    }

    if($(this).val() == 'Cancelled' && $("#fgiOrderIdWhole_"+$(this).attr('data-id')).val() == '1'){
        adtnlTxt = 'Cancelling Customer\'s insurance will automatically cancel Nominee Order.';
    }else{
        adtnlTxt = '';
    }
    
    var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm</h3><p class="margin-bottom-0">Are you sure you want to change the status to "'+$(this).find('option:selected').text()+'"?<br>'+adtnlTxt+'</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="confrmNo">No</button><button type="button" class="button popup-modal-dismiss" id="confrmYes">Yes</button></div></div>';
    showPopUp(divElement);
    

    var thisObj = this;
    $("#confrmNo").click(function(e) {
        $(thisObj).val($("#selectIdHdn_"+$(thisObj).attr('data-id')).val());
    });
    

    $("#confrmYes").click(function(e) {
        if (($(thisObj).val() == 'Cancelled' && $("#selectIdHdn_"+$(thisObj).attr('data-id')).val() == 'New') || $(thisObj).val() == 'Request to cancel') {
            var bhSlctd = '';
            var hoSlctd = '';
            if($("#userTypHdn").val() == 'checker' || $("#userTypHdn").val() == 'am'){
                bhSlctd = ' selected';
            }else if($("#userTypHdn").val() == 'admin'){
                hoSlctd = ' selected';
            }
            var cancelReasonHtml = '<div class="row"><div class="col-la-12"><div class="form-panel"><label>Cancelled By</label><select class="input-panel" name="reasonType" id="reasonType">'+((bhSlctd != '')?'':'<option value="1" '+hoSlctd+'>Head Office</option>')+((hoSlctd != '')?'':'<option value="2" '+bhSlctd+'>Customer/BH/BQH</option>')+'</select></div></div><div class="col-la-12"><div class="form-panel"><label>Reason</label>'+$("#canclReasonSelect").html()+'</div></div></div>';
            var divElementCncl = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3>Cancel Reason</h3>'+cancelReasonHtml+'</div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="cnfrmCnclCncl">Cancel</button><button type="button" class="button" id="cnfrmSaveCncl">Save</button></div></div>';
            showPopUp(divElementCncl);

            $("#cnfrmCnclCncl").click(function(e) {
                $(thisObj).val($("#selectIdHdn_"+$(thisObj).attr('data-id')).val());
            });

            $("#cnfrmSaveCncl").click(function(e) {
                changeOrderStatus(thisObj, '', $("#selectIdHdn_"+$(thisObj).attr('data-id')).val(), '2');
            });
            
            return false;
        }

        changeOrderStatus(thisObj, '', $("#selectIdHdn_"+$(thisObj).attr('data-id')).val());
    });
});

$(".selectClassOrdrWise").change(function(e) {

    var adtnlTxt = '';
    if($('#paymentType_'+$(this).attr('data-id')).val() == '2' && $(this).find('option:selected').text() == 'Delivered'){
        adtnlTxt = ' By changing the status to "Delivered", the Order will be sent to HUB for integration.';
    }

    if($(this).val() == 'Cancelled' && $("#fgiOrderId_"+$(this).attr('data-id')).val() == '1'){
        adtnlTxt = '<br>Cancelling Customer\'s insurance will automatically cancel Nominee Order.';
    }else{
        adtnlTxt = '';
    }

    var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm</h3><p class="margin-bottom-0">Are you sure you want to change the status to "'+$(this).find('option:selected').text()+'"?<br>'+adtnlTxt+'</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="confrmNo">No</button><button type="button" class="button popup-modal-dismiss" id="confrmYes">Yes</button></div></div>';
    showPopUp(divElement);
    

    var thisObj = this;
    $("#confrmNo").click(function(e) {
        $(thisObj).val($("#selectIdHdn_"+$(thisObj).attr('data-id')).val());
    });
    

    $("#confrmYes").click(function(e) {
        if (($(thisObj).val() == 'Cancelled' && $("#selectIdHdn_"+$(thisObj).attr('data-id')).val() == 'New') || $(thisObj).val() == 'Request to cancel') {
            var bhSlctd = '';
            var hoSlctd = '';
            if($("#userTypHdn").val() == 'checker' || $("#userTypHdn").val() == 'am'){
                bhSlctd = ' selected';
            }else if($("#userTypHdn").val() == 'admin'){
                hoSlctd = ' selected';
            }
            var cancelReasonHtml = '<div class="row"><div class="col-la-12"><div class="form-panel"><label>Cancelled By</label><select class="input-panel" name="reasonType" id="reasonType">'+((bhSlctd != '')?'':'<option value="1" '+hoSlctd+'>Head Office</option>')+((hoSlctd != '')?'':'<option value="2" '+bhSlctd+'>Customer/BH/BQH</option>')+'</select></div></div><div class="col-la-12"><div class="form-panel"><label>Reason</label>'+$("#canclReasonSelect").html()+'</div></div></div>';
            var divElementCncl = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3>Cancel Reason</h3>'+cancelReasonHtml+'</div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="cnfrmCnclCncl">Cancel</button><button type="button" class="button" id="cnfrmSaveCncl">Save</button></div></div>';
            showPopUp(divElementCncl);

            $("#cnfrmCnclCncl").click(function(e) {
                $(thisObj).val($("#selectIdHdn_"+$(thisObj).attr('data-id')).val());
            });

            $("#cnfrmSaveCncl").click(function(e) {
                changeOrderStatus(thisObj, '1', $("#selectIdHdn_"+$(thisObj).attr('data-id')).val(), '2');
            });
            
            return false;
        }
        changeOrderStatus(thisObj, '1', $("#selectIdHdn_"+$(thisObj).attr('data-id')).val());
    });
});

$(".cnclOrdrWise").click(function(e) {
    if($("#fgiOrderId_"+$(this).attr('data-id')).val() == '1'){
        var addtnlPopMsg = '<br>Cancelling Customer\'s insurance will automatically cancel Nominee Order.';
    }else{
        var addtnlPopMsg = '';
    }
    
    var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm</h3><p class="margin-bottom-0">Are you sure you want to change the status to "'+$(this).attr('value')+'"?'+addtnlPopMsg+'</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="confrmNo">No</button><button type="button" class="button popup-modal-dismiss" id="confrmYes">Yes</button></div></div>';
    showPopUp(divElement);
    

    var thisObj = '<select class="selectClass input-panel border-primary bg-primary " id="select-box" data-id="'+$(this).attr('data-id')+'" data-doc="'+$(this).attr('data-doc')+'"><option value="'+$(this).attr('value')+'" selected>'+$(this).attr('value')+'</option></select>';
    
    $("#confrmYes").click(function(e) {
        
        if ((($(thisObj).val() == 'Cancelled' || $(thisObj).val() == 'Cancel') && $("#selectIdHdn_"+$(thisObj).attr('data-id')).val() == 'New') || $(thisObj).val() == 'Request to cancel') {
            // if($("#paymentType_"+$(thisObj).attr('data-id')).val() == '2' && $("#totalActvOrdr_"+$(thisObj).attr('data-id')).val() > 1){
            //     var cancelReasonHtmlHd = '<div class="row"><div class="col-la-12"><div class="form-panel"><label>Info</label>';
            //     var cancelReasonHtmlSlct = '<select class="input-panel" name="cancelAdjust" id="cancelAdjust"><option value="1">Do you want to adjust Loan Amt.?</option><option value="2">Do you want to refund to the Customer?</option></select>';
            //     var cancelReasonHtmlft = '</div></div></div>';

            //     var cancelReasonHtml = cancelReasonHtmlHd+cancelReasonHtmlSlct+cancelReasonHtmlft;

            //     var divElementCncl = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3>Cancel Reason</h3>'+cancelReasonHtml+'</div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss">Close</button><button type="button" class="button" id="cnfrmSaveCnclAdjust">Next</button></div></div>';
            //     showPopUp(divElementCncl);

            //     $("#cnfrmSaveCnclAdjust").click(function(e) {
            //         if($("#cancelAdjust").val() == '1'){
            //             changeOrderStatus(thisObj, '1', $("#selectIdHdn_"+$(thisObj).attr('data-id')).val(), $("#cancelAdjust").val());
            //             return false;
            //         }else{
            //             var cancelReasonHtml = '<div class="row"><div class="col-la-12"><div class="form-panel"><label>Reason Type</label><select class="input-panel" name="reasonType" id="reasonType"><option value="1">Cancelled By Head Office</option><option value="2">Cancelled By Customer/BH/BQH</option></select></div></div><div class="col-la-12"><div class="form-panel"><label>Reason</label><input type="text" class="input-panel" name="reasonText" id="reasonText"></div></div></div>';
            //             var divElementCncl = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3>Cancel Reason</h3>'+cancelReasonHtml+'</div><div class="alert-button alert-success"><button type="button" class="button" id="cnfrmSaveCncl">Save</button></div></div>';
            //             showPopUp(divElementCncl);

            //             $("#cnfrmSaveCncl").click(function(e) {
            //                 changeOrderStatus(thisObj, '1', $("#selectIdHdn_"+$(thisObj).attr('data-id')).val(), $("#cancelAdjust").val());
            //             });
                        
            //             return false;
            //         }
            //     });
            //     return false;
            // }else{

                var bhSlctd = '';
                var hoSlctd = '';
                if($("#userTypHdn").val() == 'checker' || $("#userTypHdn").val() == 'am'){
                    bhSlctd = ' selected';
                }else if($("#userTypHdn").val() == 'admin'){
                    hoSlctd = ' selected';
                }

                var cancelReasonHtml = '<div class="row"><div class="col-la-12"><div class="form-panel"><label>Cancelled By</label><select class="input-panel" name="reasonType" id="reasonType">'+((bhSlctd != '')?'':'<option value="1" '+hoSlctd+'>Head Office</option>')+((hoSlctd != '')?'':'<option value="2" '+bhSlctd+'>Customer/BH/BQH</option>')+'</select></div></div><div class="col-la-12"><div class="form-panel"><label>Reason</label>'+$("#canclReasonSelect").html()+'</div></div></div>';
                var divElementCncl = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3>Cancel Reason</h3>'+cancelReasonHtml+'</div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="cnfrmCnclCncl">Cancel</button><button type="button" class="button" id="cnfrmSaveCncl">Save</button></div></div>';
                showPopUp(divElementCncl);

                $("#cnfrmSaveCncl").click(function(e) {
                    changeOrderStatus(thisObj, '1', $("#selectIdHdn_"+$(thisObj).attr('data-id')).val(), '2');
                });
                
                return false;
            // }
        }
        changeOrderStatus(thisObj, '1', $("#selectIdHdn_"+$(thisObj).attr('data-id')).val());
    });
});

$("#allVendorPrice, #allCustomerPrice").on('input', function(e) {
    var thisVal = this.value;
    var vendPrice = 0;
    var custPrice = 0;
    if (this.id == 'allVendorPrice'){
        vendPrice = thisVal;
        $('[name="vendorPriceRegnWise[]"]').val(vendPrice);
    }else if(this.id == 'allCustomerPrice'){
        custPrice = thisVal;
        $('[name="customerPriceRegnWise[]"]').val(custPrice);
    }

    if($("#allVendorPrice").val().trim() != '' && $("#allCustomerPrice").val().trim() != ''){
        if ((parseFloat($("#allVendorPrice").val())-parseFloat($("#allCustomerPrice").val())) >= 0) {
            $("#allMargin").val((parseFloat($("#allVendorPrice").val())-parseFloat($("#allCustomerPrice").val())));
        }else{
            $("#allMargin").val('');
        }
    }else{
        $("#allMargin").val('');
    }
    
    
    $('[name="vendorPriceRegnWise[]"], [name="customerPriceRegnWise[]"]').each(function(){
        marginCalculationRegnWise(this);
    });
});

$("#allDeliveryCharges").on('input', function(e) {
    var thisVal = this.value;
    $('[name="deliveryChargesRegnWise[]"]').val(thisVal);
});

$("#allDiscountType").on('input', function(e) {
    var thisVal = this.value;
    $('[name="discountRegnWise[]"]').val(thisVal);
});

$(".allmainClsTr li a").on('click', function(){
    var selText = $(this).text();
    $(this).parents('.form-panel').find('.dropdown-toggle').html(selText);
    $(this).parents('.form-panel').find('.dropdown-menu').hide();

    $(".mainClsTr li a").parents('.form-panel').find('.dropdown-toggle').html(selText);
    $(".mainClsTr li a").parents('.form-panel').find('.dropdown-menu').hide();
    $("[name='discountTypeRegnWise[]']").val($(this).attr('value'));
    $(".dropdown").removeClass('open');
});

$("#allInsuranceAmt").on('input', function(e) {
    var thisVal = this.value;
    $('[name="insuranceAmtRegnWise[]"]').val(thisVal);
});

$("#allInterestRate").on('input', function(e) {
    var thisVal = this.value;
    $('[name="interstRateRegnWise[]"]').val(thisVal);
});

$("#allInsuranceComp").on('change', function(e) {
    var thisVal = this.value;
    $('[name="insuranceCompRegnWise[]"]').val(thisVal);
});

$("#allLoanAmount, #allCustomerPrice").on('input', function(e) {
    var thisVal = $("#allLoanAmount").val();
    $('[name="loanAmmountRegnWise[]"]').val(thisVal);


    if (this.id == 'allLoanAmount') {
        var loanAmmount = $("#allLoanAmount").val();
        var customerPrice = $("#allCustomerPrice").val();
    }else if (this.id == 'allCustomerPrice') {
        var loanAmmount = $("#allLoanAmount").val();
        var customerPrice = $("#allCustomerPrice").val();
    }

    if(loanAmmount == '' || customerPrice == ''){
        if(customerPrice == ''){
            loanAmmount = 0;
            customerPrice = $("#allCustomerPrice").val();
        }else if(customerPrice == ''){
            customerPrice = 0;
            loanAmmount = $("#allLoanAmount").val();
        }else{
            loanAmmount = $("#allLoanAmount").val();
            customerPrice = $("#allCustomerPrice").val();
        }
    }

    if(loanAmmount == '' || customerPrice == ''){
        $("#allDownPayment").val('');
    }else{
        if((parseInt(customerPrice)-parseInt(loanAmmount)) >= 0){
            $("#allDownPayment").val((parseInt(customerPrice)-parseInt(loanAmmount))+'.00');
        }else{
            $("#allDownPayment").val('');
        }
    }

    if($(this).val() != ''){
        var processingFee = Math.round(((1/100)*thisVal));
        $('#allLpf').val(processingFee+'.00');

        var lpf = processingFee;
        if($('#allLpf').val() != ''){
            var gstCredit = Math.round(((18/100)*lpf));
            $('#allGst').val(gstCredit+'.00');
        }else{
            $('#allGst').val('');
        }
    }else{
        $('#allLpf').val('');
        $('#allGst').val('');
    }

    $("[name='loanAmmountRegnWise[]'], [name='customerPriceRegnWise[]']").each(function(){
        downPaymentCalculationRegnWise(this);
    });

    $("[name='loanAmmountRegnWise[]']").each(function(){
        lpfCalculationRegnWise(this);
        gstCreditCalculationRegnWise(this)
    });
});

$( document ).ready(function() {
    $('[data-role="datepickerNewTmp"]' ).datepicker({
        showOn: "both",
        changeMonth: true,
        changeYear: true,
        showAnim: "fade",
        dateFormat: 'dd-mm-yy',
        onSelect: function(dateText, inst) {
            var date = $(this).val();
            $("[name='cashEffectiveDate[]']").val(date);

        }
    });    
});

$("#allInclude").on('change', function(e) {
    if ($('#allInclude:checked').length > 0) {
        $("[name^='includeChargeRegnWise_']").prop('checked', 'true');
    }else{
        $("[name^='includeChargeRegnWise_']").removeAttr('checked');
    }
});

$(function () {
               
    $('#allTenure').multiselect({
        columns  : 1,
        search   : true,
        selectAll: true,
        texts    : {
            placeholder: ' -- Select -- ',
            search     : 'Search Here'
        },
        minHeight: '150px',
        checkboxAutoFit: false,
        onOptionClick( element, option ){
            if($(element).hasClass('parent-multi')) load_child(element,option,'parent-multi');
        },
        onSelectAll( element, selected ){
            if($(element).hasClass('parent-multi')) load_child(element,selected,'parent-multi');
        },
    });


    function load_child(element,option,parentClass){
        var optionArr       = [];
        var optionArrText   = {name:'', value:'', checked:false};

        $('.'+parentClass +' > option').each(function(){
                
                optionArrText.name      = $(this).text();
                optionArrText.value     = $(this).val();
                if($(this).is(':selected'))
                    optionArrText.checked = true;
                else
                    optionArrText.checked = false;

                optionArr.push(optionArrText);

                optionArrText   = {name:'', value:'', checked:false};
        });
        $('select[name^="tenureRegnWise_"]').multiselect( 'loadOptions', optionArr);
    }


    $("#checkAll").click(function(){
        if (this.checked) {
            $("[name='refundInitChckbox[]']").prop('checked', true);
        }else{
            $("[name='refundInitChckbox[]']").prop('checked', false);
        }
    });

    $("[name='refundInitChckbox[]']").click(function(){
        if($('[name="refundInitChckbox[]"]:checked').length == $('[name="refundInitChckbox[]"]').length){
            $("#checkAll").prop('checked', true);
        }else{
            $("#checkAll").prop('checked', false);
        }
    });

    $(".refundInitiate").click(function(){
        var docNums = [];
        $.each($("input[name='refundInitChckbox[]']:checked"), function(){            
            docNums.push($(this).val());
        });

        if (docNums.length == '0') {
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Info</h3><p class="margin-bottom-0">Please select an Order to proceed...</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss">Ok</button></div></div>';
            showPopUp(divElementSuccess);
            return false;
        }

        showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
        $("body").addClass('only-read-view');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        var docNumsStr = docNums.join(",");

        $.ajax({
            url: base_url+"refundInitiate",
            type:"POST",
            data: {
                docNums: docNumsStr
            },
            dataType: "json",
            success:function(data){
                hideLoader("body");
                $("body").removeClass('only-read-view');
                if(data.status != 'error'){ 
                    var msgHdng = '<h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3>';
                }else{
                    var msgHdng = '<h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3>';
                }
                var urlString = window.location.href.replace(base_url,'');
                var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+urlString+'\')">Ok</button></div></div>';
                showPopUp(divElementSuccess);
            },
            complete: function(xhr, textStatus) {
                checkIfLogout(xhr);
            }
        });
    });

    var highlight = function (string) {
        matchColor(string, ".highlghtTd");
    };

    highlight($("[name='keywordSrch']").val());

    $("#showPasswordOld").click(function(){
        showHidePassword("[name='old_password']", "#showPasswordOld");
    });

    $("#showPasswordNew").click(function(){
        showHidePassword("[name='password']", "#showPasswordNew");
    });

    $("#showPasswordNewCnfrm").click(function(){
        showHidePassword("[name='password_confirmation']", "#showPasswordNewCnfrm");
    });


    $("#checkAllReset").click(function(){
        if (this.checked) {
            $("[name='passwordResetChckbox[]']").prop('checked', true);
        }else{
            $("[name='passwordResetChckbox[]']").prop('checked', false);
        }
    });

    $("[name='passwordResetChckbox[]']").click(function(){
        if($('[name="passwordResetChckbox[]"]:checked').length == $('[name="passwordResetChckbox[]"]').length){
            $("#checkAllReset").prop('checked', true);
        }else{
            $("#checkAllReset").prop('checked', false);
        }
    });

    $(".passwordRset").click(function(){
        var ids = [];
        $.each($("input[name='passwordResetChckbox[]']:checked"), function(){            
            ids.push($(this).val());
        });

        if (ids.length == '0') {
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Info</h3><p class="margin-bottom-0">Please select a row to proceed...</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss">Ok</button></div></div>';
            showPopUp(divElementSuccess);
            return false;
        }

        showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
        $("body").addClass('only-read-view');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        var idsStr = ids.join(",");

        $.ajax({
            url: base_url+"passwordResetDone",
            type:"POST",
            data: {
                idsStr: idsStr
            },
            dataType: "json",
            success:function(data){
                hideLoader("body");
                $("body").removeClass('only-read-view');
                if(data.status != 'error'){ 
                    var msgHdng = '<h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3>';
                }else{
                    var msgHdng = '<h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3>';
                }
                var urlString = window.location.href.replace(base_url,'');
                var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+urlString+'\')">Ok</button></div></div>';
                showPopUp(divElementSuccess);
            },
            complete: function(xhr, textStatus) {
                checkIfLogout(xhr);
            }
        });
    });


    $("#checkAll").click(function(){
        if (this.checked) {
            $("[name='ordrDlvrdChckbox[]']").prop('checked', true);
        }else{
            $("[name='ordrDlvrdChckbox[]']").prop('checked', false);
        }
    });

    $("[name='ordrDlvrdChckbox[]']").click(function(){
        if($('[name="ordrDlvrdChckbox[]"]:checked').length == $('[name="ordrDlvrdChckbox[]"]').length){
            $("#checkAll").prop('checked', true);
        }else{
            $("#checkAll").prop('checked', false);
        }
    });

    $(".ordrDlvrdVndr").click(function(){
        var docNums = [];
        $.each($("input[name='ordrDlvrdChckbox[]']:checked"), function(){            
            docNums.push($(this).val());
        });

        if (docNums.length == '0') {
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Info</h3><p class="margin-bottom-0">Please select an Order to proceed...</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss">Ok</button></div></div>';
            showPopUp(divElementSuccess);
            return false;
        }

        showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
        $("body").addClass('only-read-view');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        var docNumsStr = docNums.join(",");

        $.ajax({
            url: base_url+"ordrDeliveredStatusVendor",
            type:"POST",
            data: {
                docNums: docNumsStr
            },
            dataType: "json",
            success:function(data){
                hideLoader("body");
                $("body").removeClass('only-read-view');
                if(data.status != 'error'){ 
                    var msgHdng = '<h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3>';
                }else{
                    var msgHdng = '<h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3>';
                }
                var urlString = window.location.href.replace(base_url,'');
                var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+urlString+'\')">Ok</button></div></div>';
                showPopUp(divElementSuccess);
            },
            complete: function(xhr, textStatus) {
                checkIfLogout(xhr);
            }
        });
    });
});


function showHidePassword(changeName, clickElem){
    if($(changeName).attr('type') == 'password'){
      $(changeName).attr('type', 'text');
      $(clickElem+" i").removeClass('fa-eye').addClass('fa-eye-slash');
    }else{
      $(changeName).attr('type', 'password');
      $(clickElem+" i").removeClass('fa-eye-slash').addClass('fa-eye');
    }
}

function matchColor(string, selectr){
    $(selectr).each(function () { 
        var matchStart = $(this).text().toLowerCase().indexOf("" + string.toLowerCase() + "");  
        var matchEnd = matchStart + string.length - 1;
        var matchText = $(this).text().slice(matchStart, matchEnd + 1);
        var afterMatch = $(this).text().slice(matchEnd + 1);
        if (matchStart == '-1') {
            var beforeMatch = $(this).text();
            $(this).html((beforeMatch == '')?'':beforeMatch);
        }else{
            var beforeMatch = $(this).text().slice(0, matchStart);
            $(this).html(beforeMatch + "<mark>" + matchText + "</mark>" + afterMatch);
        }
        
    });
}


function checkIfLogout(xhr){
    if(xhr.status == '419'){
        var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3><p class="margin-bottom-0">Your previously valid authentication has expired. Kindly Login again.</p></div><div class="alert-button alert-success"><a class="button" href="'+base_url+'">Go to Login page</a></div></div>';

        showPopUp(divElement);
        hideLoader("body");
        $("body").removeClass('only-read-view');
        return false;
    }
}

var isopnOnce = 0;
$(function() {
    $(".clickIcnSide").click(function() {
        if($(this).hasClass('fa-shopping-cart')){
            $('.scli').stop(true); 
            $('.scli').clearQueue();
            $('.scli').animate({
                top : "0px"
            }, 300, '', function(){
                $(".clickIcnSide").removeClass('fa-shopping-cart').addClass('fa-arrow-up');
                if(isopnOnce == 0){
                    $(".plsWaitLoader").remove();
                    $(".scli li").after('<div class="plsWaitLoader" style="position:relative; bottom: 18px; left: 60px; z-index: 9999; color: #fff;">Please Wait...</div>');

                    $.ajaxSetup({
                      headers: {
                          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      }
                    });

                    $.ajax({
                        url: base_url+"getOrderCntDocNumWise",
                        type:"POST",
                        dataType: "json",
                        success:function(data){
                            $(".plsWaitLoader").remove();
                            $('.quickOrderCnt').html('<strong>Total document:</strong> '+data+' <br> <strong>Total order:</strong> '+$("[name='totalDataHdn']").val());
                            isopnOnce = 1;
                        },
                        complete: function(xhr, textStatus) {
                            checkIfLogout(xhr);
                        }
                    });
                }
            });
        }else{
            $('.scli').animate({
                top:"-80px"
            },300, '', function(){
                hideLoader(".scli li");
                $("body").removeClass('only-read-view');
                $(".clickIcnSide").removeClass('fa-arrow-up').addClass('fa-shopping-cart');
            });
        }
    });

    $(".fa-times").click(function() {
        
    });  

    $("#changePasswordYes").click(function() {

        if($("[name='old_password']").val().trim() == ''){
            markAsError($("[name='old_password']"),'Current password is required!', true);
            return false;
        }

        if($("[name='password']").val().trim() == ''){
            markAsError($("[name='password']"),'New password is required!', true);
            return false;
        }else{
            if($("[name='password']").val().trim() != $("[name='password_confirmation']").val().trim()){
                markAsError($("[name='password_confirmation']"),'Password mismatch!', true);
                return false;
            }
        }

        showLoader("body", 'position:fixed; top: 40%; left: 40%;');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        $.ajax({
            url: base_url+"changePasswordRegular",
            type:"POST",
            data: {
                old_password: $("[name='old_password']").val(),
                password: $("[name='password']").val()
            },
            dataType: "json",
            success:function(data){
                hideLoader("body");
                if(data.status == 'error'){
                    markAsError($("[name='old_password']"), data.msg, true);
                    return false;
                }else{
                    var msgShow = data.msg;
                    $.ajax({
                        type: 'POST',
                        url: base_url+'logout',
                        success: function()
                        {
                            var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3><p class="margin-bottom-0">'+msgShow+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="window.location.href=\''+base_url+'\'">Ok</button></div></div>';
                            showPopUp(divElement);
                        }
                    });
                    
                }
            },
            complete: function(xhr, textStatus) {
                checkIfLogout(xhr);
            }
        });
    }); 


    $("#checkAllReqCncl").click(function(){
        if (this.checked) {
            $("[name='requestCancelOrderInitChckbox[]']").prop('checked', true);
        }else{
            $("[name='requestCancelOrderInitChckbox[]']").prop('checked', false).prop('disabled', false);
        }

        $.each($("input[name='requestCancelOrderInitChckbox[]']:checked"), function(){    
            if($(this).attr('data-altId') != '0'){
                if (this.checked) {
                    $("#check_"+$(this).attr('data-altId')).prop('checked', true).prop('disabled', true);
                }else{
                    $("#check_"+$(this).attr('data-altId')).prop('checked', false).prop('disabled', false);
                }
            }        
        });
    });

    $("[name='requestCancelOrderInitChckbox[]']").click(function(){
        if($(this).attr('data-altId') != '0'){
            if (this.checked) {
                $("#check_"+$(this).attr('data-altId')).prop('checked', true).prop('disabled', true);
            }else{
                $("#check_"+$(this).attr('data-altId')).prop('checked', false).prop('disabled', false);
            }
        }
        if($('[name="requestCancelOrderInitChckbox[]"]:checked').length == $('[name="requestCancelOrderInitChckbox[]"]').length){
            $("#checkAllReqCncl").prop('checked', true);
        }else{
            $("#checkAllReqCncl").prop('checked', false);
        }
    });

    $(".approveRequestCancl").click(function(){
        var docNums = [];
        $.each($("input[name='requestCancelOrderInitChckbox[]']:checked"), function(){    
            if($(this).is(':disabled') == false){
                docNums.push($(this).val());
            }        
        });

        if (docNums.length == '0') {
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Info</h3><p class="margin-bottom-0">Please select an Order to proceed...</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss">Ok</button></div></div>';
            showPopUp(divElementSuccess);
            return false;
        }

        showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
        $("body").addClass('only-read-view');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        var docNumsStr = docNums.join(",");


        $.ajax({
            url: base_url+"approveCanclReq",
            type:"POST",
            data: {
                docNums: docNumsStr
            },
            dataType: "json",
            success:function(data){
                hideLoader("body");
                $("body").removeClass('only-read-view');
                if(data.status != 'error'){ 
                    var msgHdng = '<h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3>';
                }else{
                    var msgHdng = '<h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3>';
                }
                var urlString = window.location.href.replace(base_url,'');
                var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+urlString+'\')">Ok</button></div></div>';
                showPopUp(divElementSuccess);
            },
            complete: function(xhr, textStatus) {
                checkIfLogout(xhr);
            }
        });
    });

    $(".declineRequestCancl").click(function(){
        var docNums = [];
        $.each($("input[name='requestCancelOrderInitChckbox[]']:checked"), function(){            
            docNums.push($(this).val());
        });

        if (docNums.length == '0') {
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Info</h3><p class="margin-bottom-0">Please select an Order to proceed...</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss">Ok</button></div></div>';
            showPopUp(divElementSuccess);
            return false;
        }

        showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
        $("body").addClass('only-read-view');
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });

        var docNumsStr = docNums.join(",");

        $.ajax({
            url: base_url+"declineCanclReq",
            type:"POST",
            data: {
                docNums: docNumsStr
            },
            dataType: "json",
            success:function(data){
                hideLoader("body");
                $("body").removeClass('only-read-view');
                if(data.status != 'error'){ 
                    var msgHdng = '<h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3>';
                }else{
                    var msgHdng = '<h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3>';
                }
                var urlString = window.location.href.replace(base_url,'');
                var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+urlString+'\')">Ok</button></div></div>';
                showPopUp(divElementSuccess);
            },
            complete: function(xhr, textStatus) {
                checkIfLogout(xhr);
            }
        });
    });
});

function openMenuList(thisElem) {
    $('.dropdownList-content').removeClass('show');
    $(thisElem).next('.dropdownList-content').addClass('show');

    if($(thisElem).closest('table').find('tr').length > 6){
        if($(thisElem).closest('tr').is(':last-child') || $(thisElem).closest('tr').is(':nth-last-child(2)')){
            $(thisElem).next('.dropdownList-content').css({'bottom':'18px'});
        }
    }
}

window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdownList-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}


$(function () {
    
    $('.saveQuestion').click(function(){
	    

	    var id = $(this).parents('tr').find('.idQuestion').val();
	    var englishQuestion = $(this).parents('tr').find('.englishQuestion').val();
	    var bengaliQuestion = $(this).parents('tr').find('.bengaliQuestion').val();
	    var hindiQuestion = $(this).parents('tr').find('.hindiQuestion').val();
	    var assameseQuestion = $(this).parents('tr').find('.assameseQuestion').val();
	    var odiaQuestion = $(this).parents('tr').find('.odiaQuestion').val();

	    if(englishQuestion.trim() == ''){
	    	$(this).parents('tr').find('.englishQuestion').css({'border-color': '#e83038'}).attr('placeholder', 'English question is required!');
	    	return false;
	    }

	    showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
	    $("body").addClass('only-read-view');
	    $.ajaxSetup({
	      headers: {
	          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	      }
	    });

	    $.ajax({
	        url: base_url+"updateQuestions",
	        type:"POST",
	        data: {
	        	id: id,
	            englishQuestion: englishQuestion,
	            bengaliQuestion: bengaliQuestion,
	            hindiQuestion: hindiQuestion,
	            assameseQuestion: assameseQuestion,
	            odiaQuestion: odiaQuestion,
	        },
	        dataType: "json",
	        success:function(data){
	            hideLoader("body");
	            $("body").removeClass('only-read-view');
	            if(data.status != 'error'){ 
	                var msgHdng = '<h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3>';
	            }else{
	                var msgHdng = '<h3 class="error-color"><i class="fa fa-times" aria-hidden="true"></i> Error</h3>';
	            }
	            var urlString = window.location.href.replace(base_url,'');
	            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm">'+msgHdng+'<p class="margin-bottom-0">'+data.msg+'</p></div><div class="alert-button alert-success"><button type="button" class="button" onclick="sortData(\''+base_url+urlString+'\')">Ok</button></div></div>';
	            showPopUp(divElementSuccess);
	        },
	        complete: function(xhr, textStatus) {
	            checkIfLogout(xhr);
	        }
	    });
	});
});

/* Manage Office Location Start */
$(function () {
    $(".state_id_srch").change(function() {
        
        var stateId = $(this).val();
        getZonalByStateId(stateId, "#zonal_id_srch");
    });
});

function getZonalByStateId(parentId, childLocationElementId){
    showLoader(childLocationElementId, 'position:absolute; top: 25px; right: 1px;');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $.ajax({
        url: base_url + 'office-location/getZonalByStateId',
        type: "POST",
        data: {
            stateId: parentId
        },
        dataType: 'json',
        success: function(data) {
            var frmtdHtml = '<option value=""> Select</option>';
            
            frmtdHtml = frmtdHtml + data.zonals;
            $(childLocationElementId).html(frmtdHtml);
            hideLoader(childLocationElementId);
        },
        complete: function(xhr, textStatus) {
            checkIfLogout(xhr);
        }
    });
}
/* Manage Office Location End */

/* Manage Center Details */
$(document).ready(function(){
    $('.viewCenterDetail').on('click', function(){
        var center_id = $(this).data('id');
        var dis_popup = $('#centerdetail_popup');

        var ajax_url = base_url + 'manage-center/view-detail';
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        showLoader("body", "position:fixed; top:45%; left: 50%; z-index: 9999;");
        $("body").addClass('only-read-view');

        var data_string = {center_id:center_id };
        $.ajax({
            url: ajax_url,
            type: "POST",
            data: data_string,
            dataType: 'html',
            beforeSend: function() {
                var divElement = '<div class="popup-container popup-container-la"><div class="content"></div></div>';
            },
            success: function(data) {
                hideLoader("body");
                $("body").removeClass('only-read-view');
                var divElement = '<div class="popup-container popup-container-la"><div class="content">';
                divElement += data;
                divElement += '</div><button title="Close" type="button" class="mfp-close">×</button></div>';
                showPopUp(divElement);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR, textStatus, errorThrown);
            }
        });
    });     
});
/* Manage Center Details Ends */

/* Manage Group member Start */
$(function () {
var oldList, newList, item;
$(".sortable").sortable({
    connectWith: $('.sortable'),
    placeholder: "ui-state-highlight",
   
    helper: function(e, tr)
    {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index)
        {
            $(this).width($originals.eq(index).width());
        });
        $helper.css("background-color", "rgb(223, 240, 249)");
        return $helper;
    },

    start: function (event, ui) {
        item = ui.item;
        newList = oldList = ui.item.parent();
    },
    stop: function (event, ui) {
        console.log(oldList.find('tr').length + " to " + newList.find('tr').length);
        /* Group limit validation */

        var minLength = oldList.find('tr').length;
        var maxLength = newList.find('tr').length;
        var minLimit = $('#member_min_range').val();
        var maxLimit = $('#member_max_range').val();
        if(minLength < minLimit){
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Alert!</h3><p class="margin-bottom-0">Minimum Limit is '+minLimit+' for this group! </p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss" id="close_sortable">Close</button></div></div>';
            showPopUp(divElementSuccess);
            $('#close_sortable').click(function(){
                $('.sortable').sortable('cancel');
            });
        }
        else if(maxLength > maxLimit){
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Alert!</h3><p class="margin-bottom-0">Maximun Limit is '+maxLimit+' for this group! </p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss" id="close_max_sortable">Close</button></div></div>';
            showPopUp(divElementSuccess);
            $('#close_max_sortable').click(function(){
                $('.sortable').sortable('cancel');
            });
        } 
        /* Limit Validation End */
        else{
            var itemID = ui.item.data('id');
            var customerID = ui.item.attr('data-cus-id');
            var groupID = ui.item.parents('table:first').attr('data-group-id');
            var centerID = ui.item.parents('table:first').attr('data-center-id');
            var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm!</h3><p class="margin-bottom-0">Are you sure you want to move '+customerID+' in '+groupID+'?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="cancel_sortable">No</button><button type="button" class="button popup-modal-dismiss" id="yes_item">Yes</button></div></div>';
            showPopUp(divElementSuccess);

            $('#yes_item').click(function(){
                 $.ajaxSetup({
                        headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                   $.ajax({
                        url: base_url + '/group-member/updateCustomerAjax',
                        type: "POST",
                        data: {item_id:itemID, group_code:groupID, center_code:centerID},
                        dataType: 'json',
                        success: function(data) {
                            console.log(data.msg);
                        }
                    }); 
            });

            $('#cancel_sortable').click(function(){
                $('.sortable').sortable('cancel');
            });
        }
    },
    change: function (event, ui) {
        if (ui.sender) {
            newList = ui.placeholder.parent();
        }
    },
    
})
    .disableSelection();
});

function chooseLeader(GROUP_ID, CENTER_ID, CUSTOMER_ID){

    var divElementSuccess = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Confirm!</h3><p class="margin-bottom-0">Are you sure you want to make '+CUSTOMER_ID+' the leader?</p></div><div class="alert-button"><button type="button" class="button button-gray popup-modal-dismiss" id="cancel_sortable">No</button><button type="button" class="button popup-modal-dismiss" id="yes_item">Yes</button></div></div>';
    showPopUp(divElementSuccess);

    $('#yes_item').click(function(){
        $.ajaxSetup({
            headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: base_url + '/group-member/updateCustomerLeaderAjax',
            type: "POST",
            data: {customer_id:CUSTOMER_ID, group_code:GROUP_ID, center_code:CENTER_ID},
            dataType: 'json',
            success: function(data) {
                console.log(data.msg);
                $('.l-check-'+GROUP_ID).prop('checked', false);
                $('#check_'+GROUP_ID+'_'+CUSTOMER_ID).prop('checked', true);
            }
        });
    });    
}

/* Manage Group member End */

// Hide all form Errors
var removeFormErrors = function(formSelector) {
    $(formSelector).find('.error-message').html('');
    $(formSelector).find('.form-panel').removeClass("error");
}

$(function() {
    /* Form Reset Errors */
    $('.form_reset_btn').on('click', function(){
        removeFormErrors($(this).closest("form"));
    });
    
    /* On Enter Submit Form*/
    $('form.enter_submit input').keydown(function(e) {
        if (e.keyCode == 13) {
            $(this).closest('form').submit();
        }
    }); 
    
    /* Multiselect 
    $('select[multiple]').multiselect({
        columns  : 1,
        search   : true,
        selectAll: true,
        texts    : {
            placeholder: '-- Select --',
        }
    });
    */
    
    regionIds_undr_zone = [];
    $('#zoneIdsSrch').multiselect({
        columns  : 1,
        search   : true,
        selectAll: true,
        texts    : {
            placeholder: ' -- Select -- ',
            search     : 'Search Here'
        },
        minHeight: '150px',
        checkboxAutoFit: false,
        onOptionClick( element, option ){
            $('#regionIdsSrch option').removeAttr('selected');

            var zone_region_ids = [];
            
            for(var main = 0; main < $(element).val().length; main++){
                var rgnIds = $('#zoneIdsSrch option[value="'+$(element).val()[main]+'"]').attr('data-region-ids');
                if(rgnIds != ''){
                    var rgnIdsArr = rgnIds.split(',');
                    for(var i = 0; i < rgnIdsArr.length; i++){
                        zone_region_ids.push(rgnIdsArr[i]);
                    }
                    regionIds_undr_zone = zone_region_ids;
                }
            }

            $('#regionIdsSrch').multiselect('reset');
            $('#regionIdsSrch').multiselect('reload');
            var isslctd = false;
            if (typeof zone_region_ids !== 'undefined' && zone_region_ids.length > 0) {
                isslctd = true;
            }

            if(isslctd){
                var Options = $('#regionIdsSrch option').filter(function () {
                    return !zone_region_ids.includes($(this).val());
                });
                Options.each(function () {
                    var input = $('input[value="' + $(this).val() + '"]');
                    input.prop('disabled', true);
                    input.parent('label').parent('li').addClass('disabled');
                    input.parent('label').css({'opacity':'0.4'});
                });
            }else{
                $("#regionIdsSrch").next('.ms-options-wrap').find('.ms-options').find('input[type="checkbox"]').removeAttr('disabled');
            }
        },
        onSelectAll( element, selected ){
            if(selected > 0){
                // $('#regionIdsSrch option').attr('selected', 'selected');
            }else{
                // $('#regionIdsSrch option').removeAttr('selected');
            }
            
            $('#regionIdsSrch').multiselect('reset');
            $('#regionIdsSrch').multiselect('reload');
        },
    });
          
    $('#regionIdsSrch').multiselect({
        columns  : 1,
        search   : true,
        selectAll: true,
        texts    : {
            placeholder: ' -- Select -- ',
            search     : 'Search Here'
        },
        minHeight: '150px',
        checkboxAutoFit: false,
        onOptionClick( element, option ){
            // Store Selected Region Ids
            var global_region_selected = [];
            for(var main = 0; main < $(element).val().length; main++){
                var rgnId = $(element).val()[main];
                global_region_selected.push(rgnId);
            }
            getBranchGroupByRegionID(global_region_selected);
        },
        onSelectAll( element, selected, option ){
            var instance = this;
            var zone_region_ids = regionIds_undr_zone;
            var global_region_selected = [];

            if(selected > 0){

                // Excludes Options not in Zone Regions
                if(zone_region_ids.length > 0){
                    global_region_selected = zone_region_ids;

                    var excludeOptions = $('#regionIdsSrch option').filter(function () {
                        return !zone_region_ids.includes($(this).val());
                    });
                    excludeOptions.each(function () {
                        // var input = $('input[value="' + $(this).val() + '"]');
                        
                        // input.prop('disabled', true);
                        // input.parent('label').css({'opacity':'0.4'});
                        // input.parent('label').parent('li').addClass('disabled');
                        // input.parent('label').parent('li').removeClass('selected');
                    });

                }else{
                    var dis_msOptions = $("#regionIdsSrch .ms-options-wrap .ms-options"); 
                    for(var main = 0; main < $(element).val().length; main++)
                    {
                        global_region_selected.push(rgnId);
                    }
                }

                //=================================
                
                getBranchGroupByRegionID(global_region_selected);

            }else{
                global_region_selected = [];
                getBranchGroupByRegionID(global_region_selected);
                $('#regionIdsSrch').multiselect('reset');

            }
        }
    });

    $('#branchIdsSrch').multiselect({
        columns  : 1,
        search   : true,
        selectAll: true,
        texts    : {
            placeholder: ' -- Select -- ',
            search     : 'Search Here'
        },
        minHeight: '150px',
        checkboxAutoFit: false
    });
    
    /**
    *   Get Branch Using Region Ids
    *   Used in Filter, to Populate Select Options
    *   @param: regionIds [type=array]
    *   @example: [1,2,3] 
    */
    function getBranchGroupByRegionID(regionIds){
        var dis = $("#branchIdsSrch");
        
        if (typeof regionIds !== 'undefined' && regionIds.length > 0) {
            showLoader(dis, 'position:absolute; top: 25px; right: 1px;');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            $.ajax({
                url: base_url + 'office-location/getBranchByRegion',
                type: "POST",
                data: { regionIds: regionIds },
                dataType: 'json',
                success: function(data) {
                    hideLoader(dis);
                    if(data.result){
                        dis.html(data.result);
                    }else{
                        dis.html('');
                    }
                    dis.multiselect('reset');
                    dis.multiselect('reload');
                },
                complete: function(xhr, textStatus) {
                }
            });
        }else{
            dis.html('');
            dis.multiselect('reset');
            dis.multiselect('reload');
        }
    }
    
});

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

/* 
For price input. 
Allows only prices Example: 10.20 
*/
AutoNumeric.multiple('.price', {'numericPos':'true', 'digitGroupSeparator':'', 'watchExternalChanges':'true'});


    
