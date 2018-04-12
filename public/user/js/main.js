(function () {

	'use strict';



	// iPad and iPod detection
	var isiPad = function(){
		return (navigator.platform.indexOf("iPad") != -1);
	};

	var isiPhone = function(){
	    return (
			(navigator.platform.indexOf("iPhone") != -1) ||
			(navigator.platform.indexOf("iPod") != -1)
	    );
	};

	// Parallax
	var parallax = function() {
		$(window).stellar();
	};



	// Burger Menu
	var burgerMenu = function() {

		$('body').on('click', '.js-athmo-nav-toggle', function(event){

			event.preventDefault();

			if ( $('#navbar').is(':visible') ) {
				$(this).removeClass('active');
			} else {
				$(this).addClass('active');
			}



		});

	};


	var goToTop = function() {

		$('.js-gotop').on('click', function(event){

			event.preventDefault();

			$('html, body').animate({
				scrollTop: $('html').offset().top
			}, 500);

			return false;
		});

	};


	// Page Nav
	var clickMenu = function() {

		$('#navbar a:not([class="external"])').click(function(event){
			var section = $(this).data('nav-section'),
				navbar = $('#navbar');

				if ( $('[data-section="' + section + '"]').length ) {
			    	$('html, body').animate({
			        	scrollTop: $('[data-section="' + section + '"]').offset().top
			    	}, 500);
			   }

		    if ( navbar.is(':visible')) {
		    	navbar.removeClass('in');
		    	navbar.attr('aria-expanded', 'false');
		    	$('.js-athmo-nav-toggle').removeClass('active');
		    }

		    event.preventDefault();
		    return false;
		});


	};

	// Reflect scrolling in navigation
	var navActive = function(section) {

		var $el = $('#navbar > ul');
		$el.find('li').removeClass('active');
		$el.each(function(){
			$(this).find('a[data-nav-section="'+section+'"]').closest('li').addClass('active');
		});

	};

	var navigationSection = function() {

		var $section = $('section[data-section]');

		$section.waypoint(function(direction) {

		  	if (direction === 'down') {
		    	navActive($(this.element).data('section'));
		  	}
		}, {
	  		offset: '150px'
		});

		$section.waypoint(function(direction) {
		  	if (direction === 'up') {
		    	navActive($(this.element).data('section'));
		  	}
		}, {
		  	offset: function() { return -$(this.element).height() + 155; }
		});

	};





	// Window Scroll
	var windowScroll = function() {
		var lastScrollTop = 0;

		$(window).scroll(function(event){

		   	var header = $('#athmo-header'),
				scrlTop = $(this).scrollTop();

			if ( scrlTop > 500 && scrlTop <= 2000 ) {
				header.addClass('navbar-fixed-top athmo-animated slideInDown');
			} else if ( scrlTop <= 500) {
				if ( header.hasClass('navbar-fixed-top') ) {
					header.addClass('navbar-fixed-top athmo-animated slideOutUp');
					setTimeout(function(){
						header.removeClass('navbar-fixed-top athmo-animated slideInDown slideOutUp');
					}, 100 );
				}
			}

		});
	};



	// Animations
	// Home

	var homeAnimate = function() {
		if ( $('#athmo-home').length > 0 ) {

			$('#athmo-home').waypoint( function( direction ) {

				if( direction === 'down' && !$(this.element).hasClass('animated') ) {


					setTimeout(function() {
						$('#athmo-home .to-animate').each(function( k ) {
							var el = $(this);

							setTimeout ( function () {
								el.addClass('fadeInUp animated');
							},  k * 200, 'easeInOutExpo' );

						});
					}, 200);


					$(this.element).addClass('animated');

				}
			} , { offset: '80%' } );

		}
	};


	var introAnimate = function() {
		if ( $('#athmo-intro').length > 0 ) {

			$('#athmo-intro').waypoint( function( direction ) {

				if( direction === 'down' && !$(this.element).hasClass('animated') ) {


					setTimeout(function() {
						$('#athmo-intro .to-animate').each(function( k ) {
							var el = $(this);

							setTimeout ( function () {
								el.addClass('fadeInRight animated');
							},  k * 200, 'easeInOutExpo' );

						});
					}, 1000);


					$(this.element).addClass('animated');

				}
			} , { offset: '80%' } );

		}
	};

	var workAnimate = function() {
		if ( $('#athmo-work').length > 0 ) {

			$('#athmo-work').waypoint( function( direction ) {

				if( direction === 'down' && !$(this.element).hasClass('animated') ) {


					setTimeout(function() {
						$('#athmo-work .to-animate').each(function( k ) {
							var el = $(this);

							setTimeout ( function () {
								el.addClass('fadeInUp animated');
							},  k * 200, 'easeInOutExpo' );

						});
					}, 200);


					$(this.element).addClass('animated');

				}
			} , { offset: '80%' } );

		}
	};


	var testimonialAnimate = function() {
		var testimonial = $('#athmo-testimonials');
		if ( testimonial.length > 0 ) {

			testimonial.waypoint( function( direction ) {

				if( direction === 'down' && !$(this.element).hasClass('animated') ) {

					var sec = testimonial.find('.to-animate').length,
						sec = parseInt((sec * 200) - 400);

					setTimeout(function() {
						testimonial.find('.to-animate').each(function( k ) {
							var el = $(this);

							setTimeout ( function () {
								el.addClass('fadeInUp animated');
							},  k * 200, 'easeInOutExpo' );

						});
					}, 200);

					setTimeout(function() {
						testimonial.find('.to-animate-2').each(function( k ) {
							var el = $(this);

							setTimeout ( function () {
								el.addClass('fadeInDown animated');
							},  k * 200, 'easeInOutExpo' );

						});
					}, sec);


					$(this.element).addClass('animated');

				}
			} , { offset: '80%' } );

		}
	};

	var servicesAnimate = function() {
		var services = $('#athmo-services');
		if ( services.length > 0 ) {

			services.waypoint( function( direction ) {

				if( direction === 'down' && !$(this.element).hasClass('animated') ) {

					var sec = services.find('.to-animate').length,
						sec = parseInt((sec * 200) + 400);

					setTimeout(function() {
						services.find('.to-animate').each(function( k ) {
							var el = $(this);

							setTimeout ( function () {
								el.addClass('fadeInUp animated');
							},  k * 200, 'easeInOutExpo' );

						});
					}, 200);

					setTimeout(function() {
						services.find('.to-animate-2').each(function( k ) {
							var el = $(this);

							setTimeout ( function () {
								el.addClass('bounceIn animated');
							},  k * 200, 'easeInOutExpo' );

						});
					}, sec);



					$(this.element).addClass('animated');

				}
			} , { offset: '80%' } );

		}
	};

	var aboutAnimate = function() {
		var about = $('#athmo-about');
		if ( about.length > 0 ) {

			about.waypoint( function( direction ) {

				if( direction === 'down' && !$(this.element).hasClass('animated') ) {


					setTimeout(function() {
						about.find('.to-animate').each(function( k ) {
							var el = $(this);

							setTimeout ( function () {
								el.addClass('fadeInUp animated');
							},  k * 200, 'easeInOutExpo' );

						});
					}, 200);



					$(this.element).addClass('animated');

				}
			} , { offset: '80%' } );

		}
	};

	var countersAnimate = function() {
		var counters = $('#athmo-counters');
		if ( counters.length > 0 ) {

			counters.waypoint( function( direction ) {

				if( direction === 'down' && !$(this.element).hasClass('animated') ) {

					var sec = counters.find('.to-animate').length,
						sec = parseInt((sec * 200) + 400);

					setTimeout(function() {
						counters.find('.to-animate').each(function( k ) {
							var el = $(this);

							setTimeout ( function () {
								el.addClass('fadeInUp animated');
							},  k * 200, 'easeInOutExpo' );

						});
					}, 200);

					setTimeout(function() {
						counters.find('.js-counter').countTo({
						 	formatter: function (value, options) {
				      		return value.toFixed(options.decimals);
				   		},
						});
					}, 400);

					setTimeout(function() {
						counters.find('.to-animate-2').each(function( k ) {
							var el = $(this);

							setTimeout ( function () {
								el.addClass('bounceIn animated');
							},  k * 200, 'easeInOutExpo' );

						});
					}, sec);





					$(this.element).addClass('animated');

				}
			} , { offset: '80%' } );

		}
	};


	var contactAnimate = function() {
		var contact = $('#athmo-contact');
		if ( contact.length > 0 ) {

			contact.waypoint( function( direction ) {

				if( direction === 'down' && !$(this.element).hasClass('animated') ) {

					setTimeout(function() {
						contact.find('.to-animate').each(function( k ) {
							var el = $(this);

							setTimeout ( function () {
								el.addClass('fadeInUp animated');
							},  k * 200, 'easeInOutExpo' );

						});
					}, 200);

					$(this.element).addClass('animated');

				}
			} , { offset: '80%' } );

		}
	};

	// Document on load.
	$(function(){

		parallax();

		// burgerMenu();

		// clickMenu();

		windowScroll();

		navigationSection();

		goToTop();


		// Animations
		homeAnimate();
		introAnimate();
		workAnimate();
		testimonialAnimate();
		servicesAnimate();
		aboutAnimate();
		countersAnimate();
		contactAnimate();


	});


}());
