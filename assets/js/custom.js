(function ($) {
	
	"use strict";

	// Header Type = Fixed
  $(window).scroll(function() {
    var scroll = $(window).scrollTop();
    var box = $('.header-text').height();
    var header = $('header').height();

    if (scroll >= box - header) {
      $("header").addClass("background-header");
    } else {
      $("header").removeClass("background-header");
    }
  });


	$('.owl-banner').owlCarousel({
		items:1,
		loop:true,
		dots: true,
		nav: false,
		autoplay: true,
		margin:0,
		  responsive:{
			  0:{
				  items:1
			  },
			  600:{
				  items:1
			  },
			  1000:{
				  items:1
			  },
			  1600:{
				  items:1
			  }
		  }
	})

    $('.owl-services').owlCarousel({
        items:4,
        loop:true,
        dots: true,
        nav: false,
        autoplay: true,
        margin:5,
          responsive:{
              0:{
                  items:1
              },
              600:{
                  items:2
              },
              1000:{
                  items:3
              },
              1600:{
                  items:4
              }
          }
    })

    $('.owl-portfolio').owlCarousel({
        items:4,
        loop:true,
        dots: true,
        nav: true,
        autoplay: true,
        margin:30,
          responsive:{
              0:{
                  items:1
              },
              700:{
                  items:2
              },
              1000:{
                  items:3
              },
              1600:{
                  items:4
              }
          }
    })

    

	// Menu Dropdown Toggle
  if($('.menu-trigger').length){
    $(".menu-trigger").on('click', function() { 
      $(this).toggleClass('active');
      $('.header-area .nav').slideToggle(200);
    });
  }


  // Menu elevator animation
  $('.scroll-to-section a[href*=\\#]:not([href=\\#])').on('click', function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        var width = $(window).width();
        if(width < 991) {
          $('.menu-trigger').removeClass('active');
          $('.header-area .nav').slideUp(200);  
        }       
        $('html,body').animate({
          scrollTop: (target.offset().top) + 1
        }, 700);
        return false;
      }
    }
  });

  $(document).ready(function () {
      // add scroll
      $(document).on("scroll", onScroll);

      // get application storage data
      const optionsData = localStorage.getItem('guser');
      const user_rec = JSON.parse(optionsData);
      var guser = user_rec.uname ? user_rec.uname : '';
      console.log(user_rec);

      // set user info from stored settings
      $('#userfname').val(user_rec.uname);
      $('#userphone').val(user_rec.uphone);
      $('#userid').val(user_rec.uid);

      // set data links and info based on user settings data from localstorage
      $('.username_link').html(user_rec.uname);
      $('.tokenValue').html(user_rec.ubalance);

      // logout link
      $('.logout_link').click(function() {
        // clear application settings storage data
        if(guser) {
          localStorage.removeItem('guser');
          window.location.href = 'index.php';
        }
      });

      // view product & redeem 
      $(document).on('click', '.quick_view, .add-to-cart', function(e) {
        e.preventDefault();
        var postid = $(this).attr('data-id');
        var pimg = document.getElementById("pimg");

        $.ajax({
          type: 'POST',
          url: apiUrl +'marketplace/product_details.php',
          data: {
            'postid': postid
          },
          dataType: "json",
          success: function(res) {
            console.log(res);
            pimg.src = res.data.product_image_url;
            $('#pdesc').html(res.data.product_description);
            $('#pname').html(res.data.product_name);
            $('#pcost').html("GT "+res.data.product_price);
            $('#sponsor').val(res.data.sponsor_id);
            $('#product').val(res.data.product_name);
            $('#product_price').val(res.data.product_price);
            $('#pid').val(res.data.gp_id);
            $('#product_view').modal('show');
					},
          error: function(res) {
            console.log(res);
          }
				});

      });
      
      
      //smoothscroll
      $('.scroll-to-section a[href^="#"]').on('click', function (e) {
          e.preventDefault();
          $(document).off("scroll");
          
          $('.scroll-to-section a').each(function () {
              $(this).removeClass('active');
          })
          $(this).addClass('active');
        
          var target = this.hash,
          menu = target;
          var target = $(this.hash);
          $('html, body').stop().animate({
              scrollTop: (target.offset().top) + 1
          }, 500, 'swing', function () {
              window.location.hash = target;
              $(document).on("scroll", onScroll);
          });
      });

  });

  function onScroll(event){
      var scrollPos = $(document).scrollTop();
      $('.nav a').each(function () {
          var currLink = $(this);
          var refElement = $(currLink.attr("href"));
          if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
              $('.nav ul li a').removeClass("active");
              currLink.addClass("active");
          }
          else{
              currLink.removeClass("active");
          }
      });
  }



	// Page loading animation
	 $(window).on('load', function() {

        $('#js-preloader').addClass('loaded');

    });

	

	// Window Resize Mobile Menu Fix
  function mobileNav() {
    var width = $(window).width();
    $('.submenu').on('click', function() {
      if(width < 767) {
        $('.submenu ul').removeClass('active');
        $(this).find('ul').toggleClass('active');
      }
    });
  }




})(window.jQuery);