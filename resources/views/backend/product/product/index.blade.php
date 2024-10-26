<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @include('backend.product.product.component.filter')
                @include('backend.product.product.component.table')
            </div>
        </div>  
    </div>
</div>