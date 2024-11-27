(function($) {
	"use strict";
	var HT = {}; 
	var timer;

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

		if(flag) {
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
					
				},
				success: function (res) {
					let album = res.variant.album.split(','); 
					HT.setVariantPrice(res)
					// HT.setupVariantGallery(album);
					HT.setupVariantUrl(res, attribute_id);
				},
				error: function () {
				}
			});
		}
	};

	HT.setupVariantUrl = (res, attribute_id) => {
		let queryString = '?attribute_id=' + attribute_id.join(',')
		let productCanonical = $('.productCanonical').val()
		productCanonical = productCanonical + queryString
		let stateObject = { attribute_id: attribute_id };
		history.pushState(stateObject, "Page Title", productCanonical);
	}

	HT.setVariantPrice = (res) =>{
		$('.quickview-pro-content .item-price-detail').html(res.variantPrice.html)
	}

	// để test lai sao
	// HT.setupVariantGallery = (gallery) => {
	// 	let html = `
	// 		<div class="qty-product-cover">
	// 			${gallery.map(val => `
	// 				<div class="qty-slide">
	// 					<img class="img-responsive" src="${val}" alt="">
	// 				</div>
	// 			`).join('')}
	// 		</div>
	// 		<div class="qty-nav-thumb">
	// 			${gallery.map(val => `
	// 				<div class="qty-slide-thumb">
	// 					<img class="img-thumb" src="${val}" alt="">
	// 				</div>
	// 			`).join('')}
	// 		</div>
	// 	`;
	// 	document.querySelector('.gallery-container').innerHTML = html;
	// };

	HT.loadProductVariant = () => {
		let attributeCatalogue = JSON.parse($('.attributeCatalogue').val())
		if(attributeCatalogue.length){
			HT.selectVariantProduct()
		}
	}




	$(document).ready(function(){
		HT.selectVariantProduct()
		HT.loadProductVariant()
	});

})(jQuery);