// https://www.w3schools.com/jsref/event_onscroll.asp

// window.onscroll = function() {myFunction()};
//
// function myFunction() {
//     if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
//         document.getElementById("myP").className = "test";
//     } else {
//         document.getElementById("myP").className = "";
//     }
// }


(function($) {

	$(document).ready(function() {


		//* On 3 Step Start, smooth scroll to clicked link, change color
		$('.three-step-floating-menu a').on('click', function(e) {
			e.preventDefault();
			var target = e.target.hash;
			var targetTop = ($(target).offset().top);

			//Change the colors up on focus
			$('.three-step-floating-menu a').css({
				'background-color': 'white',
				'color': 'black'
			});

			$('.three-step-floating-menu a:last-child').css({
				'background-color': '#FF9B02',
				'color': 'white'
			});

			$(this).css({
				'background-color': '#444444',
				'color': 'white'
			});

			//Smooth scroll to the target div
			$('html, body').animate({
		        scrollTop: targetTop - 50
		    }, 1000);
		})

	});

})(jQuery);
