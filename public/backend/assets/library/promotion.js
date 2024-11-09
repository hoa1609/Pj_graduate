(function($) {
    "use strict";
    var HT = {};

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
                let sourceData = [
                    { id: 1, name: 'Tiktok' },
                    { id: 2, name: 'Shopee' }
                ];
                let sourceHtml = HT.renderPromotionSource(sourceData).prop('outerHTML');
                _this.parents('.content-source').append(sourceHtml);
                HT.promotionMultipleSelect2();
            }
        });
    };

    HT.renderPromotionSource = (sourceData) => {
        let wrapper = $('<div>').addClass('source-wrapper');
        let select = $('<select>').addClass('multipleSelect2 col-12').attr('name', 'source').attr('multiple', true);

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
        let applyConditionData = [
            {
                id: 'staff_take_care_customer',
                name: 'Nhân viên phụ trách'
            },
            {
                id: 'customer_group',
                name: 'Nhóm khách hàng'
            },
            {
                id: 'customer_gender',
                name: 'Giới tính'
            },
            {
                id: 'customer_birthday',
                name: 'Ngày sinh'
            }
        ];
        let wrapper = $('<div>').addClass('apply-wrapper');
        let wrapperConditionItem = $('<div>').addClass('wrapper-condition');
        if (applyConditionData.length) {
            let select = $('<select>')
                        .addClass('multipleSelect2 conditionItem col-12')
                        .attr('name', 'applyObject')
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
        let optionData = [
            { id: 1, name: 'Khách vip' },
            { id: 2, name: 'Khách bán buôn' }
        ];

        let conditionItem = $('<div>').addClass('wrapperConditionItem mt-2 ' + value);
        let select = $('<select>')
                    .addClass('multipleSelect2 objectItem col-12')
                    .attr('name', 'customerGroup')
                    .attr('multiple', true);
        for (let i = 0; i < optionData.length; i++) {
            let option = $('<option>').attr('value', optionData[i].id).text(optionData[i].name);
            select.append(option);
        }

        let conditionLabel = HT.createConditionLabel(label, value);  // Sử dụng label ở đây
        conditionItem.append(conditionLabel);
        conditionItem.append(select);
        if ($('.wrapper-condition').find('.' + value).elExist()) {
            return;
        }
        $('.wrapper-condition').append(conditionItem);
        HT.promotionMultipleSelect2();
    };

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

    // let ranges = []
    // HT.checkbtnJs100ConflickRange = (newFrom, newTo) => {
    //     for (let i = 0; i < ranges.length; i++) {
    //         let existRange = ranges[i];
    //         if (
    //             (newFrom >= existRange.from && newFrom <= existRange.to) ||
    //             (newTo >= existRange.from && newTo <= existRange.to) ||
    //             (newFrom <= existRange.from && newTo >= existRange.to)
    //         ) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    // HT.isValiRange = (newFrom, newTo) => {
    //     if(newTo <= newFrom){
    //         return false
    //     }
    //     return true
    // }


    HT.btnJs100 = () => {
        $(document).on('click', '.btn-js-100', function() {
            // let _button = $(this)
            let trLastChild = $('.order_amount_range').find('tbody tr:last-child')
            // let newFrom = parseInt(trLastChild.find('.order_amount_range_from input').val().replace(/\./g, ''))
            let newTo = parseInt(trLastChild.find('.order_amount_range_to input').val().replace(/\./g, ''))

            // if (isNaN(newFrom) || isNaN(newTo)) {
            //     alert('Vui lòng nhập giá trị hợp lệ');
            //     return;
            // }

            // if(!HT.isValiRange(newFrom, newTo)) {
            //     alert('Khoảng điều kiện không hợp lệ, giá trị đến phải lớn hơn giá trị từ')
            //     return
            // }

            // if(HT.checkbtnJs100ConflickRange(newFrom, newTo)){
            //     trLastChild.addClass('errorLine')
            //     alert('Có xung đột giữa các khoảng điều kiện, hãy kiểm tra lại')
            //     return
            // }

            // $('.order_amount_range').find('<tr>').removeClass('errorLine')

            // ranges.push({ from: newFrom, to: newTo })
            let $tr = $('<tr>')
            let tdList = [
                {class: 'order_amount_range_from td-range', name: '', value: addCommas(parseInt(newTo) + 1)},
                {class: 'order_amount_range_to td-range', name: '', value: 0},
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
                    name: '',
                    class: 'form-control me-2',
                    placeholder: 0,
                    value: 0,
                })
            ).append(
                $('<select>',{
                    class: 'multipleSelect2'
                })
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
    }

    HT.removePromotionContainer = () => {
        $('.promotion-container').html('')
    }

    HT.renderOrderAmountRange = () => {
        let html = `
            <div class="order_amount_range">
                <div class="table-responsive">
                    <table class="table table-centered  mb-3 variantTable">
                        <thead class="table-light">
                            <tr class="border-table">
                                <th>Giá trị từ</th>
                                <th>Giá trị đến</th>
                                <th>Chiết khấu(%)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="order_amount_range_from td-range">
                                    <input
                                        type="text"
                                        name="amountFrom[]"
                                        class="form-control int"
                                        placeholder="0"
                                        value="0"
                                    >
                                </td>
                                <td class="order_amount_range_to td-range">
                                    <input
                                        type="text"
                                        name="amountTo[]"
                                        class="form-control int"
                                        placeholder="0"
                                        value="0"
                                    >
                                </td>
                                <td class="discountType">
                                    <div class="uk-flex uk-flex-middle">
                                        <input
                                            type="text"
                                            name="amountValue[]"
                                            class="form-control int me-2"
                                            placeholder="0"
                                            value="0"
                                        >
                                        <select class="multipleSelect2 disountType" name="amountType" id="">
                                            <option value="cash">đ</option>
                                            <option value="percent">%</option>
                                        </select>
                                    </div>
                                </td>
                                <td>

                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btn btn-success btn-js-100" type="button">Thêm điều kiện</button>
                </div>
            </div>
            `
        HT.renderPromotionContainer(html)

    }

    HT.renderProductAndQuantity = () => {

        let selectData = JSON.parse($('.input-product-and-quantity').val())
        let selectHtml = ''
        for(let key in selectData) {
            selectHtml += '<option value="'+key+'">'+selectData[key]+'</option>'
        }
        let html = `
        <div class="product_and_quantity mb-2">
            <div class="choose-module mb-2">
                <label class="form-label">Sản phẩm áp dụng</label>
                <select name="" id="" class="form-select multipleSelect2 select-product-and-quantity">
                    ${selectHtml}
                </select>
            </div>
            <table class="table table-centered  mb-3">
                <thead class="table-light">
                    <tr>
                        <th style="width: 300px">Sản phẩm mua</th>
                        <th style="width: 80px">Tối thiểu</th>
                        <th>Giới hạn khuyến mãi </th>
                        <th class="text-end">Chiết khấu</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="order_amount_range_from td-range">
                            <select
                                type="text"
                                name="amountFrom[]"
                                class="form-select multipleSelect2"
                                value=""
                                data-model="Product"
                                multiple
                            >
                            </select>
                        </td>
                        <td class="order_amount_range_to td-range">
                            <input
                                type="text"
                                name="amountTo[]"
                                class="form-control int"
                                value="1"
                            >
                        </td>
                        <td class="order_amount_range_to td-range">
                            <input
                                type="text"
                                name="amountTo[]"
                                class="form-control int"
                                placeholder="0"
                                value="0"
                            >
                        </td>
                        <td class="discountType">
                            <div class="uk-flex uk-flex-middle">
                                <input
                                    type="text"
                                    name="amountValue[]"
                                    class="form-control int me-2"
                                    placeholder="0"
                                    value="0"
                                >
                                <select class="multipleSelect2 disountType" name="amountType" id="">
                                    <option value="cash">đ</option>
                                    <option value="percent">%</option>
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

    // HT.setupAjaxSearch = () => {

    //     $('.ajaxSearch').each(function(){
    //         let _this = $(this)
    //         let option = {
    //             model: _this.attr('data-model')
    //         }
    //        _this.select2({
    //             minimumInputLength: 2,
    //             placeholder: 'Nhập vào 2 kí tự để tìm kiếm',
    //             closeOnSelect: true,
    //             ajax: {
    //                 url: 'ajax/dashboard/findPromotionObject',
    //                 type: 'GET',
    //                 dataType: 'json',
    //                 deley: 250,
    //                 data: function (params){
    //                     return {
    //                         search: params.term,
    //                         option: option,
    //                     }
    //                 },
    //                 processResults: function(data){
    //                     return {
    //                         results: data.items
    //                     }
    //                 },
    //                 cache: true

    //               }
    //         });
    //     })
    // }

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
        HT.setupAjaxSearch();
    });

})(jQuery);
