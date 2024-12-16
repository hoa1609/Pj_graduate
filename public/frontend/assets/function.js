(function($) {
	"use strict";
	var HT = {}; 

	HT.select2 = ()=>{
        $('.setUpSelect2').select2();
    }


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
			    delay: 5000,
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

	$(document).ready(function(){
		HT.swiper()
	});

})(jQuery);


addCommas = (nStr) => {
    nStr = String(nStr);
    nStr = nStr.replace(/\./gi, "");
    let str = '';
    for (let i = nStr.length; i > 0; i -= 3) {
        let a = ((i - 3) < 0) ? 0 : (i - 3);
        str = nStr.slice(a, i) + '.' + str;
    }
    str = str.slice(0, str.length - 1);
    return str;
}