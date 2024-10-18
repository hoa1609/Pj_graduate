<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">                      
                            <h4 class="card-title">{{ $config['seo']['title'] }}</h4>                      
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
                @php
                    $url = ($config['method'] == 'create') ? route('user.role.store') : route('user.role.update', $userRoles-> id);
                @endphp
                <div class="card-body pt-0">
                    <form action="{{ $url }}" method="post" >
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3 row">
                                    <label for="example-text-input" class="col-sm-2 col-form-label text-end">Tên nhóm</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" 
                                        name="name" 
                                        type="text"
                                         placeholder="nhập tên nhóm..."
                                         value="{{ old('name', ($userRoles-> name) ?? '' ) }}"
                                         >
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">  
                                <div class="mb-3 row" >
                                    <label for="example-password-input" class="col-sm-2 col-form-label text-end">Ghi chú</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" 
                                        name="description"
                                        type="text" 
                                        placeholder="nhập ghi chú..."
                                        value="{{ old('description', ($userRoles-> description) ?? '' ) }}"
                                        >
                                    </div>
                                </div>
                            </div>
                            <div class="text-end"> 
                                <button type="submit" name="send" class="btn btn-primary">Lưu thông tin</button>
                            </div>
                        </div>
                    </form>               
                </div>
            </div>
        </div>                                                       
    </div>
</div>

<script>
    var province_id = '{{ (isset($user->province_id)) ? $user->province_id : old('province_id') }}'
    var district_id = '{{ (isset($user->district_id)) ? $user->district_id : old('district_id') }}'
    var ward_id = '{{ (isset($user->ward_id)) ? $user->ward_id : old('ward_id') }}'
</script>