<div class="card-body pt-0">
    <div class="table-responsive">
        <table class="table  mb-0 table-centered border">
            <thead class="table-light">
                <tr>
                    <th style="width: 16px;">
                        <input type="checkbox" class="form-check-input checkBoxItem" id="checkAll">
                    </th>
                    <th>Họ Tên</th>
                    <th>Email</th>
                    <th>Số sao</th>
                    <th>Nội dung</th>
                    <th>Sản phẩm</th>
                    <th class="text-center">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($reviews) && is_object($reviews))
                    @foreach ($reviews as $review)
                    @php
                        $reviewableLink = $review->reviewable->languages->first()->pivot->canonical;
                    @endphp
                        <tr>
                            <th style="width: 16px;">
                                <input type="checkbox" class="form-check-input checkBoxItem" value="{{ $review-> id }}">
                            </th>
                            <td> {{ $review->fullname }}</td>
                            <td> {{ $review->email }}</td>
                            <td class="text-center"> {{ $review->score }}🌟</td>
                            <td style="
                            max-width: 300px;
                            overflow-wrap: break-word;
                            white-space: normal;"> {{ $review->description }}</td>
                            <td>
                                <a href="{{ write_url($reviewableLink) }}" target="_blank"> Xem sản phẩm</a>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('review.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="pading-action" style="border: none; background: transparent;">
                                        <i class="las la-trash-alt text-secondary fs-18"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    {{ $reviews->links('pagination::bootstrap-4') }}
</div>
