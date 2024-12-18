(function($) {
	"use strict";
	var HT = {}; 

    

    $("#slider-range").slider({
        range: true,
        orientation: "horizontal",
        min: 0,
        max: 1000000,
        values: [0, 1000000],
        step: 100,

        slide: function (event, ui) {
            if (ui.values[0] == ui.values[1]) {
                return false;
            }
            $("#min_price").val(addCommas(ui.values[0]));
            $("#max_price").val(addCommas(ui.values[1]));
        },
        stop: function (event, ui) {
            HT.sendDataToFilter();
        }
    });
    $("#min_price").val(addCommas($("#slider-range").slider("values", 0)));
    $("#max_price").val(addCommas($("#slider-range").slider("values", 1)));

    
    HT.filter = () => {
        $(document).on('change', '.filtering', function(){
            HT.sendDataToFilter()
        })
    }

    HT.sendDataToFilter = () => {
        let option = HT.filterOption()
        $.ajax({
            url: 'ajax/product/filter',
            type: 'GET',
            data: option,
            dataType: 'json',
            beforeSend: function () {
            },
            success: function (res) {
                let html = res.data
                $('.shop-pro-content .product-catalogue').html(html)
            },
            error: function () {
            }
        });
        
    }


    HT.filterOption = () => {
        var filterOption = {
            sort: $('select[name=sort]').val(),
            // rate: $('input[name="rate[]"]:checked').map(function(){
            //     return this.value
            // }).get(),
            price: {
                price_min: $('#min_price').val(),
                price_max: $('#max_price').val(),
            },
            productCatalogueId: $('.product_catalogue_id').val(),
            attributes: {}
        }

        $('.filterAttribute:checked').each(function(){
            let attributeId = $(this).val()
            let attributeGroup = $(this).attr('data-group')

            if(!filterOption.attributes.hasOwnProperty(attributeGroup)){
                filterOption.attributes[attributeGroup] = []
            }

            filterOption.attributes[attributeGroup].push(attributeId)
        })
        return filterOption
    }



	$(document).ready(function(){
        HT.filter()
	});

})(jQuery);

