(function($) {
	"use strict";
	var HT = {}; 
	var timer;
    var _token = $('meta[name="csrf-token"]').attr('content');



    HT.addCart = () => {
        $(document).on('click', '.addToCart', function(){
            let _this = $(this)
            let id = _this.attr('data-id')
            let quantity = _this.closest('.ec-quickview-qty').find('.qty-input').val();
            if(typeof quantity === 'undefined'){
                quantity = 1
            }

            let attribute_id = []
            $('.attribute-value .choose-attribute').each(function(){
                let _this = $(this)
                if(_this.hasClass('active')){
                    attribute_id.push(_this.attr('data-attributeid'))
                }
            })

            let option = {
                id : id,
                quantity: quantity,
                attribute_id: attribute_id,
                _token: _token
            }

            $.ajax({
                url: 'ajax/cart/create',
                type: 'POST',
                data: option,
                dataType: 'json',
                beforeSend: function () {
                    
                },
                success: function (res) {
                    console.log(res)
                    if(res.code === 10){
                        toastr.success(res.messages, 'Thông báo từ hệ thống!')
                    }
                },
               
            });



        })
    }



	$(document).ready(function(){
		
	});

	$(document).ready(function(){
		HT.addCart()
	});

})(jQuery);