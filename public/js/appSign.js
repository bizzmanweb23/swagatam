var wrapper = document.getElementById("signature-pad");
var clearButton = wrapper.querySelector("[data-action=clear]");
var changeColorButton = wrapper.querySelector("[data-action=change-color]");
var undoButton = wrapper.querySelector("[data-action=undo]");
var savePNGButton = wrapper.querySelector("[data-action=save-png]");
var saveJPGButton = wrapper.querySelector("[data-action=save-jpg]");
var saveSVGButton = wrapper.querySelector("[data-action=save-svg]");
var canvas = wrapper.querySelector("canvas");
var signaturePad = new SignaturePad(canvas, {
  // It's Necessary to use an opaque color when saving image as JPEG;
  // this option can be omitted if only saving as PNG or SVG
	backgroundColor: 'rgb(255, 255, 255)',
	penColor: "#16264c",
	minWidth: 1,
	maxWidth: 2
});

// Adjust canvas coordinate space taking into account pixel ratio,
// to make it look crisp on mobile devices.
// This also causes canvas to be cleared.
function resizeCanvas() {
  // When zoomed out to less than 100%, for some very strange reason,
  // some browsers report devicePixelRatio as less than 1
  // and only part of the canvas is cleared then.
  var ratio =  Math.max(window.devicePixelRatio || 1, 1);
  // This part causes the canvas to be cleared
  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  canvas.getContext("2d").scale(ratio, ratio);

  // This library does not listen for canvas changes, so after the canvas is automatically
  // cleared by the browser, SignaturePad#isEmpty might still return false, even though the
  // canvas looks empty, because the internal data of this library wasn't cleared. To make sure
  // that the state of this library is consistent with visual state of the canvas, you
  // have to clear it manually.
  signaturePad.clear();
}

// On mobile devices it might make more sense to listen to orientation change,
// rather than window resize events.
window.onresize = resizeCanvas;
resizeCanvas();


function upload(dataURL, filename)
{
  showLoader("#saveEsign", 'position: absolute; bottom: 3px; left: 180px;');
  $("[data-action='clear']").attr('disabled','disabled');
	var canvas = document.getElementById('canvas_image');
	var dataURL = canvas.toDataURL('image/jpeg');
   	
	var fd = new FormData();
	fd.append('dlvryDtlId',  $("#saveEsign").attr('data-id'));
  fd.append('img',  dataURL);
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });
	$.ajax({
	    type: 'POST',
	    url: 'saveESign',
	    data: fd,
	    processData: false,
	    contentType: false
	}).done(function(data) {
      data = JSON.parse(data);
		  $(".mfp-close").unbind('click').click();
      $("[data-action='clear']").removeAttr('disabled');
      hideLoader("#saveEsign");
      $("#signImage_"+$("#saveEsign").attr('data-id')).html('<div class="example gallery-page"><ul class="gallery-container"><div class="gallery-thumb-border"><a href="'+data.picUrl+'" data-lightbox="images" title="Customer Signature" class="gallery-thumb zoom-icon"><img src="'+data.picUrl+'" alt="Customer Signature" style="min-width: 75px; max-width: 75px;" class="example-image"></a></div></ul></div>');
      
      $('.gallery-container').magnificPopup({
          delegate: '[data-lightbox="images"]',
          type: 'image',
          closeOnContentClick: true,
          mainClass: 'mfp-img-mobile',
          gallery: {
              enabled: true,
              navigateByImgClick: true,
              preload: [0,1]
          },
          image: {
              verticalFit: true
          }
      });
      var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3 class="success-color"><i class="fa fa-check" aria-hidden="true"></i> Success</h3><p class="margin-bottom-0">Signature Saved Successfully</p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss">Ok</button></div></div>';
      showPopUp(divElement);
	});
}

function download(dataURL, filename) {
  if (navigator.userAgent.indexOf("Safari") > -1 && navigator.userAgent.indexOf("Chrome") === -1) {
    window.open(dataURL);
  } else {
    var blob = dataURLToBlob(dataURL);
    var url = window.URL.createObjectURL(blob);

    var a = document.createElement("a");
    a.style = "display: none";
    a.href = url;
    a.download = filename;

    document.body.appendChild(a);
    a.click();

    window.URL.revokeObjectURL(url);
  }
}

// One could simply use Canvas#toBlob method instead, but it's just to show
// that it can be done using result of SignaturePad#toDataURL.
function dataURLToBlob(dataURL) {
  // Code taken from https://github.com/ebidel/filer.js
  var parts = dataURL.split(';base64,');
  var contentType = parts[0].split(":")[1];
  var raw = window.atob(parts[1]);
  var rawLength = raw.length;
  var uInt8Array = new Uint8Array(rawLength);

  for (var i = 0; i < rawLength; ++i) {
    uInt8Array[i] = raw.charCodeAt(i);
  }

  return new Blob([uInt8Array], { type: contentType });
}

clearButton.addEventListener("click", function (event) {
  signaturePad.clear();
});

undoButton.addEventListener("click", function (event) {
  var data = signaturePad.toData();

  if (data) {
    data.pop(); // remove the last dot or line
    signaturePad.fromData(data);
  }
});

changeColorButton.addEventListener("click", function (event) {
  var r = Math.round(Math.random() * 255);
  var g = Math.round(Math.random() * 255);
  var b = Math.round(Math.random() * 255);
  var color = "rgb(" + r + "," + g + "," + b +")";

  signaturePad.penColor = color;
});

/*
savePNGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    alert("Please provide a signature first.");
  } else {
    var dataURL = signaturePad.toDataURL();
    download(dataURL, "signature.png");
  }
}); */

saveJPGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    // var divElement = '<div class="popup-container popup-container-sm alert-popup-view"><div class="popup-container-sm"><h3><i class="fa fa-info-circle" aria-hidden="true"></i> Warning</h3><p class="margin-bottom-0">Please Sign </p></div><div class="alert-button alert-success"><button type="button" class="button popup-modal-dismiss">Ok</button></div></div>';
    // showPopUp(divElement);
    return false;
  } else {
    var dataURL = signaturePad.toDataURL("image/jpeg");
    upload(dataURL, "signature.jpg");
  }
});

/*
saveSVGButton.addEventListener("click", function (event) {
  if (signaturePad.isEmpty()) {
    alert("Please provide a signature first.");
  } else {
    var dataURL = signaturePad.toDataURL('image/svg+xml');
    download(dataURL, "signature.svg");
  }
}); */
