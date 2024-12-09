@php
    $imageinf = $info->image;
    $nameinf = $info->name;
    $roleinf = $info->user_roles->name;
@endphp
<li class="dropdown topbar-item">
    <a class="nav-link dropdown-toggle arrow-none nav-icon" data-bs-toggle="dropdown" href="#" role="button"
        aria-haspopup="false" aria-expanded="false">
        <img src="{{ $imageinf }}" alt="" class="thumb-lg rounded-circle">
    </a>
    <div class="dropdown-menu dropdown-menu-end py-0">
        <div class="d-flex align-items-center dropdown-item py-2 bg-secondary-subtle">
            <div class="flex-shrink-0">
                <img src="{{ $imageinf }}" alt="" class="thumb-md rounded-circle">
            </div>
            <div class="flex-grow-1 ms-2 text-truncate align-self-center">
                <h6 class="my-0 fw-medium text-dark fs-13">{{ $nameinf }}</h6>
                <small class="text-muted mb-0">{{ $roleinf }}</small>
            </div>
        </div>
        <div class="dropdown-divider mt-0"></div>
        <small class="text-muted px-2 pb-1 d-block">Tài khoản</small>
        <a class="dropdown-item" href="#"><i class="las la-user fs-18 me-1 align-text-bottom"></i> Hồ sơ</a>
        <small class="text-muted px-2 py-1 d-block">Cài đặt</small>                        
        <a class="dropdown-item" href="#"><i class="las la-cog fs-18 me-1 align-text-bottom"></i>Cài đặt khác</a>
        <a class="dropdown-item" href="#"><i class="las la-question-circle fs-18 me-1 align-text-bottom"></i>Hỗ trợ</a>                       
        <div class="dropdown-divider mb-0"></div>
        <a class="dropdown-item text-danger" href="{{ route('logout') }}"><i class="las la-power-off fs-18 me-1 align-text-bottom"></i> Đăng xuất</a>
    </div>
</li>