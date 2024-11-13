(function ($) {
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content');

    HT.createMenuCatalogue = () => {
        $(document).on('submit', '.create-menu-catalogue', function (e) {
            e.preventDefault();
            let _form = $(this);
            let option = {
                name: _form.find('input[name="name"]').val(),
                keyword: _form.find('input[name="keyword"]').val(),
                _token
            };

            $.post('ajax/menu/createCatalogue', option, function (res) {
                const formError = $('.form-error').removeClass('text-danger text-success');
                formError.addClass(res.code === 0 ? 'text-success' : 'text-danger').html(res.message).show();

                if (res.code === 0) {
                    $('select[name=menu_catalogue_id]').append(`<option value="${res.data.id}">${res.data.name}</option>`);
                }
            }, 'json').fail(handleAjaxErrors);
        });
    };

    HT.createMenuRow = () => {
        $(document).on('click', '.add-menu', function (e) {
            e.preventDefault();
            $('.menu-table tbody').append(HT.menuRowHtml());
            HT.checkMenuLength();
        });
    };

    HT.menuRowHtml = (option = {}) => {
        return $('<tr>').addClass(option.canonical || 'default-class').append(
            $('<td>').append($('<input>', { type: 'text', name: 'menu[name][]', value: option.name || '', placeholder: 'Tên Menu', class: 'form-control' })),
            $('<td>').append($('<input>', { type: 'text', name: 'menu[canonical][]', value: option.canonical || '', placeholder: 'Đường dẫn', class: 'form-control' })),
            $('<td>').append($('<input>', { type: 'text', name: 'menu[order][]', placeholder: 'Vị trí', class: 'form-control' })),
            $('<td>', { class: 'text-center' }).append($('<button>', { type: 'button', class: 'btn btn-link text-danger' }).append($('<i>', { class: 'fas fa-times' })))
        );
    };

    HT.deleteRow = () => {
        $(document).on('click', '.btn-link.text-danger', function () {
            $(this).closest('tr').remove();
            HT.checkMenuLength();
        });
    };

    HT.checkMenuLength = () => {
        $('.hid').toggle($('.menu-table tbody tr').not('.hid').length === 0);
    };

    HT.getMenu = () => {
        $(document).on('click', '.menu-module', function () {
            let target = $(this).closest('.accordion-item').find('.menu-list');
            let option = { model: $(this).data('model') };
            HT.sendAjaxGetMenu(option, target);
        });
    };

    HT.sendAjaxGetMenu = (option, target) => {
        $.getJSON('ajax/dashboard/getMenu', option, function (res) {
            // let html = res.data.map(item => HT.renderModelMenu(item)).join('') + HT.menuLinks(res.links);
            let html = res.data.map(item => HT.renderModelMenu(item)).join('');
            target.html(html);
        }).fail(logAjaxError);
    };

    HT.renderModelMenu = (object) => {
        let checked = object.isChecked ? 'checked' : '';
        return `
            <div class="m-item">
                <div class="uk-flex uk-flex-middle">
                    <input type="checkbox" class="m0 choose-menu" value="${object.canonical}" ${checked} id="id_${object.canonical}">
                    <label for="id_${object.canonical}">${object.name}</label>
                </div>
            </div>`;
    };

    HT.searchMenu = () => {
        let typingTimer;
        $(document).on('keyup', '.search-menu', function () {
            clearTimeout(typingTimer);
            let keyword = $(this).val();
            let target = $(this).closest('.accordion-body').find('.menu-list');
            let model = $(this).closest('.accordion-item').find('a').data('model');

            typingTimer = setTimeout(() => {
                HT.sendAjaxGetMenu({ model, keyword }, target);
            }, keyword.length >= 2 ? 1000 : 0);
        });
    };

    HT.chooseMenu = () => {
        $(document).on('click', '.choose-menu', function () {
            let canonical = $(this).val();
            let name = $(this).siblings('label').text();

            if ($(this).is(':checked')) {
                $('.menu-wrapper').append(HT.menuRowHtml({ name, canonical }));
                $('.menu-table .not').hide();
            } else {
                $(`.menu-wrapper tr input[value="${canonical}"]`).closest('tr').remove();
            }
        });
    };

    // HT.menuLinks = (links) => {
    //     return `<nav><ul class="pagination">` + links.map(link => {
    //         let classes = `page-item${link.active ? ' active' : ''}${link.url ? '' : ' disabled'}`;
    //         let content = link.label === 'pagination.previous' ? '‹' : link.label === 'pagination.next' ? '›' : link.label;
    //         return `<li class="${classes}"><a class="page-link" href="${link.url}" data-page="${link.label}">${content}</a></li>`;
    //     }).join('') + `</ul></nav>`;
    // };

    // HT.getPaginationMenu = () => {
    //     $(document).on('click', '.page-link', function (e) {
    //         e.preventDefault();
    //         let target = $(this).closest('.menu-list');
    //         let model = $(this).closest('.accordion-body').find('.search-model').data('model');
    //         let page = new URL($(this).attr('href')).searchParams.get('page');
    //         HT.sendAjaxGetMenu({ model, page }, target);
    //     });
    // };

    const handleAjaxErrors = (jqXHR) => {
        if (jqXHR.status === 422) {
            let errors = jqXHR.responseJSON.errors;
            for (let field in errors) {
                $(`.${field}`).html(errors[field].map(msg => `<p class="text-danger">${msg}</p>`).join(''));
            }
        } else {
            console.error('Error:', jqXHR.statusText);
        }
    };

    const logAjaxError = (jqXHR) => console.error('Error:', jqXHR.statusText);

    $(document).ready(function () {
        HT.createMenuCatalogue();
        HT.createMenuRow();
        HT.deleteRow();
        HT.getMenu();
        HT.chooseMenu();
        // HT.getPaginationMenu();
        HT.searchMenu();
    });

})(jQuery);
