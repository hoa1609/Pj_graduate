<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col">
                <h4 class="card-title">Danh sách slides</h4>
            </div><!--end col-->
            <div class="col text-end">
                <button type="button" class="addSlide btn btn-primary">Thêm Slide</button>
            </div>
        </div> <!--end row-->
        <hr class="dashed-line">
    </div><!--end card-header-->
    @php
        $slides = old('slide', ($slideItem) ?? []);
        $i = 1;
    @endphp
    <div class="card-body pt-0">
        <div id="sortable" class="row slide-list sortui ui-sortable-slide">
            <div class="text-danger slide-notification" {{ (is_array($slides) && count($slides) > 0) ? 'hidden' : '' }}>Chưa có hình ảnh nào được chọn...</div>
            @if (is_array($slides) && count($slides))
                @foreach ($slides['image'] as $key => $val)
                @php
                    $image = $val;
                    $description = $slides['description'][$key];
                    $canonical = $slides['canonical'][$key];
                    $name = $slides['name'][$key];
                    $alt = $slides['alt'][$key];
                    $window = (isset($slides['window'][$key])) ? $slides['window'][$key] : '';
                @endphp
                    <div class="col-lg-12 ui-state-default">
                        <div class="slide-item">
                            <div class="row">
                                <div class="col-4 position-relative">
                                    <img class="img-fluid img-slide" src="{{ $val }}" alt="">
                                    <input type="hidden" name="slide[image][]" value="{{ $val }}">
                                    <span class="deleteSlide btn btn-danger"><i class="icofont-ui-delete menu-icon"></i></span>
                                </div>
                                <div class="col-8">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#tab{{ $i }}" role="tab" aria-selected="true">Thông tin chung</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" data-bs-toggle="tab" href="#tab{{ $i + 1 }}" role="tab" aria-selected="false" tabindex="-1">SEO</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane p-2 active" id="tab{{ $i }}" role="tabpanel">
                                            <label class="form-label">Mô tả</label>
                                            <textarea class="form-control mb-2" name="slide[description][]" rows="3">{{ old('slide.description.' . $key, $description) }}</textarea>
                                            <div class="row mb-2">
                                                <div class="col-lg-8 col-md-6 col-sm-12">
                                                    <input class="form-control" type="text" name="slide[canonical][]" value="{{ old('slide.canonical.' . $key, $canonical) }}" placeholder="URL">
                                                </div>
                                                <div class="col-lg-4 col-md-6 col-sm-12">
                                                    <div class="form-check pt-1">
                                                        <input
                                                                type="checkbox"
                                                                name="slide[window][{{ $key }}]"
                                                                id="input_{{ $key }}"
                                                                value="_blank"
                                                                {{
                                                                    ($window == '_blank') ?
                                                                    'checked' : ''
                                                                }}
                                                                class="form-check-input"
                                                            >
                                                        <label class="form-check-label" for="input_{{ $key }}">Mở trong tab mới</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane p-2" id="tab{{ $i + 1 }}" role="tabpanel">
                                            <div class="form-contol mb-2">
                                                <label class="form-label">Tiêu đề ảnh</label>
                                                <input class="form-control" type="text" name="slide[name][]" value="{{ old('slide.name.' . $key, $name) }}" placeholder="Nhập tiêu đề">
                                            </div>
                                            <div class="form-contol mb-2">
                                                <label class="form-label">Mô tả ảnh</label>
                                                <input class="form-control" type="text" name="slide[alt][]" value="{{ old('slide.alt.' . $key, $alt) }}" placeholder="Nhập mô tả">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="dashed-line mt-3">
                    </div>
                    @php
                        $i += 2; // Tăng $i sau mỗi slide
                    @endphp
                @endforeach
           @endif

        </div>
    </div><!--end card-body-->