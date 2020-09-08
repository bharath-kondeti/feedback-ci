(function($) {
"use strict";

  function autoHeight() {
    var why_choose_img = $('.apps-craft-why-chose-img'),
      why_choose_txt = $('.apps-craft-why-choose-us-container');

      why_choose_txt.css('height', why_choose_img.outerHeight());
  }

  
  autoHeight();

  /*=============================================== 
      3. Animate Init
  ================================================*/
  new WOW().init();

$(window).on('load', function() {
  autoHeight();

  /*=============================================== 
      4. Preloader
  ================================================*/
  $('#preloader').fadeOut(450);


  $('body').addClass('apps-craft--loaded');


}); 


$(document).ready(function() {

    $(".tab-content-one").show();
     $(".tab-content-one").addClass("wow fadeInRight animated");

     $(".achivement-reg>a").click(function() {
        $(".tab-content-one").hide();
          $(".tab-content-three").hide();
        $(".tab-content-two").show();
          $(".tab-content-two").addClass("wow fadeInRight animated");
    

    });

     $(".signin").click(function() {
        $(".tab-content-two").hide();

         $(".tab-content-one").show();
         $(".tab-content-one").addClass("wow fadeInRight animated");
    });

      $(".forgets").click(function() {
         $(".tab-content-one").hide();
         $(".tab-content-three").show();
         $(".tab-content-three").addClass("wow fadeInRight animated");
    });




});

$(document).ready(function() {
$(".tab_menu").click(function () {
    $(".tab_menu").removeClass("active");
    // $(".tab").addClass("active"); // instead of this do the below 
    $(this).addClass("active");   
});
});


$(document).ready(function(){
  autoHeight();

	/*=============================================== 
	      5. Parallax Init
	  ================================================*/
	if ($('#apps_craft_animation').length > 0 ) {
	  $('#apps_craft_animation').parallax();
	}

	// #apps_craft_animation-2 For Index Version 5
	if ($('#apps_craft_animation-2').length > 0) {
	  $('#apps_craft_animation-2').parallax();
	}

  /*=============================================== 
      6. Apps Craft Top Menu Offset
  ================================================*/
  if($('.apps-craft-menu ul li a, .apps-craft-menu-item ul li a, .apps-craft-logo a').length >0 ) {
 	$('.apps-craft-menu ul li a, .apps-craft-menu-item ul li a, .apps-craft-logo a').on('click', function(event) {
 		event.preventDefault();

 		var target = $(this.getAttribute('href'));

 		$('html, body').animate({
 			scrollTop: target.offset().top
 		}, 500);
 	});
  } // End is_exists 

 


// Version 18 Apps Screen
  function showpanel() {
    $('.appscraft-screen-container').removeClass('startup');
    $('.ball').addClass('active').delay(2000).queue(function(next) {
      $(this).removeClass('active');
      next();
    });
  }
  
  $('.ball').click(function() {
    $(this).toggleClass('active');
  });


  $('i').click(function() {
    $('.ball').addClass('expand');
    $('.back').addClass('show');
  });

  $('.back').click(function() {
    $(this).removeClass('show');
    $('.ball').removeClass('expand');
    $('.appscraft-screen-container').addClass('shake').delay(500).queue(function(next) {
      $(this).removeClass('shake');
      next();
    });
  });
  
 setTimeout(showpanel, 1800);




}); // End Document Ready





})(jQuery);