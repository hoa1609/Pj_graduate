@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    $url = $config['method'] == 'create' ? route('promotion.store') : route('promotion.update', $promotion->id);
@endphp
<form action="{{ $url }}" method="promotion">
    @csrf
    <div class="container-xxl">
        <div class="row justify-content-star">
            <div class="col-md-8 col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">{{ $config['seo']['title'] }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mb-2">
                            <div class="col-md-6 position-relative">
                                <label class="form-label">Tên chương trình
                                    <span class="text-danger fs-10"> (*)</span>
                                </label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="Nhập tên chương trình..."
                                    value="{{ old('name', $promotion->name ?? '') }}">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label">Mã khuyến mại</label>
                                <input type="text" name="code" class="form-control"
                                    placeholder="Nhập tên mã khuyến mại..."
                                    value="{{ old('code', $promotion->code ?? '') }}">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12 position-relative">
                                <label class="form-label">Mô tả khuyến mại</label>
                                <textarea name="description" class="form-control">{{ old('description', $promotion->description ?? null) }}</textarea>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Cài đặt thông tin chi tiết khuyến mãi</h4>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row mb-2">
                            <div class="col-md-12 position-relative mb-2">
                                <label class="form-label">Chọn hình thức khuyến mãi</label>
                                <select name="" class="form-select setUpSelect2 promotionMethod">
                                    <option value="none">Chọn hình thức</option>
                                    @foreach (__('module.promotion') as $key => $val)
                                        <option value="{{ $key }}">{{ $val }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-12 col-lg-12">
                                <div class="promotion-container">
                                    {{-- <table class="table table-centered  mb-3">
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
                                                    <div class="product-quantity" data-bs-toggle="modal" data-bs-target="#finbdProduct">
                                                        <div class="boxWrapper">
                                                            <div class="boxSearchIcon pe-2">
                                                                <i class="iconoir-search"></i>
                                                            </div>
                                                            <div class="boxSearchInput fixGrid6">
                                                                <p>Tìm kiếm theo tên...</p>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td class="order_amount_range_to td-range">
                                                    <input type="text" name="amountTo[]" class="form-control int"
                                                        value="1">
                                                </td>
                                                <td class="order_amount_range_to td-range">
                                                    <input type="text" name="amountTo[]" class="form-control int"
                                                        placeholder="0" value="0">
                                                </td>
                                                <td class="discountType">
                                                    <div class="uk-flex uk-flex-middle">
                                                        <input type="text" name="amountValue[]"
                                                            class="form-control int me-2" placeholder="0"
                                                            value="0">
                                                        <select class="multipleSelect2 disountType" name="amountType"
                                                            id="">
                                                            <option value="cash">đ</option>
                                                            <option value="percent">%</option>
                                                        </select>
                                                    </div>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- --}}
            <div class="col-md-4 col-lg-4">
                <div class="card">
                    <div class="card-body pt-10">
                        <div class="row">
                            <div class="col-md-12 position-relative pb-2">
                                <label class="card-title fs-16">Thời gian áp dụng chương trình</label>
                                <div class="col-sm-12">
                                    <label class="form-label col-sm-12 col-form-label">Ngày bắt đầu</label>
                                    <input class="form-control datepicker" type="datetime-local" name="startDate"
                                        id="startDate">
                                </div>
                            </div>
                            <div class="col-md-12 position-relative pb-2">
                                <div class="col-sm-12">
                                    <label class="form-label col-sm-12 col-form-label">Ngày kết thúc</label>
                                    <input class="form-control datepicker" type="datetime-local" name="endDate"
                                        id="endDate">
                                </div>
                            </div>
                            <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                                <input type="checkbox" name="" class="form-check-input me-2" value="accept"
                                    id="neverEnd">
                                <label for="neverEnd" class="control-label ">Không có ngày kết thúc</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body pt-10">
                        <div class="row">
                            <div class="content-source">
                                <div class="col-md-12 position-relative pb-2">
                                    <label class="card-title fs-16">Nguồn khách áp dụng </label>
                                    <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                                        <input type="radio" name="source" id="allSource"
                                            class="form-check-input me-2 chooseSource" value="all" checked="">
                                        <label class="control-label" for="allSource">Áp dụng cho toàn bộ nguồn khách
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                                    <input type="radio" name="source" id="chooseSource"
                                        class="form-check-input me-2 chooseSource" value="choose">
                                    <label class="control-label" for="chooseSource">Chọn nguồn khách áp dụng</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body pt-10">
                        <div class="row">
                            <div class="content-apply">
                                <div class="col-md-12 position-relative pb-2">
                                    <label class="card-title fs-16">Đối tượng áp dụng </label>
                                    <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                                        <input type="radio" name="apply" id="allApply"
                                            class="form-check-input me-2 chooseApply" value="all" checked="">
                                        <label class="control-label" for="allApply">Áp dụng toàn bộ khách hàng
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-12 position-relative pb-2 d-flex align-items-center">
                                    <input type="radio" name="apply" id="chooseApply"
                                        class="form-check-input me-2 chooseApply" value="choose">
                                    <label class="control-label" for="chooseApply">Chọn đối tượng khách hàng</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end sticky-find mb-2">
                    <button type="submit" name="send" class="btn btn-primary">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>
</form>
@include('backend.promotion.promotion.component.popup')
<input type="hidden" class="input-product-and-quantity" value="{{ json_encode(__('module.item')) }}">
<script>
    // Hàm để lấy ngày giờ hiện tại và format đúng chuẩn "datetime-local" (YYYY-MM-DDTHH:MM)
    function getVietnamTime() {
        const now = new Date();
        const offset = now.getTimezoneOffset();
        const vietnamTime = new Date(now.getTime() - (offset * 60 * 1000)); // Chuyển sang giờ Việt Nam
        return vietnamTime.toISOString().slice(0, 16); // Format thành "YYYY-MM-DDTHH:MM"
    }

    // Thiết lập giá trị mặc định và minDate cho startDate và endDate
    function setDefaultDateTime() {
        const currentDateTime = getVietnamTime();
        document.getElementById("startDate").value = currentDateTime; // Hiển thị ngày hiện tại
        document.getElementById("endDate").value = currentDateTime;
        document.getElementById("startDate").min = currentDateTime;
        document.getElementById("endDate").min = currentDateTime;
    }

    setDefaultDateTime();

    // Thiết lập minDate của endDate dựa trên startDate
    document.getElementById("startDate").addEventListener("change", function() {
        document.getElementById("endDate").min = this.value;
    });

    $(document).on('input', '.form-control.int', function() {
        let value = $(this).val().replace(/\./g, '');

        if (/[^0-9]/.test(value)) {
            $(this).val(value.replace(/[^0-9]/g, ''));
            return;
        }

        // Định dạng lại giá trị với dấu phân cách nhóm hàng nghìn
        if (!isNaN(value) && value !== '') {
            $(this).val(parseFloat(value).toLocaleString('de-DE'));
        }
    });
</script>


