(function($) {
	"use strict";
	var HT = {}; 
	var timer;

	HT.swiperOption = (setting) => {
		let option = {}
		if(setting.animation.length){
			option.effect = setting.animation;
		}	
		if (setting.arrow === 'accept') {
			option.navigation = {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			};
		} else {
			$('.swiper-button-next, .swiper-button-prev').remove();
		}
		if(setting.autoplay === 'accept'){
			option.autoplay = {
			    delay: 4000,
			    disableOnInteraction: false,
			}
		}
		if(setting.navigate === 'dots'){
			option.pagination = {
				el: '.swiper-pagination',
			}
		}
		return option
	}
	
	/* MAIN VARIABLE */
	HT.swiper = () => {
		if($('.panel-slide').length){
			let setting = JSON.parse($('.panel-slide').attr('data-setting'))
			let option = HT.swiperOption(setting)
			var swiper = new Swiper(".panel-slide .swiper-container", option);
			// Kiểm tra nếu `pauseHover` là 'accept' và dừng autoplay khi hover
		}
	}

	HT.swiperCategory = () => {
		var swiper = new Swiper(".panel-category .swiper-container", {
			loop: false,
			pagination: {
				el: '.swiper-pagination',
			},
			spaceBetween: 20,
			slidesPerView: 3,
			breakpoints: {
				415: {
					slidesPerView: 3,
				},
				500: {
				  slidesPerView: 3,
				},
				768: {
				  slidesPerView: 6,
				},
				1280: {
					slidesPerView: 10,
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
		});
	}

	HT.swiperBestSeller = () => {
		var swiper = new Swiper(".panel-bestseller .swiper-container", {
			loop: false,
			pagination: {
				el: '.swiper-pagination',
			},
			spaceBetween: 20,
			slidesPerView: 2,
			breakpoints: {
				415: {
					slidesPerView: 1,
				},
				500: {
				  slidesPerView: 2,
				},
				768: {
				  slidesPerView: 3,
				},
				1280: {
					slidesPerView: 4,
				}
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			
		});
	}
	

	HT.wow = () => {
		var wow = new WOW(
			{
			  boxClass:     'wow',      
			  animateClass: 'animated', 
			  offset:       0,          
			  mobile:       true,       
			  live:         true,       
			  callback:     function(box) {
			  },
			  scrollContainer: null,    
			  resetAnimation: true,     
			}
		  );
		  wow.init();
	}

	HT.niceSelect = () => {
		if($('.nice-select').length){
			$('.nice-select').niceSelect();
		}
	}


	$(document).ready(function(){
		HT.wow()
		HT.swiperCategory()
		HT.swiperBestSeller()
		
		/* CORE JS */
		HT.swiper()
		HT.niceSelect()		
		
	});

})(jQuery);