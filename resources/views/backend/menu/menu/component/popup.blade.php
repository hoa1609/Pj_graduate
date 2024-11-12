<div id="createMenuCatalogue" class="modal fade" tabindex="-1" aria-labelledby="createMenuCatalogueLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-3 shadow">
            <div class="modal-header text-white">
                <h5 class="modal-title fw-bold" id="createMenuCatalogueLabel">Tạo Vị Trí Hiển Thị Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="" class="form create-menu-catalogue" method="POST">
                    @csrf
                    <div class="form-error text-success"></div>

                    <div class="mb-3">
                        <label for="new-menu-name" class="form-label fw-bold">Tên vị trí menu <span
                                class="text-danger">*</span></label>
                        <input type="text" id="new-menu-name" name="name" class="form-control"
                            placeholder="Nhập tên vị trí menu, ví dụ: Menu chính" required>
                        <div class="error name"></div>
                    </div>

                    <div class="mb-3">
                        <label for="new-menu-keyword" class="form-label fw-bold">Từ khóa</label>
                        <input type="text" id="new-menu-keyword" name="keyword" class="form-control"
                            placeholder="Nhập từ khóa, ví dụ: main-menu">
                        <div class="error keyword"></div>
                    </div>


                    <div class="modal-footer justify-content-end">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" name="create" value="create" class="btn btn-primary">Lưu Vị Trí</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
