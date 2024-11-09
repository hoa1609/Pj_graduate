<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true" style="background: rgba(0, 0, 0, 0.5);">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="searchModalLabel">Chọn sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" placeholder="Nhập tên sản phẩm...">
            </div>
            <div class="modal-body product-list">
                @for($i = 0; $i < 10; $i++)
                <div class="d-flex align-items-center mb-3">
                    <input type="checkbox" class="form-check-input me-2">
                    <img src="https://cdn2.cellphones.com.vn/insecure/rs:fill:358:358/q:90/plain/https://cellphones.com.vn/media/catalog/product/i/p/iphone-14-pro-256gb.png" alt="Product Image" class="img-thumbnail me-3" style="width: 50px; height: 50px;">
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fw-bold">Tên sản phẩm</span>
                            <span class="text-danger fs-5">1,000,000₫</span>
                        </div>

                        <div class="d-flex justify-content-between text-muted pt-1">
                            <div class="d-flex">
                                <span>Mã sản phẩm: </span>
                                <span class="code-product text-primary ms-1">SP001</span>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex">
                                    <span>Tồn kho: </span>
                                    <span class="stock-number text-primary ms-1">100</span>
                                </div>
                                <span class="mx-2">|</span>
                                <div class="d-flex">
                                    <span>Có thể bán: </span>
                                    <span class="available-for-sale text-primary ms-1">90</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="hr-custom"></div>
                @endfor
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary">Xác nhận</button>
            </div>
        </div>
    </div>
</div>


