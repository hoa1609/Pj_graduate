<div class="startbar d-print-none">

    <div class="brand">
        <a href="{{route('dashboard.index')}}" class="logo">
            <span class="">
                <img src="/backend/assets/images/logo-main-light.png" alt="logo-large" class="logo-sm logo-light">
                <img src="/backend/assets/images/logo-main-dark.png" alt="logo-main" class="logo-sm logo-dark">
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
                    {{-- @foreach (config('apps.module.module') as $key => $val)
                        <li class="nav-item">
                            <a class="nav-link" href="#sidebarDashboards{{ $key }}" data-bs-toggle="collapse"
                                role="button" aria-expanded="false"
                                aria-controls="sidebarDashboards{{ $key }}">
                                <i class="{{ $val['icon'] }}"></i>
                                <span>{{ $val['title'] }}</span>
                            </a>
                            <div class="collapse" id="sidebarDashboards{{ $key }}">
                                @if (isset($val['subModule']))
                                    <ul class="nav flex-column">
                                        @foreach ($val['subModule'] as $module)
                                            <li class="nav-item">
                                                <a class="nav-link"
                                                    href="{{ $module['route'] }}">{{ $module['title'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </li>
                    @endforeach --}}

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="iconoir-home-simple menu-icon"></i>
                            <span>Quản lý thành viên</span>
                        </a>
                        <div class="collapse " id="sidebarDashboards">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.index') }}">Quản lý thành viên</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('user.catalogue.index')}}">Quản lý nhóm thành viên</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarElements" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarElements">
                            <i class="icofont-file-alt menu-icon"></i>
                            <span>Quản lý bài viết</span>
                        </a>
                        <div class="collapse " id="sidebarElements">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('post.catalogue.index')}}">Quản lý nhóm bài viết</a>
                                    <a class="nav-link" href="ui-alerts.html">Quản lý bài viết</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarForms" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarForms">
                            <i class="iconoir-language menu-icon"></i>
                            <span>Quản lý ngôn ngữ</span>
                        </a>
                        <div class="collapse " id="sidebarForms">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('language.index')}}">Ngôn ngữ</a>
                                </li>

                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#sidebarCharts" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarCharts">
                            <i class="la la-picture-o menu-icon"></i>
                            <span>Quản lý banner & slide</span>
                        </a>
                        <div class="collapse " id="sidebarCharts">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('slide.index')}}">Cài đặt slide</a>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
