(function($) {
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');

    HT.chooseReviewStar = () => {
        $(document).on('click', '.rating-label', function() {
            let _this = $(this);
            let title = _this.find('input').attr('title');
            $('.rate-text').removeClass('d-none').html(title);
        });
    }

    HT.review = () => {
        toastr.options = {
            "positionClass": "toast-top-right",
            "closeButton": true,
            "progressBar": true,
            "timeOut": "3000",
            "extendedTimeOut": "1000"
        }

        $(document).on('click', '.btn-review', function() {
            let option = {
                score: $('input[name="rating"]:checked').val() || $('input[name="rating"]:checked').attr('id').replace('radio-', ''),
                description: $('.review-textarea').val(),
                fullname: $('.ec-ratting-form input[name=fullname]').val(),
                email: $('.ec-ratting-form input[name=email]').val(),
                phone: $('.ec-ratting-form input[name=phone]').val(),
                reviewable_type: $('.reviewable_type').val(),
                reviewable_id: $('.reviewable_id').val(),
                _token: _token,
                parent_id: $('.review_parent_id').val(),
            }

            $.ajax({
                url: 'ajax/review/create',
                type: 'POST',
                data: option,
                dataType: 'json',
                success: function(res) {
                    if(res.code == 10) {
                        toastr.success(res.message);
                        location.reload()
                    } else {
                        toastr.error(res.message);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        Object.keys(errors).forEach(function(key) {
                            toastr.error(errors[key][0]);
                        });
                    } else {
                        toastr.error('Có lỗi xảy ra, vui lòng thử lại');
                    }
                }
            })
        })
    }


    $(document).ready(function() {
        HT.chooseReviewStar()
        HT.review()
    });

})(jQuery);



//copy sku
document.getElementById('copy-sku').addEventListener('click', function() {
    const skuText = document.getElementById('sku-text').innerText;
    navigator.clipboard.writeText(skuText).then(function() {
        toastr.success('Đã sao chép');
    }).catch(function(error) {
        toastr.error('Có lỗi xảy ra, vui lòng thử lại');
    });
});
