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
            @foreach (__('module.model') as $key => $value)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading{{ $key }}">
                        <a href="{{ $key }}" class="accordion-button collapsed menu-module" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapseGroupPosts{{ $key }}"
                            data-model="{{ $key }}" aria-expanded="false"
                            aria-controls="collapseGroupPosts{{ $key }}">
                            <span class="menu-text">{{ $value }}</span>
                        </a>
                    </h2>
                    <div id="collapseGroupPosts{{ $key }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $key }}" data-bs-parent="#menuAccordion">
                        <div class="accordion-body">
                            <div data-model="{{ $key }}" class="search-model">
                                <div class="form-row">
                                    <input type="text" class="form-control search-menu" name="keyword"
                                        data-model="someModel" placeholder="Nhập 2 ký tự để tìm kiếm...">
                                </div>
                            </div>
                            <div class="menu-list mt20">
                                {{-- <div id="paginationMenu"></div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
                    @php
                        $menu = old('menu', $menuList ?? null);
                    @endphp
                    <tbody class="menu-wrapper">
                        <tr class="text-wp {{ is_array($menu) && count($menu) ? 'd-none' : '' }}">
                            <td colspan="4" class="text-center text-muted hid">
                                <p>Danh sách liên kết này chưa có bất kỳ đường dẫn nào.</p>
                                <p>Hãy nhấn vào <a href="#" class="text-primary add-menu">Thêm đường dẫn</a> để bắt đầu
                                    thêm.</p>
                            </td>
                        </tr>

                        @if (is_array($menu) && count($menu))
                            @foreach ($menu['name'] as $key => $value)
                                <tr class="default-class">
                                    <td>
                                        <input type="text" name="menu[name][]" value="{{ $value }}"
                                            placeholder="Tên Menu" class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="menu[canonical][]"
                                            value="{{ $menu['canonical'][$key] }}" placeholder="Đường dẫn"
                                            class="form-control">
                                    </td>
                                    <td>
                                        <input type="text" name="menu[order][]" value="{{ $menu['order'][$key] }}"
                                            placeholder="Vị trí" class="form-control">
                                        <!-- Input hidden để lưu menu[id][] -->
                                        <input type="hidden" name="menu[id][]" value="{{ $menu['id'][$key] }}">
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-link text-danger"><i
                                                class="fas fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
