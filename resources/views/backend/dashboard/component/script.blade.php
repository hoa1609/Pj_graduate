<script src="backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="backend/assets/libs/simplebar/simplebar.min.js"></script>

{{-- <script src="backend/assets/libs/simple-datatables/umd/simple-datatables.js"></script> --}}
{{-- <script src="backend/assets/js/pages/datatable.init.js"></script>   --}}

{{-- <script src="backend/assets/libs/apexcharts/apexcharts.min.js"></script> --}}
<script src="backend/assets/js/pages/index.init.js"></script>
<script src="backend/assets/data/stock-prices.js"></script>
<script src="backend/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="backend/assets/libs/jsvectormap/maps/world.js"></script>
<script src="backend/assets/js/pages/form-validation.js"></script>
<script src="backend/assets/js/app.js"></script>


<script src="backend/assets/library/location.js"></script>
<script src="backend/assets/library/library.js"></script>

<script src="backend/plugins/ckfinder_2/ckfinder.js"></script>
<script src="backend/plugins/ckeditor/ckeditor.js"></script> {{-- ck editor4 --}}
<script src="backend/assets/library/finder.js"></script>
<script src="backend/assets/library/seo.js"></script>
<script src="backend/plugins/jquery-ui.js"></script>


@if(isset($config['js']) && is_array($config['js']))
    @foreach($config['js'] as $key => $val)
        {!! '<script src="'.$val.'"></script>' !!}
    @endforeach
@endif

<script>
    const formatPrice = (value) => {
        value = value.replace(/\D/g, '');
        if (!value) return '';
        return value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }
    // document.getElementById('priceInput').addEventListener('input', function() {
    //     let value = this.value;
    //     this.value = formatPrice(value);
    // });
    document.getElementById('priceInput').addEventListener('blur', function() {
        let value = this.value;
        this.value = formatPrice(value);
    });
    </script>