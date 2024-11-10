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

    HT.menuRowHtml = (option) => {
        let row = $('<tr>').addClass((typeof option !== 'undefined' && option.name) ? option.name : 'default-class');

        let nameColumn = $('<td>').append(
            $('<input>').attr({
                type: 'text',
                name: 'menu[name][]',
                value: (typeof (option) != 'undefined') ? option.name : '',
                placeholder: 'Tên Menu'
            }).addClass('form-control')
        );

        let canonicalColumn = $('<td>').append(
            $('<input>').attr({
                type: 'text',
                name: 'menu[canonical][]',
                value: (typeof (option) != 'undefined') ? option.canonical : '',
                placeholder: 'Đường dẫn'
            }).addClass('form-control')
        );

        let orderColumn = $('<td>').append(
            $('<input>').attr({
                type: 'text',
                name: 'menu[order][]',
                value: '',
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
        $(document).on('click', '.menu-module', function () {
            let _this = $(this);
            let option = {
                model: _this.attr('data-model')
            };

            HT.sendAjaxGetMenu(option, _this);

        });
    };



    HT.renderModelMenu = (object) => {
        let html = '';

        html += '<div class="m-item">';
        html += '<div class="uk-flex uk-flex-middle">';
        html += '<input type="checkbox" class="m0 choose-menu" value="' + object.canonical + '" name="" id="id_' + object.canonical + '">';
        html += '<label for="id_' + object.canonical + '">' + object.name + '</label>';
        html += '</div>';
        html += '</div>';

        return html;
    };

    HT.chooseMenu = () => {
        $(document).on('click', '.choose-menu', function () {
            let _this = $(this);
            let canonical = _this.val();
            let name = _this.siblings('label').text();
            let $row = HT.menuRowHtml({
                name: name,
                canonical: canonical,
            });

            if (_this.prop('checked')) {
                $('.menu-wrapper').append($row);
                $('.menu-table').find('.not').hide();
            } else {
                $('.menu-wrapper tr').each(function () {
                    let rowCanonical = $(this).find('input[name="menu[canonical][]"]').val();
                    if (rowCanonical === canonical) {
                        $(this).remove();
                    }
                });
            }
        });
    };

    HT.menuLinks = (links) => {
        let paginationUl = $('<ul>').addClass('pagination');

        $.each(links, function (index, link) {
            let liClass = 'page-item';
            if (link.active) {
                liClass += ' active';
            } else if (!link.url) {
                liClass += ' disabled';
            }

            let li = $('<li>').addClass(liClass);
            if (link.label === 'pagination.previous') {
                let span = $('<span>').addClass('page-link').attr('aria-hidden', true).html('‹');
                li.append(span);
            }

            else if (link.label === 'pagination.next') {
                let span = $('<span>').addClass('page-link').attr('aria-hidden', true).html('›');
                li.append(span);
            }

            else if (link.url) {
                let a = $('<a>').addClass('page-link').text(link.label).attr('href', link.url);
                li.append(a);
            }

            paginationUl.append(li);
        });

        let nav = $('<nav>').append(paginationUl);

        return nav.prop('outerHTML');
    }

    HT.sendAjaxGetMenu = (option, _this) => {
        $.ajax({
            url: 'ajax/dashboard/getMenu',
            type: 'GET',
            data: option,
            dataType: 'json',
            beforeSend: function () {
                _this.parents('.accordion-item').find('.menu-list').html('');
            },
            success: function (res) {
                console.log(res);
                console.log(res.links)
                let html = '';
                for (let i = 0; i < res.data.length; i++) {
                    html += HT.renderModelMenu(res.data[i]);
                }

                html += HT.menuLinks(res.links);

                _this.parents('.accordion-item').find('.menu-list').html(html);

                console.log($('#paginationMenu').html());
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
            }
        });
    };

    HT.getPaginationMenu = () => {
        $(document).on('click', '.page-link', function (e) {
            e.preventDefault()
            let _this = $(this);
            let option = {
                model: _this.parents('.accordion-collapse').attr('id'),
                page: _this.text()
            }
            console.log(option);

        })
    };


    $(document).ready(function () {
        HT.createMenuCatalogue();
        HT.createMenuRow();
        HT.deleteRow();
        HT.getMenu();
        HT.chooseMenu();
        HT.getPaginationMenu();
    });


})(jQuery);
