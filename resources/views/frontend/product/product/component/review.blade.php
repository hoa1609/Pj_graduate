@php
    $totalReviews = $model->reviews()->count();
    $rating = $product->average_star;
    $rangeStartTotal = $rating /5 * 100;
    $htmlStar = '<div class="is-active"><svg height="11" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M381.2 150.3L524.9 171.5C536.8 173.2 546.8 181.6 550.6 193.1C554.4 204.7 551.3 217.3 542.7 225.9L438.5 328.1L463.1 474.7C465.1 486.7 460.2 498.9 450.2 506C440.3 513.1 427.2 514 416.5 508.3L288.1 439.8L159.8 508.3C149 514 135.9 513.1 126 506C116.1 498.9 111.1 486.7 113.2 474.7L137.8 328.1L33.58 225.9C24.97 217.3 21.91 204.7 25.69 193.1C29.46 181.6 39.43 173.2 51.42 171.5L195 150.3L259.4 17.97C264.7 6.954 275.9-.0391 288.1-.0391C300.4-.0391 311.6 6.954 316.9 17.97L381.2 150.3z"></path></svg></div>';
@endphp
<div id="ec-spt-nav-review" class="tab-pane fade show active">
    <div class="row">
        <div class="review-heading">
            {{ $name }}
        </div>
        <div class="container p-4">
            <div class="row">
                <div class="col-lg-4 uk-flex flex-column uk-align-center border-right">
                    <div class="avg-star">{{ $rating }}/5</div>
                    <div class="stars">
                        <div class="stars-active" style="width: {{ $rangeStartTotal }}%;"></div>
                    </div>
                    <div class="total-rate">{{ $totalReviews }} đánh giá</div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-7 item-progress">
                    @for($i = 5; $i >= 1; $i--)
                    @php
                        $countStar = $model->reviews()->where('score', $i)->count();
                        $startPercent = ($countStar > 0) ? $countStar/$totalReviews *100 : 0;
                    @endphp
                        <div class="item">
                            <div class="col-md-1 item-number-rating"><span class="text-number-rating">{{ $i }}</span>{!! $htmlStar !!}</div>
                            <div class="col-md-9">
                                <div class="progress">
                                    <div class="progress-bar" style="width: {{ $startPercent }}%"></div>
                                </div>
                            </div>
                            <div class="col-md-2 fs-12 ms-2">{{ $countStar }} đánh giá</div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
    <div class="ec-ratting-content">
        <div class="review-heading fs-16">Đánh giá sản phẩm</div>
        <div class="ec-ratting-form">
            <div class="ec-ratting-star">
                <div class="rating">
                    @php
                        $ratings = [
                            1 => 'Tệ',
                            2 => 'Không hài lòng',
                            3 => 'Bình thường',
                            4 => 'Tốt',
                            5 => 'Tuyệt vời'
                        ];
                    @endphp
                    @foreach ($ratings as $value => $title)
                        <label class="rating-label" for="radio-{{ $value }}" aria-label="Rating {{ $value }}">
                            <input 
                                type="radio" 
                                name="rating" 
                                id="radio-{{ $value }}" 
                                class="sr-only" 
                                title="{{ $title }}" 
                                value="{{ $value }}" 
                                {{ $value === 3 ? 'checked' : '' }}
                            >
                        </label>
                    @endforeach
                </div>
                <div class="rate-text d-none">
                    Bình thường
                </div>
            </div>
            <!-----       ---->
            <div class="row">
                <div class="col-md-8 mb-2">
                    <input class="form-control border-h-5" 
                    name="fullname" placeholder="Họ tên (bắt buộc)" type="text">
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mb-2">
                    <input class="form-control border-h-5" 
                    name="email" placeholder="Email (bắt buộc)" type="email" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mb-2">
                    <input class="form-control border-h-5" 
                    name="phone" placeholder="Số điện thoại (bắt buộc)" type="text">
                </div>
            </div>
            <div class="row form-submit">
                <div class="col-md-8 text-end">
                    <textarea name="content" class="review-textarea" placeholder="Nội dung bình luận của bạn"></textarea>
                    <button style="font-size: 16px" class="btn btn-primary btn-review border-10" type="submit" value="send" name="create">Viết đánh giá</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="ec-t-review-wrapper">
            @if (!is_null($product->reviews))
                @foreach ($product->reviews as $review)
                    @php
                        $avatar = getReviewName($review->fullname);
                        $name = $review->fullname;
                        $email = $review->email;
                        $time = convertDateTime($review->created_at);
                        $phone = $review->phone;
                        $description = $review->description;
                        $rating = generateStar($review->score);
                    @endphp
                    <div class="ec-t-review-item mb-3">
                        <div class="ec-t-review-avatar d-flex align-items-center justify-content-center rounded-circle border me-2">
                            {{ $avatar }}
                        </div>
                        <div class="ec-t-review-content">
                            <div class="ec-t-review-top">
                                <div class="item-time-review">
                                    <div class="ec-t-review-name me-4">{{ $name }}</div>
                                    <span class="time-review"><ion-icon name="time-outline" class="clock-review"></ion-icon>{{ $time }}</span>
                                </div>
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
    </div>
</div>
    
<input type="hidden" value="{{ $reviewable }}" class="reviewable_type">
<input type="hidden" value="{{ $model->id }}" class="reviewable_id">
<input type="hidden" value="0" class="review_parent_id">
