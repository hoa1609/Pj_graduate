<div class="card">
    <div class="card-body">
        <div class="card-header p-0 pb-2">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">Chọn danh mục cha</h4>
                </div><!--end col-->
            </div> <!--end row-->
        </div>
        <div class="form-group mb-2 mb-lg-1">
            <div class="row">
                <div class="col-lg-col-12 ">
                    <select name="parent_id" class="form-control setupSelect2" id="">
                        @foreach ($dropdown as $key => $val)
                            <option
                                {{ $key == old('parent_id', isset($postCatalogue->parent_id) ? $postCatalogue->parent_id : '')
                                    ? 'selected'
                                    : '' }}
                                value="{{ $key }}">{{ $val }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div><!--end card-body-->
    </div><!--end card-->
</div> <!--end col-->
<div class="card">
    <div class="card-body">
        <div class="card-header p-0 pb-2">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">Chọn ảnh đại diện</h4>
                </div><!--end col-->
            </div> <!--end row-->
        </div>
        <div class="row mb-2">
            <div class="col-lg-col-12 ">
                <span class="image img-cover image-target">
                    <img src="{{ old('image', $postCatalogue->image ?? '/backend/assets/images/no-image.png') ?? '/backend/assets/images/no-image.png' }}" alt="">
                </span>
                <input type="hidden" name="image" value="{{ old('image', $postCatalogue->image ?? '') }}">
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="card-header p-0 pb-3">
            <div class="row align-items-center">
                <div class="col">
                    <h4 class="card-title">Cấu hình nâng cao</h4>
                </div><!--end col-->
            </div> <!--end row-->
        </div>
        <div class="row mb-2">
            <div class="col-lg-col-12 ">
                <select name="publish" class="form-control setupSelect2" id="">
                    @foreach (config('apps.general.publish') as $key => $val)
                        <option
                            {{ $key == old('publish', isset($postCatalogue->publish) ? $postCatalogue->publish : '') ? 'selected' : '' }}
                            value="{{ $key }}">{{ $val }} </option>
                    @endforeach
                </select>
            </div>

        </div>
        <div class="row mb-2">
            <div class="col-lg-col-12 ">
                <select name="follow" class="form-control setupSelect2" id="">
                    @foreach (config('apps.general.follow') as $key => $val)
                        <option
                            {{ $key == old('follow', isset($postCatalogue->follow) ? $postCatalogue->follow : '') ? 'selected' : '' }}
                            value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
