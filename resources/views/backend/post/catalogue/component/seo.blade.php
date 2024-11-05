<div class="card">
    <div class="card-body p-0">
        <div class="row g-0 h-100">
            <div class="col-lg-12 border-end">
                <h4 class="card-title fs-16 mb-0 pt-3 ps-4">Cấu hình seo</h4>
                <div class="seo-content p-4 mb-3">
                    <div class="seo-container">
                        <div class="meta-title">
                            {{ old('meta_title', $postCatalogue->meta_title ?? '') ?? 'Đây là tiêu đề SEO' }}
                        </div>
                        {{-- <div class="canonical">
                            {{ old('canonical', url('/') . '.html') }}
                        </div> --}}
                        <div class="canonical">
                            {{ (old('canonical', ($postCatalogue->canonical) ??
                            ''))? config('app.url').old('canonical', ($postCatalogue->canonical ) ??
                            '').
                            config('apps.general.suffix'): 'https://duong-dan-cua-ban.html'}}
                        </div>
                        <div class="meta-description">
                            {{ old('meta_description') ?? 'Đây là mô tả SEO' }}
                        </div>
                    </div>
                    <div class="seo-wrapper">
                        <div class="pe-4">
                            <div class="form-group mb-2 mb-lg-1">
                                <div class="row">
                                    <div class="col-lg-12 col-12 mb-2 mb-lg-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label class="form-label">Tiêu đề SEO</label>
                                            <label class="count_meta-title form-label">0 ký tự</label>
                                        </div>
                                        <input class="form-control" type="text" name="meta_title"
                                            value="{{ old('meta_title', $postCatalogue->meta_title ?? '') }}"
                                            placeholder="Nhập Tiêu Đề SEO">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-12 mb-2 mb-lg-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label class="form-label">Từ khóa SEO</label>

                                        </div>
                                        <input class="form-control" type="text" name="meta_keyword"
                                            value="{{ old('meta_keyword', $postCatalogue->meta_keyword ?? '') }}"
                                            placeholder="Nhập Từ Khóa SEO">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-12 mb-2 mb-lg-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label class="form-label">Mô tả SEO</label>
                                            <label class="count_meta-description form-label">0 ký tự</label>
                                        </div>
                                        <textarea name="meta_description" class="form-control">{{ old('meta_description', $postCatalogue->meta_description ?? '') }}</textarea>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-12 mb-2 mb-lg-3">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <label class="form-label">Đường dẫn
                                                <span class="text-danger">(*)</span>
                                            </label>
                                        </div>
                                        <div class="input-wrapper">
                                            <input class="form-control seo-canonical" type="text" name="canonical"
                                                value="{{ old('canonical', $postCatalogue->canonical ?? '') }}"
                                                style="color: navy">
                                            <span class="baseUrl">{{ url('/') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div><!--end col-->
                        </div>
                    </div>
                </div>
            </div><!--end col-->

        </div><!--end row-->
    </div>
</div>
