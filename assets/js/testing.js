$(document).ready(function(){



	function init(){
		mobileMenu();
	}


	function mobileMenu(){
		$(".navbar-toggle").on('click touch', function(evt){
			$(this).toggleClass("active");
			$("header.banner nav").toggleClass("active");
		});
	}


	init();

});