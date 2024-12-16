(function($){
    "use strict";

    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');

    HT.select2 = ()=>{
        $('.setUpSelect2').select2();
    }

    HT.loadCity = (province_id) => {
        if(province_id != ''){
            $(".provinces").val(province_id).trigger('change');
        }
    }

    HT.editOrder = () => {
        $(document).on('click', '.edit-order', function(){
            let _this = $(this)
            let target = _this.attr('data-target')
            let html = ''

            let originalHtml = _this.parents('.ibox').find('.ibox-content').html()

            if(target === 'description') {
                html = HT.renderDescriptionOrder(_this)
            }else if(target == 'customerInfo'){
                html = HT.renderCustomerOrderInfomation()
                setTimeout(() => {
                    HT.select2()
                }, 0)
            }
            _this.parents('.ibox').find('.ibox-content').html(html)
            HT.changEditToCancle(_this, originalHtml)
        })
    }

    HT.changEditToCancle = (_this, originalHtml) => {
        let encodeHtml = btoa(encodeURIComponent(originalHtml.trim()))

        let originalButtonHtml = _this.html()
        _this.attr('data-original-button', originalButtonHtml)
        _this.html('<i class="fas fa-times me-1"></i> Hủy bỏ')
            .removeClass('edit-order')
            .addClass('cancle-edit')
            .attr('data-html', encodeHtml)
    }

    HT.cancleEdit = () => {
        $(document).on('click', '.cancle-edit', function(){
            let _this = $(this);
            let originalHtml = decodeURIComponent(atob(_this.attr('data-html')))
            let originalButtonHtml = _this.attr('data-original-button')
            _this.html(originalButtonHtml)
                .removeClass('cancle-edit')
                .addClass('edit-order')
            _this.parents('.ibox').find('.ibox-content').html(originalHtml)
        })
    }

    HT.renderCustomerOrderInfomation = () => {


        let data = {
            fullname: $('.fullname').text(),
            email: $('.email').text(),
            phone: $('.phone').text(),
            address: $('.address').text(),
            ward_id: $('.ward_id').val(),
            district_id: $('.district_id').val(),
            province_id: $('.province_id').val(),
        }

        let html = `
            <div class="row">
                <div class="col-md-12 position-relative mb-2">
                    <label class="form-label"> Họ tên</label>
                    <input type="text" class="form-control" name="fullname" value="${data.fullname}">
                </div>

                <div class="col-md-12 position-relative mb-2">
                    <label class="form-label"> Email </label>
                    <input type="text" class="form-control" name="email" value="${data.email}">
                </div>

                 <div class="col-md-12 position-relative mb-2">
                    <label class="form-label"> Số điện thoại </label>
                    <input type="text" class="form-control" name="phone" value="${data.phone}">
                </div>

                 <div class="col-md-12 position-relative mb-2">
                    <label class="form-label"> Địa chỉ </label>
                    <input type="text" class="form-control" name="address" value="${data.address}">
                </div>

                 <div class="col-md-12 position-relative mb-2">
                    <label class="form-label"> Thành Phố/Tỉnh </label>
                    <select name="province_id" class="setUpSelect2 provinces location"
                    data-target="districts">
                        <option>[Chọn Thành Phố/Tỉnh]</option>
                        ${HT.provincesList(data.province_id)}
                    </select>
                </div>

                <div class="col-md-12 position-relative mb-2">
                    <label class="form-label"> Quận Huyện </label>
                    <select name="district_id" class="setUpSelect2 districts location"
                    data-target="wards">
                        <option>[Chọn Quận/Huyện]</option>
                    </select>
                </div>

                <div class="col-md-12 position-relative mb-2">
                    <label class="form-label"> Phường Xã </label>
                    <select name="ward_id" class="setUpSelect2 wards ">
                        <option>[Chọn Phường/Xã]</option>
                    </select>
                </div>

                 <div class="col-md-12 position-relative mt-1 text-end">
                    <button class="btn btn-primary saveCustomer">Lưu</button>
                </div>
            </div>

        `
        setTimeout(() => {
            HT.loadCity(data.province_id)
        }, 0)

        return html
    }

    HT.provincesList = () => {
        let html = ''
        for(let i = 0; i < provinces.length; i++){
            html += '<option value="'+provinces[i].id+'">'+ provinces[i].name+'</option>'
        }
        return html

    }

    HT.renderDescriptionOrder = (_this) => {
        let inputValue = _this.parents('.ibox').find('.description-content').text().trim()
        return '<input class="form-control ajax-edit" name="description" data-field="description" value="'+inputValue+'">'
    }


    HT.updateDescription = () => {
        $(document).on('change', '.ajax-edit', function(){
            let _this = $(this)
            let field = _this.attr('data-field')
            let value = _this.val()
            let option = {
                id: $('.orderId').val(),
                payload: {
                    [field]:value
                },
                _token: _token
            }
            HT.ajaxUpdateOrderInfo(option, _this)
        })
    }

    HT.getLocation = () => {
        $(document).on('change', '.location', function(){
            let _this = $(this)
            let option = {
                'data' : {
                    'location_id' : _this.val(),
                },
                'target' : _this.attr('data-target')
            }

            HT.sendDataTogetLocation(option)

        })
    }

    HT.sendDataTogetLocation = (option) => {
        let district_id = $('.district_id').val()
        let ward_id = $('.ward_id').val()
        $.ajax({
            url: 'ajax/location/getLocation',
            type: 'GET',
            data: option,
            dataType: 'json',
            success: function(res) {

               $('.'+option.target).html(res.html)

                if(district_id != '' && option.target == 'districts'){
                    $('.districts').val(district_id).trigger('change')
                }

                if(ward_id != '' && option.target == 'wards'){
                    $('.wards').val(ward_id).trigger('change')
                }

            },

        });
    }

    HT.ajaxUpdateOrderInfo = (option, _this) => {
        $.ajax({
            url: 'ajax/order/update',
            type: 'POST',
            data: option,
            dataType: 'json',
            success: function(res) {
                if(res.error == 10){
                    if(_this.parents('.ibox').find('.cancle-edit').attr('data-target') == 'description') {
                        HT.updateDescriptionHtml(option.payload, _this.parents('.ibox'))
                    }else if(_this.parents('.ibox').find('.cancle-edit').attr
                    ('data-target') == 'customerInfo'){
                        HT.renderCustomerInfoHtml(res)
                    }
                }
            },
        })
    }

    HT.renderCustomerInfoHtml = (res) => {
        let html = `
            <div class="d-flex justify-content-between mb-2">
                <p class="text-body fw-semibold"><i class="iconoir-people-tag text-secondary fs-20 align-middle me-1"></i>Họ và tên :</p>
                <p class="text-body-emphasis fw-semibold">
                    <span class="fullname">${res.order.fullname}</span>
                </p>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <p class="text-body fw-semibold"><i class="iconoir-mail text-secondary fs-20 align-middle me-1"></i>Email :</p>
                <p class="text-body-emphasis fw-semibold">
                    <span class="email">${res.order.email}</span>
                </p>
            </div>
            <div class="d-flex justify-content-between mb-2">
                <p class="text-body fw-semibold"><i class="las la-phone-volume text-secondary fs-20 align-middle me-1"></i>Số điện thoại :</p>
                <p class="text-body-emphasis fw-semibold">
                    <span class="phone text-primary">${res.order.phone}</span>
                </p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="text-body fw-semibold"><i class="iconoir-map-pin text-secondary fs-20 align-middle me-1"></i>Địa chỉ :</p>
                <p class="text-body-emphasis fw-semibold">
                    <span class="address"> ${res.order.address}</span>
                    ${res.order.ward_name}<br>

                    ${res.order.district_name}

                    ${res.order.province_name}
                </p>
            </div>
        `
        $('.order-customer-information').html(html)
        $('.ward_id').val(res.order.ward_id)
        $('.district_id').val(res.order.district_id)
        $('.province_id').val(res.order.province_id)

        let editBtn = $('.cancle-edit')
        let originalButtonHtml = '<i class="fas fa-pen me-1"></i> Sửa'
        editBtn.html(originalButtonHtml)
            .removeClass('cancle-edit')
            .addClass('edit-order')
            .attr('data-html', '')

    }

    HT.updateDescriptionHtml = (payload, target) => {
        let updatedHtml = `
            <span class="text-primary fw-semibold">Ghi chú :</span>
            <span class="text-primary fw-normal description-content"> ${payload.description || 'Không có ghi chú!'}</span>
        `;
        target.find('.ibox-content').html(updatedHtml)
        let editBtn = target.find('.cancle-edit')
        let originalButtonHtml = '<i class="fas fa-pen me-1"></i> Sửa'
        editBtn.html(originalButtonHtml)
            .removeClass('cancle-edit')
            .addClass('edit-order')
            .attr('data-html', '')
    }


    HT.saveCustomer = () => {
        $(document).on('click', '.saveCustomer', function(){
            let _this = $(this)
            let option = {
                id: $('.orderId').val(),
                payload: {
                    fullname: $('input[name=fullname]').val(),
                    email: $('input[name=email]').val(),
                    phone: $('input[name=phone]').val(),
                    address: $('input[name=address]').val(),
                    ward_id: $('.wards').val(),
                    district_id: $('.districts').val(),
                    province_id: $('.provinces').val(),
                },
                _token: _token
            }

            HT.ajaxUpdateOrderInfo(option, _this)
        })
    }

    HT.updateField = () => {
        $(document).on('click', '.updateField', function() {
            let _this = $(this)
            let option = {
                payload: {
                    [_this.attr('data-field')] : _this.attr('data-value')
                },
                id: $('.orderId').val(),
                _token: _token
            }
            $.ajax({
                url: 'ajax/order/update',
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function(res) {
                    if(res.error == 10) {
                        if(_this.attr('data-value') == 'cancle') {
                            $('.cancle-block').html('Đã hủy đơn hàng');
                        } else {
                            HT.createOrderConfirmSelection(_this);
                        }
                        toastr.success('Cập nhật trạng thái thành công');
                    }
                },
                error: function(err) {
                    toastr.error('Có lỗi xảy ra!');
                }
            })
        })
    }

    HT.updateBadge = () => {
        toastr.options = {
            "positionClass": "toast-top-right",
            "closeButton": true,
            "progressBar": true,
            "timeOut": "3000",
            "extendedTimeOut": "1000"
        }

        $(document).on('change', '.setUpSelect2', function() {
            let _this = $(this)
            let option = {
                payload: {
                    [_this.attr('data-field')] : _this.val()
                },
                id: _this.closest('tr').find('.checkBoxItem').val(),
                _token: _token
            }

            let confirmStatus = _this.parents('tr').find('.confirm').val()
            if(confirmStatus != 'pending'){
                $.ajax({
                    url: 'ajax/order/update',
                    type: 'POST',
                    data: option,
                    dataType: 'json',
                    success: function(res) {
                        if(res.error == 10){
                            toastr.success('Cập nhật trạng thái thành công');
                        } else {
                            toastr.error('Có vấn đề xảy ra! Hãy thử lại');
                        }
                    },
                    error: function(err) {
                        // console.log('Error:', err);
                        // toastr.error('Có lỗi xảy ra!');
                    }
                })
            } else {
                toastr.warning('Bạn cần xác nhận đơn hàng trước khi thực hiện cập nhật này!');
            }
        })
    }

    HT.createOrderConfirmSelection = (_this) => {
        let confirmedHTML = `
            <div class="position-relative m-4">
                <div class="progress" role="progressbar" aria-label="Progress" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="height: 1px;">
                  <div class="progress-bar" style="width: 50%"></div>
                </div>
                <div class="position-absolute top-0 start-0 translate-middle bg-primary text-white rounded-pill thumb-md"><i class="iconoir-home"></i></div>
                <div class="position-absolute top-0 start-50 translate-middle bg-primary text-white rounded-pill thumb-md"><i class="fas fa-check"></i></div>
                <div class="position-absolute top-0 start-100 translate-middle bg-primary-subtle text-primary rounded-pill thumb-md"><i class="iconoir-delivery-truck"></i></div>
            </div>
            <div class="row row-cols-3">
                <div class="col text-start">
                    <h6 class="mb-1">Đã tạo đơn hàng</h6>
                </div>
                <div class="col text-center">
                    <h6 class="mb-1">Đã xác nhận</h6>
                </div>
                <div class="col text-end">
                    <h6 class="mb-1">Chờ vận chuyển</h6>
                </div>
            </div>
        `;

        // Cập nhật tiêu đề
    $('.title-confirm').html(_this.attr('data-title'));

    // Thêm nút hủy đơn vào vùng cancle-block
    let cancelButton = `
        <button type="button" class="btn btn-danger updateField" data-field="confirm" data-value="cancle" data-title="Đã hủy đơn hàng">Hủy đơn</button>
    `;

    if(_this.attr('data-field') == 'confirm') {
        $('.confirm-block').html('Đã xác nhận');
        $('.cancle-block').html(cancelButton);
    }

    // Sửa phần này - thay thế button bằng text
    if(_this.attr('data-value') == 'cancle') {
        _this.closest('button').replaceWith('Đã hủy đơn hàng');
    }

    // Xóa và thêm nội dung mới trong cofirm-box
    $('.cofirm-box').find('.position-relative, .row.row-cols-3').remove();
    $('.cofirm-box').append(confirmedHTML);


    };


    $(document).ready(function(){
        HT.editOrder()
        HT.updateDescription()
        HT.cancleEdit()
        HT.getLocation()
        HT.saveCustomer()
        HT.updateField()
        HT.updateBadge()
    });

})(jQuery);
