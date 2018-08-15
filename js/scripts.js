jQuery(document).ready(function(){

	$('.service').mouseover(function() {
		$(this).find('.service-inner').addClass('service-inner-open');
	}).mouseout(function() {
		$(this).find('.service-inner').removeClass('service-inner-open');
	})


	$('.rollover').mouseover(function(){
		$('.rollover_content.active').removeClass('active');
		var id = $(this).attr('id');
		$('.' + id).addClass('active');
		$('.rollover.active').removeClass('active');
		$(this).addClass('active');
		$('.map-overlay').addClass('active');
	}).mouseout(function(){
		$('.map-overlay').removeClass('active');
		$('.rollover_content.active').removeClass('active');
		$('.rollover.active').removeClass('active');
	});

	if($('.dc-download-code').length){
		if(!$('.dc-download-code form').length){
			var pos = parseInt($('.dc-download-code').offset().top);
			// console.log(pos);
			$('html, body').animate({
				scrollTop : pos + 'px'
			}, 1000);
		}else {
			// console.log('got a form');
		}
	}

	$('.hotspot').click(function(evt){
		var id = evt.target.dataset.link;
		$('.map-content').show();
		$('.hotspot-content').hide();
		$('#' + id).show();
		$('.map-content').addClass('active');
		$('body').addClass('noscroll');
	});

	$('#close-map-content').click(function(){
		$('body').removeClass('noscroll');
		$('.map-content').removeClass('active');
		$('.map-content').hide();
	});

    $(".dropdown").hover(
        function() { $('.dropdown-menu', this).fadeIn("fast");
        },
        function() { $('.dropdown-menu', this).fadeOut("fast");
    });

    // Calendar stuff
    var ajaxurl = $('.ajaxurl').text();
	var date = new Date();
	var month = date.getMonth();
	if(month == 12){
		month = 1;
	}else {
		month++;
	}
	var year = date.getFullYear();
	var selectedClassName = 'all'; 

	if($('.calendar-container').length > 0){
		$('a.has-event').each(function(){
			$(this).parent('.day-container').addClass($(this).attr('class'));
		});
	}

	$('.cal-next').click(function(){

		if(month == 12){
			month = 1;
			year++;
		}else {
			month++;
		}

		$('.calendar-container').empty();
		$('.calendar-container').append('<p class="loading">loading...</p>');

		$.post(templateUrl + '/wp-admin/admin-ajax.php', {
		    action: 'my_unique_action',
		    newmonth: month,
		    newyear: year
		}, function(data) {

		  	$('.calendar-container').prepend(data);
		  	$('.loading').remove();
			$('a.has-event').each(function(){
				$(this).parent('.day-container').addClass($(this).attr('class'));
				$(this).closest('.day-container').addClass('has-event');
			});

			if(selectedClassName == 'all'){
				$('.calendar-container a.has-event').show().parent('.day-container').addClass('has-event');
			} else {
				$('.calendar-container a.has-event').hide().parent('.day-container').removeClass('has-event');

				$('.calendar-container a.has-event').each(function(){
					if($(this).hasClass(selectedClassName)){
						$(this).show().parent('.day-container').addClass('has-event');
					}
				});
			}
		});
	});

	$('.cal-prev').click(function(){

		if(month == 1){
			month = 12;
			year--;
		}else {
			month--;
		}

		$('.calendar-container').empty();
		$('.calendar-container').append('<p class="loading">loading...</p>');

		$.post(templateUrl+'/wp-admin/admin-ajax.php', {
		    action: 'my_unique_action',
		    newmonth: month,
		    newyear: year
		}, function(data) {

		  	$('.calendar-container').prepend(data);
		  	$('.loading').remove();

		  	$('a.has-event').each(function(){
				$(this).parent('.day-container').addClass($(this).attr('class'));
			});

			if(selectedClassName == 'all'){
				$('.calendar-container a.has-event').show().parent('.day-container').addClass('has-event');
			}else {
				$('.calendar-container a.has-event').hide().parent('.day-container').removeClass('has-event');

				$('.calendar-container a.has-event').each(function(){
					if($(this).hasClass(selectedClassName)){
						$(this).show().parent('.day-container').addClass('has-event');
					}
				});
			}
		});
	});

	$('.calendar-filters select').on('change', function(e){
		selectedClassName = $(this).val();
		console.info('selectedClassName: ' + selectedClassName);
		if(selectedClassName == 'all'){
			$('.calendar-container a.has-event').show().parent('.day-container').addClass('has-event');

		} else {
			$('.calendar-container a.has-event').hide().parent('.day-container').removeClass('has-event');
			$('.calendar-container a.has-event').each(function(){
				if($(this).hasClass(selectedClassName)){
					$(this).show().parent('.day-container').addClass('has-event');
				}
			});
		}
	});

	$('body').click(function(e){
		if($(e.target).hasClass('close-popup')){
			$('.cal-popup-inner .cal-scroller').empty();
			$('.cal-popup').hide();
			$('.close-popup').remove();

		}else if($(e.target).hasClass('has-event')) {			
			var eventId = $(e.target).attr('id');
			$('#' + eventId).closest('.day-container').find('.hidden-calendar-poup').clone().appendTo('.cal-scroller');
			$('<a href="#" class="close-popup">Close</a>').appendTo('.cal-popup-inner');
			$('.cal-popup').show();
		}
		
	});

	var windowHeight = parseInt($(window).height());
	var windowWidth = parseInt($(window).width());
	
	if($('.calendar-container').length >0 && windowWidth < 768){
		$('.calendar-day-head').each(function(){
			var str = $(this).text();
			var res = str.charAt(0);
			$(this).text(res);
		});
	}

	$('.open-feedback-form').click(function(){
		$('.feedback-form-container').animate({height:'auto', 'padding': '30px'},200);
	});

	$('.feedback-form-container .close-form').click(function(){
		$('.feedback-form-container').animate({height:0, 'padding': '0px'},200);
	});
	
	$('.open-signup').click(function(){
		$('.signup-form-container').slideToggle(400);
	});

	$('.signup-form-container .close-form').click(function(){
		$('.signup-form-container').slideToggle(400);
	});

	$('.open-search').click(function(){
		$('.search-container').slideToggle(400);
	});

	$('.search-container .close-form').click(function(){
		$('.search-container').slideToggle(400);
	});

	$('.section_menu .menu-item-has-children>a').click(function(e){
		e.preventDefault();
		$(this).parent('.menu-item-has-children').find('.sub-menu').toggleClass('shown');
	});

	if($('.section_menu').length > 0){
		var section_ID = $('.section_menu').attr('id');
		var section_ID = section_ID.replace("menu-section_menu", "content");
		$('.column_wrapper').attr('id', section_ID);
	}
	
	$("body").on("click", "a.rb_weblink", function(e) {
		e.preventDefault();
		var vHref = $(this).attr('href');
		window.open(vHref);
	});

	// Cookies panel
	var vCookies_expire = new Date();
	vCookies_expire.setDate(vCookies_expire.getDate() + 180);

	var vCookiesCookie = 'enablelc_cookies';

	var vCookieCookie = $.cookies.get(vCookiesCookie);
	if (vCookieCookie == null || vCookieCookie == 0){
		$('div#cookies').slideDown(300);
		$.cookies.set(vCookiesCookie, 0, { expiresAt: vCookies_expire } );
	}

	$("body").on("click", "a#cookie_continue", function(e) {
		e.preventDefault();
		$('div#cookies').slideUp(300);
		if (vCookieCookie == null || vCookieCookie == 0){
			$.cookies.set(vCookiesCookie, 1, { expiresAt: vCookies_expire } );
		}
	});

	$('.jargon-holder div').hide().filter(function(){
    	return $(this).text().toUpperCase()[0] == 'A';
    }).show();

	$('.jargon-buster li').click(function(){
		var letter = $(this).text();
		$('.jargon-holder div').hide().filter(function(){
        	return $(this).text().toUpperCase()[0] == letter;
        }).show();
	});

	if (document.title == "Job Application Form - Enable : Enable") {
		$(window).bind('beforeunload', function(e) {
			var res = confirm("Are you sure you want to leave this application? Any unsaved changes will be lost.");

			if (res) {
				return true;
			} else {
				return false;
			}
		})
	}
});

