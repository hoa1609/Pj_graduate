<div class="container-xxl">
    <div class="row justify-content-center">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="card-title">Danh sách quyền</h4>
                        </div>
                    </div>
                </div>

                <form action="{{ route('user.role.updatePermission') }}" method="post">
                    @csrf
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table mb-0 table-centered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Danh sách chức năng</th>
                                        <th></th>
                                        @foreach ($userCatalogues as $userCatalogue)
                                        <th class="text-center text-capitalize">{{ $userCatalogue-> name }}</th>
                                        @endforeach
                                    </tr>
                                </thead>

                                
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td class="text-capitalize"> {{ $permission-> name }}</td>
                                            <td> {{ $permission-> canonical }}</td>

                                            @foreach ($userCatalogues as $userCatalogue)
                                            <td class="text-center">

                                                {{-- @php
                                                    dd($userCatalogue-> permissions);
                                                @endphp --}}

                                                <input {{ (collect($userCatalogue-> permissions)->contains('id', $permission-> id)) ? 'checked' : '' }} type="checkbox" name="permission[{{ $userCatalogue-> id }}][]" class="form-check-input " value="{{ $permission-> id }}">
                                            </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-end pb-3 pe-3"> 
                        <button type="submit" name="send" class="btn btn-primary">Lưu thông tin</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>