$(document).ready(function(){

 //Banner Slider
 $('.banner-slider').slick({
    dots: true
 }); 
 
 //Testimonial slider
 $('.testimonial-slider').slick({
    dots: true,
    infinite: true,
    speed: 300,
    slidesToShow: 1,
});

//Carousel
$('.thumb-carousel').slick({
    dots: true,
    speed: 300,
    slidesToShow: 3,
    slidesToScroll: 3,
    infinite: true,
    responsive: [{
        breakpoint: 700,
        settings: {
            slidesToShow: 2,
            slidesToScroll: 2
        }
    }, {
        breakpoint: 480,
        settings: {
            slidesToShow: 1,
            slidesToScroll: 1
        }
    }]
  });

  //Slider Syncing
  $('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
  });
  $('.slider-nav').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    asNavFor: '.slider-for',
    dots: true,
    focusOnSelect: true,
    responsive: [{
        breakpoint: 1100,
        settings: {
            slidesToShow: 5
        }
    },{
        breakpoint: 700,
        settings: {
            slidesToShow: 4
        }
    }, {
        breakpoint: 480,
        settings: {
            slidesToShow: 3
        }
    }]
  });



 //Datepicker
 $('[data-role="datepicker"]' ).datepicker({
    showOn: "both",
    buttonText: "<i class='material-icons'>date_range</i>",
	dateFormat: 'dd-mm-yy'
});

  //Alert
  $('.alert-close').click(function(){
      $(this).parent().hide().remove();
  });


// init Isotope
var $grid = $('.grid').isotope({
    itemSelector: '.element-item',
    layoutMode: 'fitRows',
    getSortData: {
      name: '.name',
      symbol: '.symbol',
      number: '.number parseInt',
      category: '[data-category]',
      weight: function( itemElem ) {
        var weight = $( itemElem ).find('.weight').text();
        return parseFloat( weight.replace( /[\(\)]/g, '') );
      }
    }
  });
  
  $grid.on( 'arrangeComplete', function( event, filteredItems ) {
    console.log( 'arrangeComplete with ' + filteredItems.length + ' items' );
  });
  
  // bind filter button click
  $('.filter-button-group').on( 'click', 'button', function() {
    var filterValue = $( this ).attr('data-filter');
    $grid.isotope({ filter: filterValue });
  });
  
  // bind sort button click
  $('.sort-by-button-group').on( 'click', 'button', function() {
    var sortByValue = $(this).attr('data-sort-by');
    $grid.isotope({ sortBy: sortByValue });
  });
  
  // change active class on buttons
  $('.filter-button-group').each( function( i, buttonGroup ) {
    var $buttonGroup = $( buttonGroup );
    $buttonGroup.on( 'click', 'button', function() {
      $buttonGroup.find('.active').removeClass('active');
      $( this ).addClass('active');
    });
  });



    //Lightbox Magnific Popup
    $('[data-lightbox="inline"]').magnificPopup({
        type:'inline',
        midClick: true, 
        mainClass: 'my-mfp-zoom-in'
    });

    //Delete popup
    $('[data-lightbox="delete-popup"]').magnificPopup({
        type:'inline',
        midClick: true, 
        mainClass: 'my-mfp-zoom-in',
		modal: true
    });
    $(document).on('click', '.popup-modal-dismiss', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});

    //Gallery Magnific Popup
    $('.gallery-container').magnificPopup({
        delegate: '[data-lightbox="images"]',
        type: 'image',
        closeOnContentClick: true,
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        image: {
            verticalFit: true
        }
    });

    //Scroll
    // $(".scroll").mCustomScrollbar({
    //   theme: "minimal-dark",
		//   scrollbarPosition: "outside",
    // });
    //Side Nav height
    sideMenuHeight();

    $(".scroll").mCustomScrollbar({

        scrollbarPosition: "outside",
        mouseWheelPixels: 150
      });
    

    

    /********Dashboard widgets sorting*************/
    // $(".connectedSortable").sortable({
    //     //distance: 10,
    //     //tolerance:"pointer",
    //     placeholder: "sort-highlight",
    //     connectWith: ".connectedSortable",
    //     //handle: ".dashboard-widget",
    //     forcePlaceholderSize: true,
    //     zIndex: 999999,
    //     sort: function(e) {
    //        // console.log('X:' + e.screenX, 'Y:' + e.screenY);
    //        $('.connectedSortable').css({minHeight: '200px'});
    //     },
    //     update: function( ) {
    //         // do stuff
    //         $('.connectedSortable').css({minHeight: '20px'});
    //      }
    // });
    // $(".connectedSortable .dashboard-box-header").css("cursor", "move");

    
    //Timepicker

    //   $('[data-role="timepicker"]' ).timepicker({
    //     showAnim: 'blind'
    // });


