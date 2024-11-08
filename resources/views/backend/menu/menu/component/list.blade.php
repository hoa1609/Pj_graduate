<div class="row d-flex">
    <div class="col-lg-5">
        <!-- Vị trí Menu Panel -->
        <div class="accordion" id="menuAccordion">
            <!-- Liên kết tự tạo -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseMenuPosition" aria-expanded="true"
                        aria-controls="collapseMenuPosition">
                        Liên kết tự tạo
                    </button>
                </h2>
                <div id="collapseMenuPosition" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#menuAccordion">
                    <div class="accordion-body">
                        <div class="panel-title">Tạo Menu</div>
                        <div class="panel-description">
                            <p>+ Cài đặt Menu mà bạn muốn hiển thị.</p>
                            <p><small class="text-danger">* Khi khởi tạo menu bạn phải chắc chắn rằng đường dẫn của menu
                                    có hoạt động. Đường dẫn trên website được khởi tạo tại các module: Bài viết, Sản
                                    phẩm, Dự án, ...</small></p>
                            <p><small class="text-danger">* Tiêu đề và đường dẫn của menu không được bỏ trống.</small>
                            </p>
                            <p><small class="text-danger">* Hệ Thống chỉ hỗ trợ tối đa 5 cấp menu.</small></p>
                            <a style="color:#000; border-color:#4c4dd5; display:inline-block !important;" href="#"
                                title="" class="btn btn-default add-menu m-b m-r right">Thêm đường dẫn</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nhóm bài viết -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseGroupPosts" aria-expanded="false" aria-controls="collapseGroupPosts">
                        Nhóm bài viết
                    </button>
                </h2>
                <div id="collapseGroupPosts" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#menuAccordion">
                    <div class="accordion-body">
                        {{-- a????????? --}}
                    </div>
                </div>
            </div>
            <!-- Bài viết -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapsePosts" aria-expanded="false" aria-controls="collapsePosts">
                        Bài viết
                    </button>
                </h2>
                <div id="collapsePosts" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#menuAccordion">
                    <div class="accordion-body">
                        {{-- a????????? --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card p-3">
            <div class="table-responsive">
                <table class="table table-borderless menu-table">
                    <thead>
                        <tr>
                            <th class="fw-bold">Tên Menu</th>
                            <th class="fw-bold">Đường dẫn</th>
                            <th class="fw-bold">Vị trí</th>
                            <th class="fw-bold">Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-wp">
                            <td colspan="4" class="text-center text-muted hid">
                                <p>Danh sách liên kết này chưa có bất kì đường dẫn nào.</p>
                                <p>Hãy nhấn vào <a href="#" class="text-primary">Thêm đường dẫn</a> để bắt đầu thêm.</p>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="text" class="form-control" placeholder="Tên Menu"></td>
                            <td><input type="text" class="form-control" placeholder="Đường dẫn"></td>
                            <td><input type="text" class="form-control" placeholder="Vị trí"></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-link text-danger"><i class="fas fa-times"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
