(function ($) {
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');
    var typingTimer;
    var doneTyingInterval = 100; //1s

    HT.searchModel = () => {
        $(document).on('keyup', '.search-model', function (e) {

            e.preventDefault()
            let _this = $(this)
            if ($('input[type=radio]:checked').length === 0) {
                alert('ban chua cho model')
                _this.val('')
                return false;
            }

            let keyword = _this.val()
            let option = {
                model: $('input[type=radio]:checked').val(),
                keyword: keyword
            }
            HT.sendAjax(option)
        })
    }

    HT.chooseModel = () => {
        $(document).on('change', '.form-check-input', function () {
            // console.log(123)
            let _this = $(this)
            let option = {
                model: _this.val(),
                keyword: $('.search-model').val()
            }
            $('.search-model-item').html('')
            if (keyword.length >= 2) {
                HT.sendAjax(option)
            }
        })
    }
    HT.sendAjax = (option) => {
        clearTimeout(typingTimer)
        typingTimer = setTimeout(function () {
            $.ajax({
                url: 'ajax/dashboard/findModelObject',
                type: 'GET',
                data: option,
                dataType: 'json',
                success: function (res) {
                    let html = HT.renderSearchResult(res);
                    $('.ajax-search-result-li').html(html).show();  // Assuming this is the container where you want the results to appear.
                },
            });
        }, doneTyingInterval)
    }

    HT.renderSearchResult = (data) => {
        let html = '';
        if (data.length) {
            for (let i = 0; i < data.length; i++) {

                let flag = ($('#model-' + data[i].id).length) ? 1 : 0
                let setChecked = ($('#model-' + data[i].id).length) ? HT.setChecked() : ''
                html += `
                    <li class="d-flex justify-content-between ajax-search-item p-2" 
                    data-flag="${flag}" 
                    data-canonical="${data[i].languages[0].pivot.canonical}" 
                    data-id="${data[i].id}"     
                    data-image="${data[i].image}" 
                    data-name="${data[i].languages[0].pivot.name}"
                    >
                        <span class="name mx-1">${data[i].languages[0].pivot.name}</span>
                        <div class="auto-icon">${setChecked}</div>
                    </li>
                `;
            }
        } else {
            html = '<li class="d-flex justify-content-between p-2">không có kết quả</li>';
        }
        return html;  // return the generated HTML
    }

    HT.setChecked = () => {
        return '<i class="fa-solid fa-check fs-4"></i>';
    }

    HT.unfocusSearchBox = () => {
        $(document).on('click', 'html', function (e) {
            if (!$(e.target).hasClass('search-model-result') && !$(e.target).hasClass('search-model')) {
                $('.ajax-search-result-li').html('')
            }

            $(document).on('click', '.justify-content-between', function (e) {
                e.stopPropagation();
            })
        })
    }

    HT.addModel = () => {
        $(document).on('click', '.ajax-search-item', function (e) {
            e.preventDefault();
            let _this = $(this)
            let data = _this.data();
            let flag = _this.attr('data-flag')
            if (flag == 0) {
                _this.find('.auto-icon').html(HT.setChecked());
                _this.attr('data-flag', 1)
                $('.search-model-item').append(HT.modelTemplate(data))
            } else {
                $('#model-' + data.id).remove()
                _this.find('.auto-icon').html('')
                _this.attr('data-flag', 0)
            }
        })
    }

    HT.modelTemplate = (data) => {
        let html = `
        <li class="d-flex justify-content-between border-bottom p-2 " 
        id="model-${data.id}"
        data-model-id=${data.id}>
            <div class="image">
                <img src="${data.image}" alt="" width="40px" height="40px">
                <span class="name mx-2 fs-6">${data.name}</span>
                <div class="hidden">
                    <input type="text" name="model_id[id][]" value="${data.id}">
                    <input type="text" name="model_id[name][]" value="${data.name}">
                    <input type="text" name="model_id[image][]" value="${data.image}">
                </div>
            </div>
                                            <div class="delete ">
                                                <button type="button" class="btn-close" aria-label="Close"></button>
                                            </div>
                                            </li>
        `;
        return html;
    }

    HT.removeModel = () => {
        $(document).on('click', '.delete', function () {
            let _this = $(this).val()
            $('.search-model-item').html('')
        })
    }

    $(document).ready(function () {
        HT.searchModel();
        HT.chooseModel();
        HT.unfocusSearchBox();
        HT.addModel();
        HT.removeModel();
    })

})(jQuery);

