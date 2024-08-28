<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">Quản lý thành viên</h4>                      
                        </div>
                    </div>                                    
                </div>

                @include('backend.user.component.filter')
                @include('backend.user.component.table')
                
            </div>
        </div>  
    </div>
</div>