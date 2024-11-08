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

            // Thêm một dòng mới vào bảng
            let newRow = HT.menuRowHtml();

            $('.menu-table tbody').append(newRow);  // Thêm dòng vào tbody của bảng

            // Ẩn thông báo nếu có dòng nhập liệu
            $('.hid').hide().append(HT.menuRowHtml);
        });
    };

    HT.menuRowHtml = () => {
        let row = $('<tr>');  // Tạo dòng mới

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

            // Xác định dòng cần xóa (dòng chứa nút xóa được nhấn)
            let row = $(this).closest('tr');

            // Xóa dòng khỏi bảng
            row.remove();

            // Kiểm tra lại số lượng dòng trong bảng
            if ($('.menu-table tbody tr').length === 0) {  // Nếu không còn dòng nào
                $('.hid').show();  // Hiển thị thông báo nếu không còn dòng nhập liệu
            } else {
                $('.hid').hide();  // Ẩn thông báo nếu còn dòng nhập liệu
            }
        });
    };



    $(document).ready(function () {
        HT.createMenuCatalogue();
        HT.createMenuRow();
        HT.deleteRow();
    });


})(jQuery);
