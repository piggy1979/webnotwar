$(document).ready(function(){



	function init(){
		mobileMenu();
		searchBar();
		socialMenu();
		fixedMenu();
		responsiveIframe();
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

		$image.after("<a class='smalllogo' href='/'><img src='/wp-content/themes/webnotwar/assets/img/smalllogo.png' width='150'></a>")

		$(window).scroll(function(){
			var $y = $window.scrollTop();
		
			if($y >= 40){
				//set fixed on the header.
				$header.addClass('fixed');
				$body.addClass('fixed');
				//set opacity and height on image.
			}else{
				$header.removeClass('fixed');
				$body.removeClass('fixed');

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