(function($) {
    "use strict";
    var HT = {};
    var typingTimer;
    var doneTyingInterval = 500;

    $.fn.elExist = function () {
        return this.length > 0;
    };

    HT.promotionNeverEnd = () => {
        $(document).on('change', '#neverEnd', function() {
            let _this = $(this);
            let isChecked = _this.prop('checked');
            if (isChecked) {
                $('input[name=endDate]').val('').attr('disabled', true);
            } else {
                let endDate = $('input[name=startDate]').val();
                $('input[name=endDate]').val(endDate).attr('disabled', false);
            }
        });
    };

    HT.promotionSource = () => {
        $(document).on('click', '.chooseSource', function() {
            let _this = $(this);
            let flag = (_this.attr('id') === 'allSource') ? true : false;
            if (flag) {
                _this.parents('.content-source').find('.source-wrapper').remove();
            } else {
                $.ajax({
                    url: 'ajax/source/getAllSource',
                    type: 'GET',
                    dataType: 'json',
                    success: function(res) {
                        let sourceData = res.data
                        if(!$('.source-wrapper').length){
                            let sourceHtml = HT.renderPromotionSource(sourceData).prop('outerHTML');
                            _this.parents('.content-source').append(sourceHtml);
                            HT.promotionMultipleSelect2();
                        }
                    },
                })
            }
        });
    };

    HT.renderPromotionSource = (sourceData) => {
        let wrapper = $('<div>').addClass('source-wrapper');
        let select = $('<select>').addClass('multipleSelect2 col-12').attr('name', 'sourceValue[]').attr('multiple', true);

        for (let i = 0; i < sourceData.length; i++) {
            let option = $('<option>').attr('value', sourceData[i].id).text(sourceData[i].name);
            select.append(option);
        }
        wrapper.append(select);

        return wrapper;
    };

    HT.chooseCustomerCondition = () => {
        $(document).on('change', '.chooseApply', function() {
            let _this = $(this);
            let id = _this.attr('id');
            if (id == 'allApply') {
                _this.parents('.content-apply').find('.apply-wrapper').remove();
            } else {
                let applyHtml = HT.renderApplyCondition().prop('outerHTML');
                _this.parents('.content-apply').append(applyHtml);
                HT.promotionMultipleSelect2();
            }
        });
    };

    HT.renderApplyCondition = () => {
        let applyConditionData = JSON.parse($('.applyStatusList').val())
        let wrapper = $('<div>').addClass('apply-wrapper');
        let wrapperConditionItem = $('<div>').addClass('wrapper-condition');
        if (applyConditionData.length) {
            let select = $('<select>')
                        .addClass('multipleSelect2 conditionItem col-12')
                        .attr('name', 'applyValue[]')
                        .attr('multiple', true);

            for (let i = 0; i < applyConditionData.length; i++) {
                let option = $('<option>').attr('value', applyConditionData[i].id).text(applyConditionData[i].name);
                select.append(option);
            }
            wrapper.append(select);
            wrapper.append(wrapperConditionItem);
        }
        return wrapper;
    };

    HT.chooseApplyItem = () => {
        $(document).on('change', '.conditionItem', function() {
            let _this = $(this);
            let selectedValues = _this.val() || []; // Lấy các giá trị đã chọn, hoặc mảng rỗng nếu không có
            let selectedLabels = _this.select2('data').map(data => data.text); // Lấy nhãn của các mục đã chọn

            // Lặp qua tất cả các wrapperConditionItem để kiểm tra và xóa chỉ các phần không liên quan
            $('.wrapperConditionItem').each(function() {
                let wrapper = $(this);
                let wrapperClass = wrapper.attr('class').split(' ')[2]; // Lớp điều kiện

                // Nếu wrapperClass không nằm trong selectedValues thì xóa nó
                if (!selectedValues.includes(wrapperClass)) {
                    wrapper.remove();
                }
            });

            // Thêm các mục mới từ danh sách các giá trị đã chọn
            for (let i = 0; i < selectedValues.length; i++) {
                let value = selectedValues[i]; // lấy giá trị
                let label = selectedLabels[i] ? selectedLabels[i] : ''; // lấy label tương ứng
                // Chỉ tạo mục nếu chưa tồn tại
                if (!$('.wrapper-condition').find('.' + value).elExist()) {
                    HT.createConditionItem(value, label);
                }
            }
        });
    };

    // HT.chooseApplyItem = () => {
    //     $(document).on('change', 'conditionItem', function(){
    //         let _this = $(this)
    //         let condition = {
    //             value: _this.val(),
    //             label: _this.select2('data')
    //         }
    //         $('.wrapperConditionItem').each(function(){
    //             let _item = $(this)
    //             let itemClass = _item.attr('class').split('') [2]
    //             if(condition.value.includes(itemClass) == false){
    //                 _item.remove()
    //             }
    //         })
    //         for(let i=0; i < condition.value.length; i++){
    //             let value = condition.value[i]
    //             let html = HT.createConditionItem (value, condition.label[i].text)
    //         }
    //     })
    // }

    HT.createConditionLabel = (label, value) => {
        let deleteButton = $('<div>').addClass('btn btn-danger fa fa-trash rounded').attr('data-condition-item', value);
        let conditionLabel = $('<div>').addClass('conditionLabel').text(label);
        let flex = $('<div>').addClass('uk-flex uk-flex-middle uk-flex-space-between');
        let wrapperBox = $('<div>').addClass('mb-2');
        flex.append(conditionLabel).append(deleteButton);
        wrapperBox.append(flex);

        return wrapperBox.prop('outerHTML');
    };

    HT.createConditionItem = (value, label) => {
        if (!$('.wrapper-condition').find('.' + value).elExist()) {
            $.ajax({
                url: 'ajax/dashboard/getPromotionConditionValue',
                type: 'GET',
                data: {
                    value: value
                },
                dataType: 'json',
                success: function(res) {
                    let optionData = res.data
                    let conditionItem = $('<div>').addClass('wrapperConditionItem mt-2 ' + value)
                    let conditionHiddenInput = $('.condition_input_' + value)
                    let conditionHiddenInputValue = []
                    if(conditionHiddenInput.length) {
                        conditionHiddenInputValue = JSON.parse(conditionHiddenInput.val())
                    }
                    let select = $('<select>')
                                .addClass('multipleSelect2 objectItem col-12')
                                .attr('name', value + "[]")
                                .attr('multiple', true)
                    for (let i = 0; i < optionData.length; i++) {
                        let option = $('<option>').attr('value', optionData[i].id).text(optionData[i].text)
                        select.append(option)
                    }
                    select.val(conditionHiddenInputValue).trigger('change')
                    let conditionLabel = HT.createConditionLabel(label, value);  // Sử dụng label ở đây
                    conditionItem.append(conditionLabel)
                    conditionItem.append(select)
                    if ($('.wrapper-condition').find('.' + value).elExist()) {
                        return;
                    }
                    $('.wrapper-condition').append(conditionItem)
                    HT.promotionMultipleSelect2()
                },
            })
        }
    }

    HT.deleteCondition = () => {
        $(document).on('click', '.btn-danger.fa-trash', function() {
            let _this = $(this);
            let conditionItemValue = _this.attr('data-condition-item'); // Lấy giá trị điều kiện cần xóa
            let conditionWrapper = _this.closest('.wrapperConditionItem'); // Tìm phần tử chứa điều kiện cần xóa

            // Xóa phần tử điều kiện khỏi DOM
            conditionWrapper.remove();

            // Lấy danh sách các giá trị đã chọn trong conditionItem
            let selectedItems = $('.conditionItem').val() || [];

            // Tìm vị trí của conditionItemValue trong danh sách các giá trị đã chọn
            let index = selectedItems.indexOf(conditionItemValue);

            // Nếu giá trị tồn tại trong danh sách đã chọn, xóa nó
            if (index !== -1) {
                selectedItems.splice(index, 1); // Xóa giá trị từ danh sách
                $('.conditionItem').val(selectedItems).trigger('change'); // Cập nhật lại select2 với danh sách mới
            }
        });
    };

    HT.promotionMultipleSelect2 = () => {
        $('.multipleSelect2').select2({
            placeholder: 'Click vào ô để lựa chọn',
        });
    };

    HT.btnJs100 = () => {
        $(document).on('click', '.btn-js-100', function() {
            let trLastChild = $('.order_amount_range').find('tbody tr:last-child')
            let newTo = parseInt(trLastChild.find('.order_amount_range_to input').val().replace(/\./g, ''))
            let $tr = $('<tr>')
            let tdList = [
                {class: 'order_amount_range_from td-range', name: 'promotion_order_amount_range[amountFrom][]', value: addCommas(parseInt(newTo) + 1)},
                {class: 'order_amount_range_to td-range', name: 'promotion_order_amount_range[amountTo][]', value: 0},
            ]
            for(let i = 0; i < tdList.length; i++){
                let $td = $('<td>', {class: tdList[i].class })
                let $input = $('<input>')
                    .addClass('form-control int')
                    .attr('type', 'text')
                    .attr('name', tdList[i].name)
                    .attr('placeholder', '0')
                    .val(tdList[i].value)
                    $td.append($input);
                    $tr.append($td)
            }

            let $discountId = $('<td>').addClass('discountType')
            $discountId.append(
                $('<div>', { class: 'uk-flex uk-flex-middle'}).append(
                $('<input>',{
                    type: 'text',
                    name: 'promotion_order_amount_range[amountType][]',
                    class: 'form-control me-2',
                    placeholder: 0,
                    value: 0,
                })
            ).append(
                $('<select>',{
                    class: 'multipleSelect2'
                })
                .attr('name', 'promotion_order_amount_range[amountType]')
                .append( $('<option>', {value: 'cash', text: 'đ'}))
                .append( $('<option>', {value: 'percent', text: '%'}))
            )
            )

            $tr.append($discountId)
            let deleteButtonDiscount = $('<td>').append(
                $('<div>', {
                    class: 'delete-order-amount-range-condition'
                }).append($('<i>', {
                    class: 'btn btn-danger fa fa-trash rounded'
                }))
            )
            $tr.append(deleteButtonDiscount)

            $('.order_amount_range table tbody').append($tr)
            HT.promotionMultipleSelect2()
        })
    }

    HT.deleteAmountRangeCondition = () => {
        $(document).on('click', '.delete-order-amount-range-condition', function() {
            let _this = $(this)
            _this.parents('tr').remove()
        })
    }

    HT.renderOrderRangeConditionContainer = () => {
        $(document).on('change', '.promotionMethod', function() {
            let _this = $(this)
            let option = _this.val()
            switch (option) {
                case "order_amount_range":
                    HT.renderOrderAmountRange()
                    break;
                case "product_and_quantity":
                    HT.renderProductAndQuantity()
                    break;
                // case "product_quantity_range":

                //     break;
                // case "goods_discount_by_quantity":

                //     break;

                default:
                    HT.removePromotionContainer()
                    break;
            }
        })
        let method = $('.preload_promotionMethod').val()
        if(method.length && typeof method !== 'undefined'){
            $('.promotionMethod').val(method).trigger('change')
        }
    }

    HT.removePromotionContainer = () => {
        $('.promotion-container').html('')
    }

    // HT.renderOrderAmountRange = () => {
    //     let $tr = ''
    //     let order_amount_range = JSON.parse($('.input_order_amount_range').val()) || {
    //         amountFrom: ['0'],
    //         amountTo: ['0'],
    //         amountValue: ['0'],
    //         amountType: ['cash'],
    //     }
    //     for(let i = 0; i < order_amount_range.amountFrom.length; i++ ){
    //         let $amountFrom = order_amount_range.amountFrom[i]
    //         let $amountTo = order_amount_range.amountTo[i]
    //         let $amountValue = order_amount_range.amountValue[i]
    //         let $amountType = order_amount_range.amountType[i]

    //         $tr +=`<tr>
    //         <td class="order_amount_range_from td-range">
    //             <input
    //                 type="text"
    //                 name="promotion_order_amount_range[amountFrom][]"
    //                 class="form-control int"
    //                 placeholder="0"
    //                 value="${$amountFrom}"
    //             >
    //         </td>
    //         <td class="order_amount_range_to td-range">
    //             <input
    //                 type="text"
    //                 name="promotion_order_amount_range[amountTo][]"
    //                 class="form-control int"
    //                 placeholder="0"
    //                 value="${$amountTo}"
    //             >
    //         </td>
    //         <td class="discountType">
    //             <div class="uk-flex uk-flex-middle">
    //                 <input
    //                     type="text"
    //                     name="promotion_order_amount_range[amountValue][]"
    //                     class="form-control int me-2"
    //                     placeholder="0"
    //                     value="${$amountValue}"
    //                 >
    //                 <select class="multipleSelect2 disountType" name="promotion_order_amount_range[amountType][]" id="">
    //                     <option value="cash" ${ ($amountType == 'cash') ? 'selected' : '' }>đ</option>
    //                     <option value="percent" ${ ($amountType == 'percent') ? 'selected' : '' }>%</option>
    //                 </select>
    //             </div>
    //         </td>
    //         <td>

    //         </td>
    //     </tr>`
    //     }
    //     let html = `
    //         <div class="order_amount_range">
    //             <div class="table-responsive">
    //                 <table class="table table-centered  mb-3 variantTable">
    //                     <thead class="table-light">
    //                         <tr class="border-table">
    //                             <th>Giá trị từ</th>
    //                             <th>Giá trị đến</th>
    //                             <th>Chiết khấu(%)</th>
    //                             <th></th>
    //                         </tr>
    //                     </thead>
    //                     <tbody>
    //                         ${$tr}
    //                     </tbody>
    //                 </table>
    //                 <button class="btn btn-success btn-js-100" type="button">Thêm điều kiện</button>
    //             </div>
    //         </div>
    //         `
    //     HT.renderPromotionContainer(html)

    // }
    HT.renderOrderAmountRange = () => {
        let $tr = '';
        // Kiểm tra nếu `.input_order_amount_range` không có giá trị hợp lệ thì đặt giá trị mặc định
        let order_amount_range = JSON.parse($('.input_order_amount_range').val() || '{}') || {
            amountFrom: ['0'],
            amountTo: ['0'],
            amountValue: ['0'],
            amountType: ['cash'],
        }

        // Nếu `order_amount_range` không có đủ thuộc tính cần thiết, bổ sung giá trị mặc định
        order_amount_range.amountFrom = order_amount_range.amountFrom || ['0']
        order_amount_range.amountTo = order_amount_range.amountTo || ['0']
        order_amount_range.amountValue = order_amount_range.amountValue || ['0']
        order_amount_range.amountType = order_amount_range.amountType || ['cash']

        for (let i = 0; i < order_amount_range.amountFrom.length; i++) {
            let $amountFrom = order_amount_range.amountFrom[i]
            let $amountTo = order_amount_range.amountTo[i]
            let $amountValue = order_amount_range.amountValue[i]
            let $amountType = order_amount_range.amountType[i]

            $tr += `<tr>
                <td class="order_amount_range_from td-range">
                    <input
                        type="text"
                        name="promotion_order_amount_range[amountFrom][]"
                        class="form-control int"
                        placeholder="0"
                        value="${$amountFrom}"
                    >
                </td>
                <td class="order_amount_range_to td-range">
                    <input
                        type="text"
                        name="promotion_order_amount_range[amountTo][]"
                        class="form-control int"
                        placeholder="0"
                        value="${$amountTo}"
                    >
                </td>
                <td class="discountType">
                    <div class="uk-flex uk-flex-middle">
                        <input
                            type="text"
                            name="promotion_order_amount_range[amountValue][]"
                            class="form-control int me-2"
                            placeholder="0"
                            value="${$amountValue}"
                        >
                        <select class="multipleSelect2 disountType" name="promotion_order_amount_range[amountType][]" id="">
                            <option value="cash" ${($amountType == 'cash') ? 'selected' : ''}>đ</option>
                            <option value="percent" ${($amountType == 'percent') ? 'selected' : ''}>%</option>
                        </select>
                    </div>
                </td>
                <td></td>
            </tr>`
        }

        let html = `
            <div class="order_amount_range">
                <div class="table-responsive">
                    <table class="table table-centered mb-3 variantTable">
                        <thead class="table-light">
                            <tr class="border-table">
                                <th>Giá trị từ</th>
                                <th>Giá trị đến</th>
                                <th>Chiết khấu(%)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            ${$tr}
                        </tbody>
                    </table>
                    <button class="btn btn-success btn-js-100" type="button">Thêm điều kiện</button>
                </div>
            </div>`

        HT.renderPromotionContainer(html)
    }


    HT.renderProductAndQuantity = () => {

        let selectData = JSON.parse($('.input-product-and-quantity').val())
        let selectHtml = ''
        let moduleType = $('.preload_select-product-and-quantity').val()
        for(let key in selectData) {
            selectHtml +=
            '<option '+ ((moduleType.length && typeof moduleType !==
                'undefined' && moduleType == key) ? 'selected' : '') +' value="'+key+'">'+selectData[key]+
            '</option>'
        }


        let preloadData = JSON.parse($('.input_product_and_quantity').val()) || {
            quantity: ['1'],
            maxDiscountValue: ['0'],
            discountValue: ['0'],
            discountType: ['cash'],
        }
        let html = `
        <div class="product_and_quantity mb-2">
            <div class="choose-module mb-2">
                <label class="form-label">Sản phẩm áp dụng</label>
                <select name="module_type" id="" class="form-select multipleSelect2 select-product-and-quantity">
                    ${selectHtml}
                </select>
            </div>
            <table class="table table-centered  mb-3">
                <thead class="table-light">
                    <tr>
                        <th style="width: 400px">Sản phẩm mua</th>
                        <th style="width: 80px">Tối thiểu</th>
                        <th>Giới hạn KM </th>
                        <th class="text-end">Chiết khấu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="chooseProductPromotionTd">
                            <div class="product-quantity" data-bs-toggle="modal" data-bs-target="#findProduct">
                                <div class="boxWrapper">
                                    <div class="boxSearchIcon pe-2">
                                        <i class="iconoir-search"></i>
                                    </div>
                                    <div class="boxSearchInput fixGrid6">
                                        <p>Tìm kiếm sản phẩm...</p>
                                    </div>
                                </div>
                            </div>

                        </td>
                        <td class="order_amount_range_to td-range">
                            <input type="text" name="product_and_quantity[quantity]" class="form-control int"
                                value="${preloadData.quantity}">
                        </td>
                        <td class="order_amount_range_to td-range">
                            <input type="text" name="product_and_quantity[maxDiscountValue]" class="form-control int"
                                placeholder="0" value="${preloadData.maxDiscountValue}">
                        </td>
                        <td class="discountType">
                            <div class="uk-flex uk-flex-middle">
                                <input type="text" name="product_and_quantity[discountValue]"
                                    class="form-control int me-2" placeholder="0"
                                    value="${preloadData.discountValue}">
                                <select class="multipleSelect2 disountType" name="product_and_quantity[discountType]"
                                    id="">
                                    <option value="cash" ${(preloadData.discountType == 'cash') ? 'selected' : ''}>đ</option>
                            <option value="percent" ${(preloadData.discountType == 'percent') ? 'selected' : ''}>%</option>
                                </select>
                            </div>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>`
        HT.renderPromotionContainer(html)
    }

    HT.renderPromotionContainer = (html) => {
        $('.promotion-container').html(html)
        HT.promotionMultipleSelect2();
    }

    HT.loadProduct = (option) => {
        $.ajax({
            url: 'ajax/product/loadProductPromotion',
            type: 'GET',
            data: option,
            dataType: 'json',
            success: function(res) {
                HT.fillToObjectList(res)
            },
        })
    }

    HT.getPaginationMenu = () => {
        $(document).on('click', '.page-link', function(e) {
            e.preventDefault();
            let _this = $(this);
            let option = {
                model: $('.select-product-and-quantity').val(),
                page: _this.text(),
                keyword: $('.search-model').val()
            };
            HT.loadProduct(option);
        });
    }


    HT.productQuantityListProduct = () => {
        $(document).on('click', '.product-quantity', function(e) {
            e.preventDefault()
            let option = {
                model: $('.select-product-and-quantity').val(),
            }
            HT.loadProduct(option)
        })
    }

    HT.fillToObjectList = (data) => {
        switch (data.model) {
            case "Product":
                HT.fillProductToList(data.objects)
                break;
            case "ProductCatalogue":
                HT.fillProducCataloguetToList(data.objects)
                break;
        }
    }

    HT.fillProducCataloguetToList = (object) => {
        let html = ''
        if(object.data.length) {
            let model = $('.select-product-and-quantity').val()
            for(let i = 0; i < object.data.length; i++) {
                let name = object.data[i].name
                let id = object.data[i].id
                let classBox = model + '_' + id
                let isChecked = ($('.boxWrapper .'+classBox+'').length) ? true : false

                html += `
                <div class="search-object-item" data-productid="${id}" data-name="${name}">
                <div class="d-flex align-items-center mb-3" >
                    <input
                        type="checkbox"
                        class="form-check-input me-2"
                        value="${id}"
                        ${ (isChecked) ? 'checked' : ''}
                    >
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">${name}</span>
                        </div>
                    </div>
                </div>
                </div>
                <div class="hr-custom"></div>`

            }
        }
        html += HT.paginationLinks(object.links).html();
        $('.product-list').html(html);
    }

    HT.fillProductToList = (object) => {
        let html = ''
        if(object.data.length) {
            let model = $('.select-product-and-quantity').val()
            for(let i = 0; i < object.data.length; i++) {
                let image = object.data[i].image
                let name = object.data[i].variant_name
                let product_variant_id = object.data[i].product_variant_id
                let product_id = object.data[i].id
                let sku = object.data[i].sku
                let price = object.data[i].price
                let inventory = (typeof object.data.inventory != 'undefined') ? inventory : 0
                let couldSell = (typeof object.data.couldSell != 'undefined') ? couldSell : 0
                let classBox = model + '_' + product_id + '_' + product_variant_id
                let isChecked = ($('.boxWrapper .'+classBox+'').length) ? true : false

                html += `
                <div class="search-object-item" data-productid="${product_id}"
                data-variant_id="${product_variant_id}" data-name="${name}">
                <div class="d-flex align-items-center mb-3" >
                    <input
                        type="checkbox"
                        class="form-check-input me-2"
                        value="${product_id+'_'+product_variant_id}"
                        ${ (isChecked) ? 'checked' : ''}
                    >
                    <img src="${image}" alt="${name}" class="img-thumbnail me-3" style="width: 50px; height: 50px;">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">${name}</span>
                            <span class="text-danger fs-5">${addCommas(price)} ₫</span>
                        </div>

                        <div class="d-flex justify-content-between text-muted pt-1">
                            <div class="d-flex">
                                <span>Mã sản phẩm: </span>
                                <span class="code-product text-primary ms-1">${sku}</span>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex">
                                    <span>Tồn kho: </span>
                                    <span class="stock-number text-primary ms-1">${inventory}</span>
                                </div>
                                <span class="mx-2">|</span>
                                <div class="d-flex">
                                    <span>Có thể bán: </span>
                                    <span class="available-for-sale text-primary ms-1">${couldSell}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="hr-custom"></div>`

            }
        }
        html += HT.paginationLinks(object.links).html();
        $('.product-list').html(html);
    }


    HT.paginationLinks = (links) => {
        let nav = $('<nav>');
        if (links.length > 0) {
            let paginationUl = $('<ul>').addClass('pagination');

            $.each(links, function(index, link) {
                let liClass = 'page-item';

                if (link.active) {
                    liClass += ' active d-none';
                } else if (!link.url) {
                    liClass += ' d-none';
                }

                let li = $('<li>').addClass(liClass);

                if (link.label == 'pagination.previous') {
                    let span = $('<span>').addClass('page-link').attr('aria-hidden', true).html('<');
                    li.append(span);
                } else if (link.label == 'pagination.next') {
                    let span = $('<span>').addClass('page-link').attr('aria-hidden', true).html('>');
                    li.append(span);
                } else if (link.url) {
                    let a = $('<a>')
                        .addClass('page-link')
                        .html(link.label)
                        .attr('href', link.url)
                        .attr('data-page', link.label);
                    li.append(a);
                }

                paginationUl.append(li);
            });

            nav.append(paginationUl);
        }

        return nav;
    };

    HT.searchObject = () => {
        $(document).on('keyup', '.search-model',function(e){
            let _this = $(this)
            let keyword = _this.val()
            let option = {
                model: $('.select-product-and-quantity').val(),
                keyword: keyword

            }
            clearTimeout(typingTimer);
            typingTimer = setTimeout(function(){
                HT.loadProduct (option)

                } , doneTyingInterval)
            })
    }

    var objectChoose = []
    HT.chooseProductPromotion = () => {
        $(document).on('click', '.search-object-item', function(e) {
            e.preventDefault()
            let _this = $(this)
            let isChecked = _this.find('input[type=checkbox]').prop('checked')
            let objectItem = {
                product_id: _this.attr('data-productid'),
                product_variant_id: _this.attr('data-variant_id'),
                name: _this.attr('data-name')
            }

            if(isChecked){
                objectChoose = objectChoose.filter(item => item.product_id !== objectItem.product_id)
                _this.find('input[type=checkbox]').prop('checked', false)
            }else {
                objectChoose.push(objectItem)
                _this.find('input[type=checkbox]').prop('checked', true)
            }
        })
    }

    HT.confirmProductPromotion = () => {
        $(document).on('click', '.confirm-product-promotion', function(){
            let html = ''
            let model = $('.select-product-and-quantity').val()
            if(objectChoose.length){
                for(let i = 0; i < objectChoose.length; i++){
                    let product_id = objectChoose[i].product_id
                    let product_variant_id = objectChoose[i].product_variant_id
                    let name = objectChoose[i].name
                    let classBox = model + '_' + product_id + '_' + product_variant_id
                    if(!$(`.boxWrapper .${classBox}`).length) {
                        html += `
                        <div class="fixGrid6 ${classBox}">
                            <div class="goods-item ">
                                <span class="goods-item-name" title="${name}">${name}</span>
                                <button class="delete-goods-item">
                                    <i class="fas fa-times"></i>
                                </button>
                                <div class="hidden">
                                    <input name="object[id][]" value="${product_id}">
                                    <input name="object[product_variant_id][]" value="${product_variant_id}">
                                </div>
                            </div>
                        </div>
                        `
                    }

                }
            }
            HT.checkFixGrid(html)
        })
    }

    HT.checkFixGrid = (html) => {
        if($('.fixGrid6').elExist){
            $('.boxSearchIcon').remove()
            $('.boxWrapper').prepend(html)
        }else {
           $('.fixGrid6').remove()
           $('.boxWrapper').prepend(HT.boxSearchIcon())
        }
    }

    HT.boxSearchIcon = () => {
        return ` <div class="boxSearchIcon pe-2">
                <i class="iconoir-search"></i>
            </div>`
    }

// ---------------BUG Ở ĐÂY NÈ------------

    HT.changePromotionMethod = () => {
        $(document).on('change', '.select-product-and-quantity', function(){
            $('.fixGrid6').remove()
            objectChoose = []
        })
    }

    // HT.deleteGoodsItem = () => {
    //     $(document).on('click', '.delete-goods-item', function(e){
    //         e.stopPropagation()
    //         let _button = $(this)
    //         _button.parents('.fixGrid6').remove()
    //     })
    // }

    HT.deleteGoodsItem = () => {
        $(document).on('click', '.delete-goods-item', function(e) {
            e.preventDefault();
            e.stopPropagation();

            let _button = $(this);
            let product_id = _button.siblings('.hidden').find('input[name="object[id][]"]').val();
            let product_variant_id = _button.siblings('.hidden').find('input[name="object[product_variant_id][]"]').val();
            objectChoose = objectChoose.filter(item =>
                item.product_id !== product_id || item.product_variant_id !== product_variant_id
            );
            _button.parents('.fixGrid6').remove();
            $(`.search-object-item[data-productid="${product_id}"][data-variant_id="${product_variant_id}"] input[type=checkbox]`).prop('checked', false);
        });
    }

    // ------------END BUG NÈ------------------


    HT.checkConditionItemSet = () => {
        let checkedValue = $('.conditionItemSelected').val()
        if(checkedValue.length && $('.conditionItem').length){
            checkedValue = JSON.parse(checkedValue)
            console.log(checkedValue)
            $('.conditionItem').val(checkedValue).trigger('change')
        }
    }


    $(document).ready(function() {
        HT.promotionNeverEnd();
        HT.promotionSource();
        HT.promotionMultipleSelect2();
        HT.chooseCustomerCondition();
        HT.chooseApplyItem();
        HT.deleteCondition();
        HT.btnJs100();
        HT.deleteAmountRangeCondition();
        HT.renderOrderRangeConditionContainer();
        HT.productQuantityListProduct();
        HT.getPaginationMenu();
        HT.searchObject();
        HT.chooseProductPromotion();
        HT.confirmProductPromotion();
        HT.deleteGoodsItem();
        HT.changePromotionMethod();
        HT.checkConditionItemSet();
    });

})(jQuery);
