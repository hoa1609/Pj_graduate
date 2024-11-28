<div class="startbar d-print-none">
    <div class="brand">
        <a href="{{ route('dashboard.index') }}" class="logo">
            <span>
                <img src="backend/assets/images/logo-main-light.png" alt="logo-large" class="logo-sm logo-light">
                <img src="backend/assets/images/logo-main-dark.png" alt="logo-main" class="logo-sm logo-dark">
            </span>
        </a>
    </div>
    <div class="startbar-menu">
        <div class="startbar-collapse" id="startbarCollapse" data-simplebar>
            <div class="d-flex align-items-start flex-column w-100">
                <ul class="navbar-nav mb-auto w-100">
                    <li class="menu-label pt-0 mt-0">
                        <span>Main Menu</span>
                    </li>
                    @foreach (__('sidebar.module') as $module)
                        <li class="nav-item">
                            @if (!isset($module['subModule']))
                                <a class="nav-link" href="{{ route($module['route']) }}">
                                    <i class="{{ $module['icon'] }} menu-icon"></i>
                                    <span>{{ $module['title'] }}</span>
                                </a>
                            @else
                                <a class="nav-link" href="#sidebar{{ $module['dropdown'] }}" data-bs-toggle="collapse"
                                    role="button" aria-expanded="false"
                                    aria-controls="sidebar{{ $module['dropdown'] }}">
                                    <i class="{{ $module['icon'] }} menu-icon"></i>
                                    <span>{{ $module['title'] }}</span>
                                </a>
                                <div class="collapse" id="sidebar{{ $module['dropdown'] }}">
                                    <ul class="nav flex-column">
                                        @foreach ($module['subModule'] as $sub)
                                            <li class="nav-item">
                                                @if (isset($sub['subSubModule']))
                                                    <a class="nav-link" href="#sidebar{{ $sub['dropdown'] }}"
                                                        data-bs-toggle="collapse" role="button" aria-expanded="false"
                                                        aria-controls="sidebar{{ $sub['dropdown'] }}">
                                                        <span>{{ $sub['title'] }}</span>
                                                    </a>
                                                    <div class="collapse" id="sidebar{{ $sub['dropdown'] }}">
                                                        <ul class="nav flex-column">
                                                            @foreach ($sub['subSubModule'] as $subSub)
                                                                <li class="nav-item">
                                                                    <a href="{{ route($subSub['route']) }}"
                                                                        class="nav-link">
                                                                        {{ $subSub['title'] }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @else
                                                    <a href="{{ route($sub['route']) }}" class="nav-link">
                                                        {{ $sub['title'] }}
                                                    </a>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </li>
                    @endforeach

                </ul>
            </div>
        </div>
    </div>
</div>
