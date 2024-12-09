<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="row g-0 h-100">
                        <div class="col-lg-12 border-end">
                            <h4 class="card-title fs-16 mb-0 pt-3 ps-4">Bạn đang muốn xóa slide có tên là: {{ $slide->name }} </h4>
                            <form action="{{ route('slide.destroy', $slide->id) }}" method="post" class="p-4 pt-3">
                                @csrf
                                @method('DELETE')
                                <div class="form-group mb-2 mb-lg-1">
                                    <div class="row">
                                        <div class="col-lg-6 col-12 mb-2 mb-lg-3 ">
                                            <label class="form-label">Tên slide
                                                <span class="text-danger">(*)</span>
                                            </label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{ old('name', ($slide->name) ?? '') }}" readonly>
                                        </div>

                                    </div>
                                </div>
                                    <button type="submit" class="btn btn-danger mt-3">Xóa</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
