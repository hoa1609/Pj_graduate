@include('backend.dashboard.component.breadcrumb')
@include('backend.dashboard.component.errors')

<form action="{{ route('language.storeTranslate') }}" method="post">
    @csrf
    <input type="hidden" name="option[id]" value="{{ $option['id'] }}">
    <input type="hidden" name="option[languageId]" value="{{ $option['languageId'] }}">
    <input type="hidden" name="option[model]" value="{{ $option['model'] }}">
    <div class="row">
        <div class="col-md-6 col-lg-6">
            <div class="container-xxl">
                <div class="row justify-content-star">
                    <div class="col-md-12 col-lg-12">
                        @include('backend.dashboard.component.content',  ['model' => ($object) ?? null, 'disabled' => 1])
                    </div>
                    <div class="col-md-12 col-lg-12">
                        @include('backend.dashboard.component.seo', ['model' => ($object) ?? null, 'disabled' => 1]) 
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6">
            <div class="container-xxl">
                <div class="row justify-content-star">
                    <div class="col-md-12 col-lg-12">
                        @include('backend.dashboard.component.translate',  ['model' => ($object) ?? null])
                    </div>
                    <div class="col-md-12 col-lg-12">
                        @include('backend.dashboard.component.seoTranslate',  ['model' => ($object) ?? null])
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
