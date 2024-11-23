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

	HT.selectVariantProduct = () => {
		if ($('.choose-attribute').length) {
			$(document).on('click', '.choose-attribute', function (e) {
				e.preventDefault();
				let _this = $(this);
				let attribute_id = _this.attr('data-attributeid');
				let attribute_name = _this.text();
				_this.addClass('active').siblings().removeClass('active');
				_this.closest('.variant-item').find('span').html(attribute_name);
				_this.addClass('active')
				HT.handleAttribute()
			});
		}
	};

	HT.handleAttribute = () => {
		let attribute_id = []
		let flag = true
		$('.attribute-value .choose-attribute').each(function(){
			let _this = $(this)
			if(_this.hasClass('active')){
				attribute_id.push(_this.attr('data-attributeid'))
			}
		})

		$('.attribute').each(function(){
			if($(this).find('.choose-attribute.active').length === 0){
				flag = false
				return false;
			}
		})

		if (flag) {
			$.ajax({
				url: 'ajax/product/loadVariant',
				type: 'GET',
				data: {
					'attribute_id': attribute_id,
					'product_id': $('input[name=product_id]').val(),
					'language_id': $('input[name=language_id]').val(),
				},
				dataType: 'json',
				beforeSend: function () {
					// Bạn có thể thêm loading spinner ở đây nếu cần
				},
				success: function (res) {
					let album = res.variant.album.split(','); 
					HT.setupVariantGallery(album);
				},
				error: function () {
					alert('Có lỗi xảy ra khi tải dữ liệu.');
				}
			});
		}
	}

	// HT.setupVariantGallery = (gallery) => {
	// 	let html = `
	// 		<div class="qty-product-cover"></div>

	// 			<div class="qty-slide">
	// 				<img class="img-responsive" src="${val}" alt="">
	// 			</div>
	// 		</div>
	// 		<div class="qty-nav-thumb">
	// 			<div class="qty-slide-thumb">
	// 				<img class="img-thumb" src="${val}" alt="">
	// 			</div>
	// 		</div>
	// 	`;
	// 	document.querySelector('.gallery-container').innerHTML = html;
	// };
	
	
	
	




	$(document).ready(function(){
		HT.wow()
		HT.swiperCategory()
		HT.swiperBestSeller()
		
		/* CORE JS */
		HT.swiper()
		HT.niceSelect()		
		HT.selectVariantProduct()
	});

})(jQuery);



addCommas = (nStr) => { 
    nStr = String(nStr);
    nStr = nStr.replace(/\./gi, "");
    let str ='';
    for (let i = nStr.length; i > 0; i -= 3){
        let a = ( (i-3) < 0 ) ? 0 : (i-3);
        str= nStr.slice(a,i) + '.' + str;
    }
    str= str.slice(0,str.length-1);
    return str;
}