//Quick Link
     // Show hide popover
    //  $(".quick-link-dropdown").click(function(){
    //   $(this).find(".quick-link-dropdown-menu").slideToggle("fast");
    //     });
    //   $(document).on("click", function(event){
    //     var $trigger = $(".quick-link-dropdown");
    //     if($trigger !== event.target && !$trigger.has(event.target).length){
    //         $(".quick-link-dropdown-menu").slideUp("fast");
    //     } 
    //   });


    //Quick Link
     // Show hide popover
    
    
      var previousTarget=null;
     $(".quick-link-dropdown").click(function(){
       if($(this).children('.quick-link-dropdown-menu').is(":visible")){
        $(this).parent().removeClass('open');
       }else{
        $(this).parent().addClass('open');
       }
       
      if (this!==previousTarget) {
        $(".quick-link-dropdown-menu").not(this).slideUp("fast");
        $(".quick-link-dropdown-menu").not(this).parent().parent().removeClass('open');
        $(this).parent().addClass('open');
      }
      previousTarget=this;
      $(this).find(".quick-link-dropdown-menu").slideToggle("fast");
        });
      $(document).on("click", function(event){
        var $trigger = $(".quick-link-dropdown");
        if($trigger !== event.target && !$trigger.has(event.target).length){
            $(".quick-link-dropdown-menu").slideUp("fast");
            $(".quick-link-dropdown-menu").parent().parent().removeClass('open');
        } 
      });


//multiselect
    //   $('select[multiple]').multiselect({
    //     columns  : 1,
    //     search   : true,
    //     selectAll: true,
    //     texts    : {
    //         placeholder: '-- Select --',
    //     }
    // });


});





/**************************Document.ready end**************************/


$(window).load(function(){


});

$(window).resize(function(){
  //Side Nav height
  sideMenuHeight();
	

});

$(window).scroll(function(){
    // document.ontouchmove = function(e) {
    //     var target = e.currentTarget;
    //     while(target) {
    //         if(checkIfElementShouldScroll(target))
    //             return;
    //         target = target.parentNode;
    //     }
    
    //     e.preventDefault();
    // };
	

		
});

function sideMenuHeight(){
  var sideBarHeight   =   $(window).height() - $('.sidebar-toggle').outerHeight();
  $('.fixed-sidebar .slide-navigation-inner').css({height: sideBarHeight})
}



var elem = $("#contactform");

$('.orderNo').click(function(e) {
  $(".card").addClass('');
    elem.animate({"right": 5, "opacity": "1"}, {duration: 400, specialEasing: { width: "linear", height: "easeOutBounce"}});
});

$('#closeSideBar').click(function(e) {
    $(".card").removeClass('');
    elem.animate( {"right": -elem.width()-35, "opacity": "0"}, 400, "swing" ); 
});


// $(document).ready(function(){
//   $('[data-toggle="tooltip"]').tooltip();
// });




// custom scrollbar

(function($){
  $(window).on("load",function(){
      
      $.mCustomScrollbar.defaults.theme="light-2"; //set "light-2" as the default theme
      
      $(".demo-y").mCustomScrollbar();
      
      $(".demo-x").mCustomScrollbar({
          axis:"x",
          advanced:{autoExpandHorizontalScroll:true}
      });
      
      $(".demo-yx").mCustomScrollbar({
          axis:"yx"
      });
      
      $(".scrollTo a").click(function(e){
          e.preventDefault();
          var $this=$(this),
              rel=$this.attr("rel"),
              el=rel==="content-y" ? ".demo-y" : rel==="content-x" ? ".demo-x" : ".demo-yx",
              data=$this.data("scroll-to"),
              href=$this.attr("href").split(/#(.+)/)[1],
              to=data ? $(el).find(".mCSB_container").find(data) : el===".demo-yx" ? eval("("+href+")") : href,
              output=$("#info > p code"),
              outputTXTdata=el===".demo-yx" ? data : "'"+data+"'",
              outputTXThref=el===".demo-yx" ? href : "'"+href+"'",
              outputTXT=data ? "$('"+el+"').find('.mCSB_container').find("+outputTXTdata+")" : outputTXThref;
          $(el).mCustomScrollbar("scrollTo",to);
          output.text("$('"+el+"').mCustomScrollbar('scrollTo',"+outputTXT+");");
      });

      // $(".content-1").mCustomScrollbar({
      //     autoHideScrollbar:true,
      //     theme:"rounded"
      // });
      
  });



})(jQuery);
