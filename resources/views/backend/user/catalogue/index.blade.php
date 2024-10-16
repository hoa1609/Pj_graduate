@include('backend.dashboard.component.nav',['title' => $config['seo']['index']['title']])
<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">{{ $config['seo']['index']['table'] }}</h4>
                            @include('backend.dashboard.component.toolbox', ['model' => 'UserCatalogue'])
                        </div>
                    </div>
                </div>

                @include('backend.user.catalogue.component.filter')
                @include('backend.user.catalogue.component.table')
            </div>
        </div>
    </div>
</div>
