<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card p-4">
                <div class="mb-3">
                    <h3 class="fw-bold">Danh sách Menu</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách Menu</li>
                        </ol>
                    </nav>
                </div>
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="">
                                <h4 class="fw-bold mb-3">Danh sách menu</h4>
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

                                <div class="ibox-content" id="dataCatalogue" data-catalogueId="{{ $id }}">
                                    @if (count($menus))
                                        <div class="dd" id="nestable2">
                                            <ol class="dd-list">
                                                @foreach ($menus as $menu)
                                                    @php
                                                        // Lấy ngôn ngữ hiện tại
                                                        $languageMenu = $menu->languages->first();
                                                    @endphp
                                                    <li class="dd-item" data-id="{{ $menu->id }}">
                                                        <div class="dd-handle">
                                                            <span class="label label-info"><i
                                                                    class="fa fa-users"></i></span>{{ $languageMenu->pivot->name }}
                                                        </div>
                                                        <a class="create-children-menu"
                                                            href="{{ route('menu.children', $menu->id) }}">Xem danh sách
                                                            con</a>

                                                        <!-- Gọi đệ quy để hiển thị menu con -->
                                                        @if (count($menu->children))
                                                            {!! recursive_menu($menu->children) !!}
                                                        @endif
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    @endif
                                </div>

                                {{-- <div class="ibox-content">
                                    @php
                                        $menus = recursive_menu($menus);
                                        $menuString = recursive_menu($menus);
                                    @endphp
                                    @if ($menus)
                                        <div class="dd" id="nestable2">
                                            <ol class="dd-list">
                                                {!! $menus !!}
                                            </ol>
                                        </div>
                                    @endif
                                </div> --}}

                                {{-- <div class="ibox-content">
                                    @if (count($menus))
                                        <div class="dd" id="nestable2">
                                            <ol class="dd-list">
                                                @foreach ($menus as $key => $value)
                                                    @php
                                                        $languageMenu = $value->languages->first();
                                                    @endphp
                                                    <li class="dd-item" data-id="{{ $value->id }}">
                                                        <div class="dd-handle">
                                                            <span class="label label-info"><i
                                                                    class="fa fa-users"></i></span>{{ $languageMenu->pivot->name }}

                                                        </div>
                                                        <a class="create-children-menu" href="{{ route('menu.children', $value->id) }}">Xem
                                                            danh sách con</a>
                                                        <ol class="dd-list">
                                                            <li class="dd-item" data-id="2">
                                                                <div class="dd-handle">
                                                                    <span class="label label-info"><i
                                                                            class="fa fa-cog"></i></span>
                                                                    Vivamus vestibulum nulla nec ante.
                                                                </div>
                                                            </li>
                                                            <li class="dd-item" data-id="3">
                                                                <div class="dd-handle">
                                                                    <span class="pull-right"> 11:00 pm </span>
                                                                    <span class="label label-info"><i
                                                                            class="fa fa-bolt"></i></span>
                                                                    Nunc dignissim risus id metus.
                                                                </div>
                                                            </li>
                                                            <li class="dd-item" data-id="4">
                                                                <div class="dd-handle">
                                                                    <span class="pull-right"> 11:00 pm </span>
                                                                    <span class="label label-info"><i
                                                                            class="fa fa-laptop"></i></span> Vestibulum
                                                                    commodo
                                                                </div>
                                                            </li>
                                                        </ol>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    @endif
                                </div> --}}
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
        // Khi người dùng nhấn vào nút "+" hoặc "-"
        $(document).on('click', '.expand-collapse-btn', function() {
            var submenuWrapper = $(this).closest('li').find('.submenu-wrapper');

            // Kiểm tra nếu menu con đang ẩn hay hiển thị
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
