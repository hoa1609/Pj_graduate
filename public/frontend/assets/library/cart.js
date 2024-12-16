(function($) {
	"use strict";
	var HT = {}; 
    var _token = $('meta[name="csrf-token"]').attr('content');


    HT.addCart = () => {
        $(document).on('click', '.addToCart', function(e){
            e.preventDefault();
            let _this = $(this)
            let id = _this.attr('data-id')
            let quantity = _this.closest('.ec-quickview-qty').find('.qty-input').val();
            if(typeof quantity === 'undefined'){
                quantity = 1
            }
            let attribute_id = []
            $('.attribute-value .item--color, .attribute-value .item--other').each(function(){
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
                    toastr.clear() //clear khi chon nhanh
                    if(res.code === 10){
                        $('#cart-list').html(res.html);
                        toastr.success(res.messages)
                    }else{
                        toastr.error('Hãy thử lại!')
                    }
                },
            });
        })
    }


    HT.changeQuantity = () => {
        $(document).on('click', '.btn-qty', function(e) {
            e.preventDefault()
            let _this = $(this);
            let qtyElement = _this.siblings('.qty-checkout');
            let qty = parseInt(qtyElement.val()) || 0;
            let newQty = (_this.hasClass('minus') ? qty - 1 : qty + 1);
            if (newQty < 1) newQty = 1;
            qtyElement.val(newQty);

            let option = {
                qty: newQty,
                rowId: _this.siblings('.rowId').val(),
                _token: _token
            }
            HT.handleUpdateCart(_this, option)
        });
    };


    HT.changeQuantityInput = () => {
        $(document).on('change', '.qty-checkout', function(e){
            e.preventDefault();
            let _this = $(this)
            let option = {
                qty: parseInt(_this.val()),
                rowId: _this.siblings('.rowId').val(),
                _token: _token
            }

            if(isNaN(option.qty)){
                toastr.error('Nhập số lượng không hợp lệ!')
            }
            HT.handleUpdateCart(_this, option)
        })
    }
    

    HT.handleUpdateCart = (_this, option) => {
        $.ajax({
            url: 'ajax/cart/update',
            type: 'POST',
            data: option,
            dataType: 'json',
            success: function (res) {
                toastr.clear()
                if(res.code === 10){
                    HT.changeMinyCartQuantity(res)
                    HT.changeMinyCartQuantityItem(_this, option)
                    HT.changeCartItemSubTotal(_this, res)
                    HT.changeCartTotal(res)
                    // toastr.success(res.messages)
                }else{
                    toastr.error('Hãy thử lại!')
                }
            },
        });
    }
    

    HT.changeCartItemSubTotal = (item, res) => {
        item.parents('.item-product').find('.cart-price-sale').html(addCommas(res.response.cartItemSubTotal)+'₫')
    }

    HT.changeMinyCartQuantityItem = (item, option) => {
        item.parents('.cart-product').find('.cart-item-number').html(option.qty)
    }
    HT.changeCartTotal = (res) => {
        $('.cart-total').html(addCommas(res.response.cartTotal)+'₫')
        $('.voucher-price').html('-' + addCommas(res.response.discount) + '₫')
    }

    
    HT.changeMinyCartQuantity = (res) => {
        $('#cartTotalItem').html(res.response.cartTotalItems)
    }

    HT.removeCartItem = () => {
        $(document).on('click', '.cart-item-remove', function(e){
            e.preventDefault();
            let _this = $(this)
            let option = {
                rowId: _this.attr('data-row-id'),
                _token: _token
            }
            $.ajax({
                url: 'ajax/cart/delete',
                type: 'POST',
                data: option,
                dataType: 'json',
                beforeSend: function () {
                },
                success: function (res) {
                    toastr.clear()
                    if(res.code === 10){
                        HT.changeMinyCartQuantity(res)
                        HT.changeCartTotal(res)
                        HT.removeCartItemRow(_this)
                        // toastr.success(res.messages)
                    }else{
                        toastr.error('Hãy thử lại!')
                    }
                },
            });

        })
    }

    HT.removeCartItemRow = (_this) => {
        _this.parents('.item-product').remove()
    }


    HT.select2 = ()=>{
        $('.setUpSelect2').select2();
    }


	$(document).ready(function(){
		HT.addCart()
        HT.changeQuantity()
        HT.changeQuantityInput()
        HT.removeCartItem()
	});

})(jQuery);

