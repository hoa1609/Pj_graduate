{{-- @include('backend.dashboard.component.nav', ['title' => $config['seo']['create']['title']]) --}}
@php
    $url = $config['method'] == 'create' ? route('slide.store') : route('slide.update', $slide->id);
@endphp
<form action="{{ $url }}" method="post">
    @csrf
    <div class="container-xxl">
        <div class="row justify-content-center">
            @include('backend.dashboard.component.formError')
            <div class="col-lg-9">
                @include('backend.slide.slide.component.list')
            </div><!--end card-->

            </div> <!--end col-->
            <div class="col-lg-3">
                @include('backend.slide.slide.component.aside')
            </div>

            <div class="d-flex justify-content-end mb-2">
                <button type="submit" class="btn btn-primary">Lưu lại</button>
            </div>
        </div>
    </div>
</form>
