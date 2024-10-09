<div class="startbar d-print-none">
    <div class="brand">
        <a href="{{ route('dashboard.index') }}" class="logo">
            <span>
                <img src="backend/assets/images/logo-main-light.png" alt="logo-large" class="logo-sm logo-light">
                <img src="backend/assets/images/logo-main-dark.png" alt="logo-main" class="logo-sm logo-dark">
            </span>
        </a>
    </div>
    <div class="startbar-menu" >
        <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
            <div class="d-flex align-items-start flex-column w-100">
                <ul class="navbar-nav mb-auto w-100">
                    <li class="menu-label pt-0 mt-0">
                        <span>Main Menu</span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="fas fa-user menu-icon"></i>
                            <span>QL Thành Viên</span>
                        </a>
                        <div class="collapse" id="sidebarDashboards">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.index') }}">QL thành viên</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.role.index') }}">QL nhóm thành viên</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarApplications" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarApplications">
                            <i class="iconoir-view-grid menu-icon"></i>
                            <span>Ngôn ngữ</span>
                        </a>
                        <div class="collapse " id="sidebarApplications">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('language.index') }}">QL ngôn ngữ</a>
                                </li>
                                
                            </ul>
                        </div>
                    </li>
                   
                </ul>
            </div>
        </div>
    </div>
</div>