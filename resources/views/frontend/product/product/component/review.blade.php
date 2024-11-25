@php
    $totalReviews = $model->reviews()->count();
    $totalRate = number_format($model->reviews()->avg('score'), 1);
    $startPercent = ($totalReviews  == 0) ? '0' : $totalRate/5*100;
    // echo $startPercent;

    // $fiveStart = $model->reviews()->where('score', 5)->count();
@endphp

<div class="ec-single-pro-tab">
    <div class="ec-single-pro-tab-wrapper">
        <div class="ec-single-pro-tab-nav">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <div class="nav-link" style="background-color: #3474D4; color: #fff; cursor: default;">Đánh giá</div>
                </li>
            </ul>
        </div>
        <div class="tab-content  ec-single-pro-tab-content">
            <div id="ec-spt-nav-review" class="tab-pane fade show active">
                <div class="row">
                    <div class="ec-t-review-wrapper">
                        @if (!is_null($product->reviews))
                            @foreach ($product->reviews as $review)
                                @php
                                    $avatar = getReviewName($review->fullname);
                                    $name = $review->fullname;
                                    $email = $review->email;
                                    $phone = $review->phone;
                                    $description = $review->description;
                                    $rating = generateStar($review->score);
                                @endphp
                                <div class="ec-t-review-item mb-3">
                                    <div class="ec-t-review-avatar d-flex align-items-center justify-content-center rounded-circle border me-4">
                                        {{ $avatar }}
                                    </div>

                                    <div class="ec-t-review-content">
                                        <div class="ec-t-review-top">
                                            <div class="ec-t-review-name">{{ $name }}</div>
                                            {!! $rating !!}
                                        </div>
                                        <div class="ec-t-review-bottom">
                                            <p>{{ $description }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="ec-ratting-content">
                        <h3>Đánh giá sản phẩm</h3>
                        <div class="ec-ratting-form">
                            <div class="ec-ratting-star">
                                <div class="rating">
                                    <label class="rating-label" for="radio-1" aria-label="Rating 1"><input
                                            type="radio" name="rating" id="radio-1" class="sr-only" title="Tệ"
                                            value="1"></label>
                                    <label class="rating-label" for="radio-2" aria-label="Rating 2"><input
                                            type="radio" name="rating" id="radio-2" class="sr-only"
                                            title="Không hài lòng" value="2"></label>
                                    <label class="rating-label" for="radio-3" aria-label="Rating 3"><input
                                            type="radio" name="rating" id="radio-3" class="sr-only"
                                            title="Bình thường" checked value="3"></label>
                                    <label class="rating-label" for="radio-4" aria-label="Rating 4"><input
                                            type="radio" name="rating" id="radio-4" class="sr-only" title="Tốt"
                                            value="4"></label>
                                    <label class="rating-label" for="radio-5" aria-label="Rating 5"><input
                                            type="radio" name="rating" id="radio-5" class="sr-only"
                                            title="Tuyệt vời" value="5"></label>
                                </div>
                                <div class="rate-text d-none">
                                    Bình thường
                                </div>
                            </div>
                            <div class="ec-ratting-input">
                                <input name="fullname" placeholder="Nhập họ tên..." type="text" />
                            </div>
                            <div class="ec-ratting-input">
                                <input name="email" placeholder="Nhập vào email*" type="email" required />
                            </div>
                            <div class="ec-ratting-input">
                                <input name="phone" placeholder="Nhập số điện thoại..." type="number" />
                            </div>
                            <div class="ec-ratting-input form-submit">
                                <textarea name="content" class="review-textarea" placeholder="Nhập nội dung bình luận của bạn"></textarea>
                                <button style="font-size: 16px" class="btn btn-primary btn-review" type="submit"
                                    value="send" name="create">Bình luận</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="{{ $reviewable }}" class="reviewable_type">
<input type="hidden" value="{{ $model->id }}" class="reviewable_id">
<input type="hidden" value="0" class="review_parent_id">
