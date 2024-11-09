(function ($) {
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');

    HT.createMenuCatalogue = () => {
        $(document).on('submit', '.create-menu-catalogue', function (e) {
            e.preventDefault();
            let _form = $(this);

            let option = {
                'name': _form.find('input[name="name"]').val(),
                'keyword': _form.find('input[name="keyword"]').val(),
                '_token': _token
            };

            $.ajax({
                url: 'ajax/menu/createCatalogue',
                type: 'POST',
                data: option,
                dataType: 'json',

                success: function (res) {
                    console.log(res);

                    if (res.code == 0) {
                        $('.form-error').removeClass('text-danger').addClass('text-success')
                            .html(res.message).show();

                        const menuCatalogueSelect = $('select[name=menu_catalogue_id]');
                        menuCatalogueSelect.append('<option value="' + res.data.id + '">' + res.data.name + '</option>');
                    } else {
                        $('.form-error').removeClass('text-success').addClass('text-danger')
                            .html(res.message).show();
                    }
                },

                beforeSend: function () {
                    _form.find('.error').html('');
                },

                error: function (jqXHR, textStatus, errorThrown) {
                    if (jqXHR.status === 422) {
                        let errors = jqXHR.responseJSON.errors;
                        for (let field in errors) {
                            let errorMessage = errors[field];
                            let errorContainer = $('.' + field);
                            errorContainer.html('');
                            errorMessage.forEach(function (message) {
                                errorContainer.append('<p class="text-danger">' + message + '</p>');
                            });
                        }
                    } else {
                        console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                    }
                }

            });
        });
    };

    HT.createMenuRow = () => {
        $(document).on('click', '.add-menu', function (e) {
            e.preventDefault();
            let newRow = HT.menuRowHtml();
            $('.menu-table tbody').append(newRow);
            HT.checkMenuLength();
        });
    };

    HT.menuRowHtml = () => {
        let row = $('<tr>');

        let nameColumn = $('<td>').append(
            $('<input>').attr({
                type: 'text',
                name: 'menu[name][]',
                placeholder: 'Tên Menu'
            }).addClass('form-control')
        );

        let canonicalColumn = $('<td>').append(
            $('<input>').attr({
                type: 'text',
                name: 'menu[canonical][]',
                placeholder: 'Đường dẫn'
            }).addClass('form-control')
        );

        let orderColumn = $('<td>').append(
            $('<input>').attr({
                type: 'text',
                name: 'menu[order][]',
                placeholder: 'Vị trí'
            }).addClass('form-control')
        );

        let deleteColumn = $('<td>').addClass('text-center').append(
            $('<button>').attr({
                type: 'button'
            }).addClass('btn btn-link text-danger').append(
                $('<i>').addClass('fas fa-times')
            )
        );

        row.append(nameColumn, canonicalColumn, orderColumn, deleteColumn);

        return row;
    };

    HT.deleteRow = () => {
        $(document).on('click', '.btn-link.text-danger', function (e) {
            e.preventDefault();

            let row = $(this).closest('tr');
            row.remove();

            HT.checkMenuLength();
        });
    };


    HT.checkMenuLength = () => {
        let rowCount = $('.menu-table tbody tr').not('.hid').length;

        if (rowCount === 0) {
            $('.hid').show();
        } else {
            $('.hid').hide();
        }
    };

    HT.getMenu = () => {
        $('#menuAccordion').on('click', '.menu-module', function (e) {
            e.preventDefault();
            let _this = $(this);
            let model = _this.attr('data-model');

            if (_this.hasClass('loading')) {
                return;
            }

            _this.addClass('loading');
            _this.find('.menu-text').hide();
            _this.find('.menu-loading').removeClass('d-none');

            $.ajax({
                url: `{{ route('ajax.dashboard.getMenu') }}?model=${model}`,
                type: 'GET',
                dataType: 'json',
                success: function (res) {
                    _this.removeClass('loading');
                    _this.find('.menu-text').show();
                    _this.find('.menu-loading').addClass('d-none');

                    if (res.data) {
                        let menuList = _this.closest('.accordion-item').find('.menu-list');
                        if (menuList.length) {
                            menuList.html(res.data);
                        }
                    } else {
                        alert('Không có dữ liệu để hiển thị.');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    _this.removeClass('loading');
                    _this.find('.menu-text').show();
                    _this.find('.menu-loading').addClass('d-none');
                    console.error('Lỗi:', textStatus, errorThrown);
                    alert('Không thể tải dữ liệu. Vui lòng thử lại sau.');
                }
            });
        });
    };



    $(document).ready(function () {
        HT.createMenuCatalogue();
        HT.createMenuRow();
        HT.deleteRow();
        HT.getMenu();
    });


})(jQuery);
