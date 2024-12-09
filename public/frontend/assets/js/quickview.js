(function($) {
    "use strict";
    var HT = {};

    HT.quickView = () => {
        $(document).on('click', '.addCart', function () {
            let productId = $(this).data('id');
            $.ajax({
                url: 'ajax/product/quickview/' + productId, 
                method: 'GET',
                success: function (response) {
                    
                    HT.valueProduct(response)
                    HT.getAttributerVariant(response)

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                }
            });
        });
        $(document).on('click', '.close-popup', function () {
            $('#product-popup').fadeOut(0);
        });
    };


    HT.valueProduct = (response) => {
        if (response.product){
            let product = response.product
            let album = response.album

            $('#product-popup .product-name').text(product.name)
            $('#product-popup #sku-text').text(product.code)
            $('#product-popup .product-name').text(product.name)
            if(product.promotions != null){
                $('#product-popup .new-price').text(addCommas(product.promotions.price - product.promotions.discount) + '₫');
            }else{
                $('#product-popup .new-price').text(addCommas(product.price) + '₫');
            }

            $('#product-popup .product-description').text(product.description || '');
            $('#product-popup .ec-quickview-cart.addToCart').attr('data-id', product.id);

            let albumThumb = ''; 
            let albumCover= ''; 
            album.forEach(image => {
                albumThumb += `
                    <div class="qty-slide-thumb">
                        <img class="img-thumb" src="${image}" alt="">
                    </div>
                `;
            });
            albumCover += `
                <div class="qty-slide">
                    <img class="img-responsive" src="${album[0]}" alt="">
                </div>
            `;
            $('#product-popup .qty-nav-thumb').html(albumThumb);
            $('#product-popup .qty-product-cover').html(albumCover);
            
            $('#product-popup').fadeIn(0);
        } 
    };


    HT.getAttributerVariant = (response) => {
        if (response.attributeCatalogue) {
            let attributeCatalogue = response.attributeCatalogue;
            let template = '';

            attributeCatalogue.forEach(attributeGroup => {
                let attributeItems = '';
                attributeGroup.attributes.forEach(attribute => {
                    if (attribute.image) {
                        attributeItems += `
                            <a class="item--color" 
                                data-attributeid="${attribute.id}" 
                                title="${attribute.name}">
                                <img src="${attribute.image}" alt="${attribute.name}" class="attribute-image-round">
                            </a>
                        `;
                    } else {
                        attributeItems += `
                            <div class="item--other" 
                                    data-attributeid="${attribute.id}" 
                                    title="${attribute.name}">
                                ${attribute.name}
                            </div>
                        `;
                    }
                });
                template += `
                    <div class="ec-pro-variation">
                        <div class="ec-pro-variation-inner variant-item">
                            <label class="capitalize-star mb-2">
                                ${attributeGroup.name}:
                                <span></span>
                            </label>
                            <div class="ec-pro-variation-content attribute-value uk-flex">
                                ${attributeItems}
                            </div>
                        </div>
                    </div>
                `;
            });
            $('#attribute-container').html(template);
        }
    };


    HT.selectVariantProduct = () => {
        $(document).on('click', '.item--color, .item--other', function (e) { 
            e.preventDefault();
            let _this = $(this);
            let attribute_id = _this.attr('data-attributeid');
            let attribute_name = _this.attr('title');
            _this.addClass('active').siblings().removeClass('active'); 
            _this.closest('.variant-item').find('span').html(attribute_name); 
        });
	};


    $(document).ready(function() {
        HT.quickView()
        HT.selectVariantProduct()
    });

})(jQuery);


//copy sku
document.getElementById('copy-sku').addEventListener('click', function() {
    const skuText = document.getElementById('sku-text').innerText;
    navigator.clipboard.writeText(skuText).then(function() {
        toastr.success('Đã sao chép');
    }).catch(function(error) {
        toastr.error('Có lỗi xảy ra, vui lòng thử lại');
    });
});

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