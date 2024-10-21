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

                    
                    @php
                        $segment = request()->segment(1);
                    @endphp
                    <ul class="nav flex-column">
                        @foreach (__('sidebar.module') as $module)
                            <li class="nav-item">
                                <a class="nav-link" href="#sidebar{{ $module['dropdown'] }}" data-bs-toggle="collapse" role="button"
                                    aria-expanded="false" aria-controls="sidebar{{ $module['dropdown'] }}">
                                    <i class="{{ $module['icon'] }} menu-icon"></i>
                                    <span>{{ $module['title'] }}</span>
                                </a>
                    
                                <div class="collapse" id="sidebar{{ $module['dropdown'] }}">
                                    <ul class="nav flex-column">
                                        @foreach ($module['subModule'] as $sub)
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ url($sub['route']) }}">
                                                    {{ $sub['title'] }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @endforeach

                    </ul>
                </ul>
            </div>
        </div>
    </div>
</div>