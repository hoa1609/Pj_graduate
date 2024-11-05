@include('backend.dashboard.component.nav', ['title' => $config['seo'][$config['method']]['title']])

<div class="container-xxl">
    @php
        $url =
            $config['method'] == 'create'
                ? route('post.catalogue.store')
                : route('post.catalogue.update', $postCatalogue->id);
    @endphp
    <form action="{{$url}}" method="post">
        @csrf
        <div class="row">
            <div class="col-9">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="row g-0 h-100">
                            <div class="col-lg-12 border-end">
                                @include('backend.dashboard.component.formError')
                                <h4 class="card-title fs-16 mb-0 pt-3 ps-4">Thông tin chung</h4>
                                @include('backend.post.catalogue.component.general')
                            </div><!--end col-->

                        </div><!--end row-->
                    </div>
                </div>
                @include('backend.post.catalogue.component.seo')
            </div> <!-- end col -->
            <div class="col-3">
                @include('backend.post.catalogue.component.aside')
            </div>
            <div class="d-flex justify-content-end button-fix">
                <button type="submit" class="btn btn-primary">Lưu lại</button>
            </div>

        </div> <!-- end row -->
    </form>
</div><!-- container -->
<script>
    $(document).ready(function() {
        $(window).scroll(function() {
            if ($(this).scrollTop() > 100) {
                $('.button-fix').addClass('button-fixed');
            } else {
                $('.button-fix').removeClass('button-fixed');
            }
        });
    });
</script>
