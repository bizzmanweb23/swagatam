$(document).on('click', '.viewImages', function(e) {
        var dataId = $(this).attr('data-id');
    
        var links = [];
        var checkExtension = ['jpg','jpeg','png','JPG','JPEG','PNG'];
        var imageExtension = [];
    
        $("#tableRowItem_" + dataId).find("[name='itemImagesHdn["+dataId+"][]']").each(function(index) {
                var fname = $(this).val();
                console.log(fname);
                var ext = fname.slice((fname.lastIndexOf(".") - 1 >>> 0) + 2);
            
                if(checkExtension.indexOf(ext) != -1){
                    
                    imageExtension.push(ext);
                    
                    imageGalleryHtml += '<div><img class="slider-img-center" data-u="image" src="'+$(this).val()+'" /><img data-u="thumb" src="'+$(this).val()+'" /></div>';
                }
                else{
                    
                  links.push(fname);
                }
            
            });

        var imageGalleryHtml = '<div class="popup-container item-pic-popup popup-container-la" id="item-pic">';
            imageGalleryHtml += '<div class="card-container">';
            imageGalleryHtml += '<div id="jssor_1" class="main-item-blog" style="position:relative; margin:0 auto; top:0px; left:0px; width:960px; height:480px; overflow:hidden; visibility:hidden;">';
            imageGalleryHtml += '<div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;">';
            imageGalleryHtml += '<img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="public/images/svg/loading/static-svg/spin.svg" />';
            imageGalleryHtml += '</div>';
            imageGalleryHtml += '<div data-u="slides" style="cursor:default;position:relative;top:0px;left:240px;width:720px;height:480px;overflow:hidden;">'
           
            $("#tableRowItem_" + dataId).find("[name='itemImagesHdn["+dataId+"][]']").each(function(index) { 
                imageGalleryHtml += '<div><img class="slider-img-center" data-u="image" src="'+$(this).val()+'" /><img data-u="thumb" src="'+$(this).val()+'" /><a href="'+$(this).val()+'" class="text-right right" title="download" style="float: right;color: #004F00;padding-right: 25px;padding-top: 3px;" download><i class="fa fa-download fa-lg" aria-hidden="true"></i></a></div>';
            });

            imageGalleryHtml += '</div>';
            imageGalleryHtml += '<div data-u="thumbnavigator" class="jssort101" style="position:absolute;left:0px;top:0px;width:240px;height:480px;" data-autocenter="2" data-scale-left="0.75">';
            imageGalleryHtml += '<div data-u="slides">';
            imageGalleryHtml += '<div data-u="prototype" class="p" style="width:99px;height:66px;"><div data-u="thumbnailtemplate" class="t"></div><svg viewBox="0 0 16000 16000" class="cv"><circle class="a" cx="8000" cy="8000" r="3238.1"></circle><line class="a" x1="6190.5" y1="8000" x2="9809.5" y2="8000"></line><line class="a" x1="8000" y1="9809.5" x2="8000" y2="6190.5"></line></svg></div></div></div>';
            imageGalleryHtml += '<div data-u="arrowleft" class="jssora093" style="width:50px;height:50px;top:0px;left:270px;" data-autocenter="2"><svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><circle class="c" cx="8000" cy="8000" r="5920"></circle><polyline class="a" points="7777.8,6080 5857.8,8000 7777.8,9920 "></polyline><line class="a" x1="10142.2" y1="8000" x2="5857.8" y2="8000"></line></svg>';
            imageGalleryHtml += '</div>';
            imageGalleryHtml += '<div data-u="arrowright" class="jssora093" style="width:50px;height:50px;top:0px;right:30px;" data-autocenter="2"><svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;"><circle class="c" cx="8000" cy="8000" r="5920"></circle><polyline class="a" points="8222.2,6080 10142.2,8000 8222.2,9920 "></polyline><line class="a" x1="5857.8" y1="8000" x2="10142.2" y2="8000"></line></svg></div>';
            imageGalleryHtml += '</div></div><button title="Close" type="button" class="mfp-close">&#10006;</button></div>';
        

        /* Download files */
        if(links.length > 0)
        {
            downloadAll(links);
        }
        if(imageExtension.length > 0)
        {
    
            showPopUp(imageGalleryHtml);

            var jssor_1_SlideshowTransitions = [{
                            $Duration: 1200,
                            $Zoom: 1,
                            $Easing: {
                                $Zoom: $Jease$,
                                $Opacity: $Jease$
                            },
                            $Opacity: 2
                        }];

            var jssor_1_options = {
                $AutoPlay: 1,
                $SlideshowOptions: {
                    $Transitions: jssor_1_SlideshowTransitions,
                    $TransitionsOrder: 1
                },
                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$
                },
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,
                    $Rows: 2,
                    $SpacingX: 10,
                    $SpacingY: 10,
                    $Orientation: 2,
                    $Align: 156
                }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 1200;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                } else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);

        }
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

function downloadAll(urls) {
  var link = document.createElement('a');

  link.setAttribute('download', 'Attachment');
  link.style.display = 'none';

  document.body.appendChild(link);

  for (var i = 0; i < urls.length; i++) {
    link.setAttribute('href', urls[i]);
    link.click();
  }

  document.body.removeChild(link);
}