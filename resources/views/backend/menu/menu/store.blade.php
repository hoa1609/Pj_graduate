<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            {{-- <h4 class="card-title">{{ $config['seo']['title'] }}</h4> --}}
                        </div>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- @php
                    $url = $config['method'] == 'create' ? route('menu.store') : route('menu.update', $menu->id);
                @endphp --}}
                <div class="card-body pt-0">
                    <form action="{{ route('menu.store') }}" method="post" class="box menuContainer">
                        @csrf
                        <div class="container-xxl">
                            <div class="row justify-content-center">
                                @include('backend.menu.menu.component.catalogue')
                            </div>
                            <hr>
                            <div class="row justify-content-center">
                                @include('backend.menu.menu.component.list')
                            </div>
                        </div>
                        <!-- Nút lưu lại -->
                        <input type="hidden" name="redirect" value="{{ $id ?? 0 }}">
                        <div class="text-end">
                            <button type="submit" name="send" value="send" class="btn btn-primary">Lưu thông
                                tin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.menu.menu.component.popup')
