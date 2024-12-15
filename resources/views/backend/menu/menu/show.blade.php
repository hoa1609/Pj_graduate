<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card p-4">
                <div class="mb-3">
                    <h3 class="fw-bold">Danh sách Menu</h3>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="">
                                <p>+ Danh sách Menu giúp bạn dễ dàng kiểm soát bố cục menu. Bạn có thể thêm mới hoặc cập
                                    nhật
                                    menu bằng nút
                                    <span class="text-primary">Cập nhật Menu</span>
                                </p>
                                <p>+ Bạn có thể thay đổi vị trí hiển thị của menu bằng cách kéo thả menu đến vị trí mong
                                    muốn
                                </p>
                                <p>+ Dễ dàng khởi tạo menu con bằng cách ấn vào nút
                                    <span class="text-primary">Quản lý menu con</span>
                                </p>
                                <p> <span class="text-danger">+ Hỗ trợ tới danh mục con cấp 5</span></p>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="ibox">
                                <div class="ibox-title d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">{{$menuCatalogue->name}}</h5>
                                    <a href="{{ route('menu.editMenu', ['id' => $id]) }}"
                                        class="d-flex align-items-center">
                                        <i class="fa fa-plus me-2"></i>
                                        Cập nhật Menu cấp 1
                                    </a>
                                </div>

                                @php
                                    $menus = recursive($menus);
                                    $meunuString = recursive_menu($menus);
                                @endphp
                                <div class="ibox-content" id="dataCatalogue" data-catalogueId="{{ $id }}">
                                    @if(count($menus))
                                        <div class="dd" id="nestable2">
                                            <ol class="dd-list">
                                                {!! $meunuString !!}
                                            </ol>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click', '.expand-collapse-btn', function() {
            var submenuWrapper = $(this).closest('li').find('.submenu-wrapper');
            if (submenuWrapper.is(':hidden')) {
                submenuWrapper.show(); // Hiển thị menu con
                $(this).text('-'); // Thay đổi nút thành "-"
            } else {
                submenuWrapper.hide(); // Ẩn menu con
                $(this).text('+'); // Thay đổi nút thành "+"
            }
        });
    });
</script>
