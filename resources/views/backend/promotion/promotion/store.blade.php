@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    $url = $config['method'] == 'create' ? route('promotion.store') : route('promotion.update', $promotion->id);
@endphp
<form action="{{ $url }}" method="POST">
    @csrf
    <div class="container-xxl">
        <div class="row justify-content-star">
            <div class="col-md-8 col-lg-8">
                @include('backend.promotion.component.general', ['model' => ($promotion) ?? null])
                @include('backend.promotion.promotion.component.detail')
            </div>
            {{-- --}}
            @include('backend.promotion.component.aside', ['model' => ($promotion) ?? null])

        </div>
    </div>
</form>
@include('backend.promotion.promotion.component.popup')


<input type="hidden" class="preload_promotionMethod" value="{{ old('method', ($promotion->method) ?? null) }}">
<input type="hidden" class="preload_select-product-and-quantity" value="{{ old('module_type', ($promotion->discountInformation['info']['model']) ?? null) }}">

<input
    type="hidden"
    class="input_order_amount_range"
    value="{{ json_encode(old('promotion_order_amount_range', $promotion->discountInformation['info'] ?? null)) }}"
>

<input type="hidden" class="input_product_and_quantity" value="{{ json_encode(old('product_and_quantity', ($promotion->discountInformation['info']) ?? null)) }}">
<input type="hidden" class="input_object" value="{{ json_encode(old('object', ($promotion->discountInformation['info']['object'])  ?? null)) }}">

<script>
     function getVietnamTime() {
        const now = new Date();
        const offset = now.getTimezoneOffset();
        
        const vietnamTime = new Date(now.getTime() - (offset * 60 * 1000)); 
        return vietnamTime.toISOString().slice(0, 16); 
    }
    function setDefaultDateTime() {
        const currentDateTime = getVietnamTime();

        console.log(currentDateTime);

        document.getElementById("startDate").min = currentDateTime;
        document.getElementById("endDate").min = currentDateTime;
    }

    setDefaultDateTime();

    document.getElementById("startDate").addEventListener("change", function() {
        document.getElementById("endDate").min = this.value;
    });
    $(document).on('input', '.form-control.int', function() {
        let value = $(this).val().replace(/\./g, '');
        if (/[^0-9]/.test(value)) {
            $(this).val(value.replace(/[^0-9]/g, ''));
            return;
        }
        if (!isNaN(value) && value !== '') {
            $(this).val(parseFloat(value).toLocaleString('de-DE'));
        }
    });
</script>

