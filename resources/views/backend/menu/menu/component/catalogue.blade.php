<div class="row d-flex">
    <div class="col-lg-5">
        <div class="card p-3 h-100">
            <!-- Vị trí Menu -->
            <div class="mb-4">
                <h5 class="fw-bold">Vị trí Menu</h5>
                <p class="text-muted">+ Website có các vị trí hiển thị cho từng menu</p>
                <p class="text-muted">Lựa chọn vị trí mà bạn muốn hiển thị</p>
            </div>
            <!-- Thông tin chung -->
            <div class="mb-3">
                <h5 class="fw-bold">Thông tin chung</h5>
                <p class="text-muted">Nhập thông tin chung của người sử dụng</p>
                <p class="text-muted">Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
            </div>
        </div>
    </div>
    <div class="col-lg-7">
        <div class="card p-4 h-100">
            <!-- Chọn vị trí hiển thị -->
            <div class="mb-3">
                <label class="fw-bold mb-15" for="menu-position">
                    Chọn vị trí hiển thị <span class="text-danger">(*)</span>
                </label>
                <div class="d-flex">
                    @if (count($menuCatalogues))
                        <select class="form-select me-3" name="menu_catalogue_id" id="menu-position">
                            <option value="">[Chọn vị trí hiển thị]</option>
                            @foreach ($menuCatalogues as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                <!-- Các option có thể được thêm ở đây -->
                            @endforeach
                        </select>
                    @endif
                    <button data-bs-toggle="modal" data-bs-target="#createMenuCatalogue" type="button"
                        class="btn btn-danger col-3">Tạo vị trí hiển
                        thị</button>
                </div>
            </div>
            <!-- Input Tên menu -->
            <div class="mb-3">
                <label for="menu-name" class="fw-bold">Tên menu</label>
                <input type="text" name="name" id="menu-name" class="form-control mt-2"
                    placeholder="Nhập tên menu..." value="{{ old('name', $menu->name ?? '') }}">
            </div>
        </div>
    </div>
</div>
