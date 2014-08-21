$(document).ready(function(){



	function init(){
		mobileMenu();
		searchBar();
		socialMenu();
		fixedMenu();
		responsiveIframe();
		flex();
		floatMenu();
	}

	function floatMenu(){


	}

	function flex(){

		$h4s = $("#news h4.nav");
		$h4s.last().clone().insertAfter($h4s.first());
		$h4s.last().remove();

		$("#tabs").flexslider({
			selector: ".slide",
			slideshow: false,
			manualControls: "h4.nav"
		});
	}

	function responsiveIframe(){
		$iframe = $('article iframe');
		$iframe.wrap("<div class='respondvid'></div>");
	}

	function fixedMenu(){
		if(document.getElementById('mobilecontainer')){ return false;}
		// exit out on mobile we dont want this to run at all on it.
		var $window = $(window);
		var $header = $("header.banner");
		var $body	= $("body");
		var $image 	= $("a.navbar-brand");
		var ypos = $("#news").offset().top;
		var news = $("#sticky");
		var $footer = $("footer");
		var footerheight = $footer.innerHeight();
		$image.after("<a class='smalllogo' href='/'><img src='/wp-content/themes/webnotwar/assets/img/smalllogo.png' width='150'></a>")

		$(window).scroll(function(){
			var $y = $window.scrollTop();
			var footerpos = $footer.offset().top;
			console.log($y);
			console.log(footerpos-screen.height);
			// main navigation.
			if($y >= 40){
				//set fixed on the header.
				$header.addClass('fixed');
				$body.addClass('fixed');
				//set opacity and height on image.
			}else{
				$header.removeClass('fixed');
				$body.removeClass('fixed');
			}

			// side bar top position.
			if($y>=(ypos-60)){
				news.addClass("stick");
			}else{
				news.removeClass("stick");
			}

			// side bar bottom position.
			if($y>=(footerpos-screen.height)){

			}else{

			}


		});


	}


	function socialMenu(){

		var $button = $("li.share a");
		var $elem	= $("#sociallinks");

		$button.add($elem).on('click touch', function(evt){
			evt.stopPropagation();
		});

		$button.on('click', function(evt){
			openSearch($elem, evt);
		});
	}


	function searchBar(){
		var $button = $("#utils li.search a");
		var $elem	= $("#utils li.search");

		$button.add($elem).on('click touch', function(evt){
			evt.stopPropagation();
		});

		$button.on('click touch', function(evt){
			if($("#search").val() !== "" ){
			//	$elem.find('#searchform').submit();
			//	return;
			}
			openSearch($elem, evt);

		});
	}

	function openSearch(elem, evt){
		evt.preventDefault();
		elem.toggleClass('active');
		if(elem.hasClass('active')){
			elem.find("#search").focus();
		}
		$(document).on('click touch', function(n){
			elem.removeClass('active');
		});
	}


	function mobileMenu(){
		$(".navbar-toggle").on('click touch', function(evt){
			$(this).toggleClass("active");
			$("header.banner nav").toggleClass("active");
		});
	}


	init();

});