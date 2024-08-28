<div class="startbar d-print-none">

    <div class="brand">
        <a href="index.html" class="logo">
            <span>
                <img src="backend/assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
            </span>
            <span class="">
                <img src="backend/assets/images/logo-light.png" alt="logo-large" class="logo-lg logo-light">
                <img src="backend/assets/images/logo-dark.png" alt="logo-large" class="logo-lg logo-dark">
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
                            <i class="iconoir-home-simple menu-icon"></i>
                            <span>QL Thành Viên</span>
                        </a>
                        <div class="collapse " id="sidebarDashboards">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.index') }}">QL nhóm thành viên</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="ecommerce-index.html">QL thành viên</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    

                    
                </ul>
            </div>
        </div>
    </div>
</div>