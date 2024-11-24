@php
    $name = $productCatalogue->languages->first()->pivot->name;
@endphp
<div class="sticky-header-next-sec  ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list text-start">
                            <li class="ec-breadcrumb-item"><a href="{{ route('home.index') }}">Trang chủ</a></li>
                            @if(!is_null($breadcrumb))
                                @foreach ($breadcrumb as $key => $val)
                                @php
                                    $name = $val->languages->first()->pivot->name;
                                    $canonical = write_url($val->languages->first()->pivot->canonical, true , true);
                                @endphp
                                    <li class="ec-breadcrumb-item"><a href="{{ $canonical }}">{{ $name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>