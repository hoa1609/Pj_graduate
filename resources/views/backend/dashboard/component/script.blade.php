<script src="backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="backend/assets/libs/simplebar/simplebar.min.js"></script>
<script src="backend/assets/data/stock-prices.js"></script>
<script src="backend/assets/libs/jsvectormap/js/jsvectormap.min.js"></script>
<script src="backend/assets/libs/jsvectormap/maps/world.js"></script>
<script src="backend/assets/js/app.js"></script>

@if(isset($config['js']) && is_array($config['js']))
    @foreach($config['js'] as $key => $val)
        {!! '<script src="'.$val.'"></script>' !!}
    @endforeach
@endif

