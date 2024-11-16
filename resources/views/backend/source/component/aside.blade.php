
   <!-- <div class="ibox slide-seting slide-normal"> -->
    <div class="ibox-title">
        <h4 class="card-title">Cài đặt cơ bản</h4>
    </div>

    <div class="ibox-content">
        <div class="row mb15">
            <div class="col-lg-12 mb10">
                <div class="form-row">
                <label class="form-label">Tên Widget
                                    <span class="text-danger fs-10"> (*)</span>
                                </label>

                        <input class="form-control"
                            name="name"
                            type="text"
                            placeholder=""
                            value="{{ old('name', ($source-> name) ?? '' ) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb10">
                <div class="form-row">
                <label class="form-label">Từ khóa Widget
                                    <span class="text-danger fs-10"> (*)</span>
                                </label>

                        <input class="form-control"
                            name="keyword"
                            type="text"
                            placeholder=""
                            value="{{ old('keyword', ($source-> keyword) ?? '' ) }}">
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mb10">
                <div class="form-row">
                <label class="form-label">Short Code
                                    <span class="text-danger fs-10"> (*)</span>
                                </label>
                    <textarea name="short_code" class="textarea form-control">

                           {{ old('short_code', ($source-> short_code) ?? null ) }}</textarea>
                    </div>
                </div>
            </div>
            <br>
        <div class="text-end">
            <button type="submit" name="send" class="btn btn-primary">Lưu lại </button>
        </div>
    </div>
    </form>
</div>

<script>
    var province_id = '{{ (isset($user->province_id)) ? $user->province_id : old('
    province_id ') }}'
    var district_id = '{{ (isset($user->district_id)) ? $user->district_id : old('
    district_id ') }}'
    var ward_id = '{{ (isset($user->ward_id)) ? $user->ward_id : old('
    ward_id ') }}'
</script>
