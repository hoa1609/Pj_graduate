(function($) {
	"use strict";
	var HT = {}; 

    HT.niceSelect = () => {
        $('.niceSelect').niceSelect();
    }


    HT.setupProductVariant = () => {
        if ($('.turnOnVariant').length) {
            $(document).on('change', '.turnOnVariant', function () {
                let _this = $(this);
                let price = $('input[name=price]').val();
                let code = $('input[name=code]').val();

                if (price == '' && code == '') {
                    displayNotification('Bạn phải nhập mục giá tiền và code sản phẩm để sử dụng chức năng này!', 'error');
                    return false;
                }

                if (_this.is(':checked')) {
                    $('.variant-wrapper').removeClass('hidden');
                } else {
                    $('.variant-wrapper').addClass('hidden');
                }
            });
        }
    };

    function displayNotification(message, type) {
        const notification = $('<div>')
            .addClass(`notification ${type}`)
            .text(message)
            .fadeIn(300)
            .delay(3000)
            .fadeOut(300, function () { $(this).remove(); });

        $('body').prepend(notification);
    }


       
    HT.addVariant = () => {
        if ($('.add-variant').length) {
            $(document).on('click', '.add-variant', function () {
                let html = HT.renderVariantItem(attributeCatalogue); 
                $('.variant-body').append(html); 
                $('.variantTable thead').html(''); 
                $('.variantTable tbody').html(''); 
                HT.destroyNiceSelect();
                HT.niceSelect();
                HT.checkMaxAttributeGroup(attributeCatalogue);
                HT.disabledAttributeCatalogueChoose();

            });
        }
    };

    HT.renderVariantItem = (attributeCatalogue) => {
        let options = '';
        for (let i = 0; i < attributeCatalogue.length; i++) {
            options += `<option value="${attributeCatalogue[i].id}">${attributeCatalogue[i].name}</option>`;
        }
        return `
            <div class="row pb-2 variant-item"> 
                <div class="col-lg-3 p-0">
                    <div class="attribute-catalogue">
                        <select name="attributeCatalogue[]" id="" class="select-option choose-attribute niceSelect">
                            <option value="">-- Chọn thuộc tính --</option>
                            ${options} 
                        </select>
                    </div>
                </div>
                <div class="col-lg-8">
                    <input type="text" name="" disabled class="fake-variant form-control hight-42">
                </div>
                <div class="col-lg-1">
                    <button type="button" class="remove-attribute btn btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        `;
    };


    HT.chooseVariantGroup = () => {
        $(document).on('change', '.choose-attribute', function(){
            let _this = $(this)
            let attributeCatalogueId = _this.val()
            if(attributeCatalogueId != 0){
                _this.parents('.col-lg-3').siblings('.col-lg-8').html(HT.select2Variant(attributeCatalogueId))
                $('.selectVariant').each(function(key, index){
                    HT.getSelect2($(this))
                })
            }else{
                _this.parents('.col-lg-3').siblings('.col-lg-8').html('<input type="text" name="attribute['+attributeCatalogueId+'][]" disabled="" class="fake-variant form-control hight-42">')
            }

            HT.disabledAttributeCatalogueChoose();
        })
    }



    HT.disabledAttributeCatalogueChoose = () => {
        let id = [];
        $('.choose-attribute').each(function(){
            let _this = $(this)
            let selected = _this.find('option:selected').val()
            if(selected != 0){
                id.push(selected)
            }
        })
        $('.choose-attribute').find('option').removeAttr('disabled')
        for(let i = 0; i < id.length; i++){
            $('.choose-attribute').find('option[value='+id[i]+']').prop('disabled', true)
        }
        HT.destroyNiceSelect()
        HT.niceSelect()
        $('.choose-attribute').find('option:selected').removeAttr('disabled')
    }


    HT.checkMaxAttributeGroup = (attributeCatalogue) => {
        let variantItem = $('.variant-item').length
        if(variantItem >= attributeCatalogue.length){
            $('.add-variant').remove()
        }else{
            $('.variant-foot').html('<button type="button" class="add-variant">Thêm phiên bản mới</button>')
        }
    }

    HT.removeAttribute = () => {
        $(document).on('click', '.remove-attribute', function(){
            let _this = $(this)
            _this.parents('.variant-item').remove()
            HT.checkMaxAttributeGroup(attributeCatalogue)
            HT.createVariant()
        })
    }
    
    
    HT.destroyNiceSelect = () => {
        if($('.niceSelect').length){
            $('.niceSelect').niceSelect('destroy')
        }
    }

    HT.select2Variant = (attributeCatalogueId) => {
        let html = '<select class="selectVariant variant-'+attributeCatalogueId+' form-control" name="attribute['+attributeCatalogueId+'][]" multiple data-catid="'+attributeCatalogueId+'"></select>'
        return html
    }

    HT.getSelect2 = (object) => {
        let option = {
            'attributeCatalogueId' : object.attr('data-catid')
        }
        $(object).select2({
            minimumInputLength: 1,
            placeholder: 'Nhập tối thiểu 2 kí tự để tìm kiếm',
            ajax: {
                url: 'ajax/attribute/getAttribute',
                type: 'GET',
                dataType: 'json',
                deley: 250,
                data: function (params){
                    return {
                        search: params.term,
                        option: option,
                    }
                },
                processResults: function(data){
                    return {
                        results: data.items
                    }
                },
                cache: true
              
              }
        });
    }



    HT.createProductVariant = () => {
        $(document).on('change', '.selectVariant', function(){
            let _this = $(this)
            HT.createVariant()
        })
    }


    HT.createVariant = () => {
        let attributes = []
        let variants = []
        let attributeTitle = []
        $('.variant-item').each(function () {
            let _this = $(this)
            let attr = []
            let attrVanriant = []
            const attributeCatalogueId = _this.find('.choose-attribute').val()
            const optionText = _this.find('.choose-attribute option:selected').text()
            const attribute = $('.variant-' + attributeCatalogueId).select2('data')

            for (let i = 0; i < attribute.length; i++) {
                let item = {}
                let itemVariant = {}
                item[optionText] = attribute[i].text
                itemVariant[attributeCatalogueId] = attribute[i].id
                attr.push(item)
                attrVanriant.push(itemVariant)
            }
            attributeTitle.push(optionText)
            attributes.push(attr)
            variants.push(attrVanriant)
        })

        attributes = attributes.reduce(
            (a, b) => a.flatMap(d => b.map(e => ({ ...d, ...e })))
        )
        variants = variants.reduce(
            (a, b) => a.flatMap(d => b.map(e => ({ ...d, ...e })))
        )

        HT.createTableHeader(attributeTitle);

        let trClass = []
        attributes.forEach((item, index) => {
            let $row = HT.createVariantRow(item, variants[index])
            let classModified = 'tr-variant-' + Object.values(variants[index]).join(', ').replace(/, /g, '-')
            trClass.push(classModified)
            if (!$('table.variantTable tbody tr').hasClass(classModified)) {
                $('table.variantTable tbody').append($row)
            }
        })

        console.log(trClass)

        $('table.variantTable tbody tr').each(function(){
            const $row = $(this)
            const rowClasses = $row.attr('class')
            if(rowClasses){
                const rowClassArray = rowClasses.split(' ')
                let shouldRemove = false
                rowClassArray.forEach(rowClass => {
                    if(rowClass == 'variant-row'){
                        return
                    } else if (!trClass.includes(rowClass)){
                        shouldRemove = true
                    }
                })
                if(shouldRemove){
                    $row.remove()
                }
            }
        })
        // let html = HT.renderTableHtml(attributes, attributeTitle, variants);
        // $('table.variantTable').html(html)
    }


    
    HT.createVariantRow = (attributeItem, variantItem) =>{
        let attributeString = Object.values(attributeItem).join(', ')
        let attributeId = Object.values(variantItem).join(', ')
        let classModified = attributeId.replace(/, /g,'-')

        let $row = $('<tr>').addClass('variant-row tr-variant-' +classModified)
        let $td 

        $td = $('<td>').append(
            $('<img>').attr('src', '/userfiles/image/product/no-image.jpg').attr('width', '50px').addClass('imageSrc')
        )
        $row.append($td)

        Object.values(attributeItem).forEach(value => {
            $td = $('<td>').text(value)
            $row.append($td)
        })

        $td = $('<td>').addClass('hidden td-variant')
        let mainPrice = $('input[name=price]').val()
        let mainSku = $('input[name=code]').val()
        let inputHiddenFields = [
            { name: 'variant[quantity][]', class: 'variant_quantity' },
            { name: 'variant[sku][]', class: 'variant_sku', value: mainSku + '-' + classModified},
            { name: 'variant[price][]', class: 'variant_price', value: mainPrice},
            { name: 'variant[barcode][]', class: 'variant_barcode'},
            { name: 'variant[file_name][]', class: 'variant_filename' },
            { name: 'variant[file_url][]', class: 'variant_fileurl' },
            { name: 'variant[album][]', class: 'variant_album' },
            { name: 'attribute[name][]', value: attributeString },
            { name: 'attribute[id][]', value: attributeId },
        ]

        $.each(inputHiddenFields, function (_, field) {
            let $input = $('<input>').attr('type', 'text').attr('name', field.name).addClass(field.class)
            if (field.value) {
                $input.val(field.value)
            }
            $td.append($input)
        })
        $row.append($('<td>').addClass('td-quantity').text('-'))
        .append($('<td>').addClass('td-sku').text(mainSku))
        .append($('<td>').addClass('td-price').text(mainPrice))
        .append($td)

        return $row
    }


    HT.createTableHeader = (attributeTitle) => {
        let $thead = $('table.variantTable thead').addClass('table-light')
        let $row = $('<tr>').addClass('border-table')
        $row.append($('<td>').text('Hình ảnh'))
        for(let i = 0; i < attributeTitle.length; i++){
            $row.append($('<td>').text(attributeTitle[i]))
        }
        $row.append($('<td>').text('Số lượng'))
        $row.append($('<td>').text('Sku'))
        $row.append($('<td>').text('Giá tiền'))

        $thead.html($row)
        return $thead
    }


    HT.renderTableHtml = (attributes, attributeTitle, variants) => {
        let html = ''

        html += '<thead class="table-light">'
        html += '<tr class="border-table">'
        html += '<th>Hình ảnh</th>'
        for (let i = 0; i < attributeTitle.length; i++) {
            html += '<th>' + attributeTitle[i] + '</th>'
        }
        html += '<th>Số lượng</th>'
        html += '<th>Giá tiền</th>'
        html += '<th>SKU</th>'
        html += '</tr>'
        html += '</thead>'
        html += ' <tbody>'

        for (let j = 0; j < attributes.length; j++) {
            html += '<tr class="variant-row">'
            html += '<td><img src="/userfiles/image/post/winhome.webp" alt="image" width="50px" class="imageSrc"></td>'

            let attributeArray = []
            let attibuteIdArray = []
            $.each(attributes[j], function (index, value) {
                html += '<td>' + value + '</td>'
                attributeArray.push(value)
            })

            $.each(variants[j], function (index, value) {
                attibuteIdArray.push(value)
            })

            let attributeString = attributeArray.join(',')
            let attibuteId = attibuteIdArray.join(',')

            html += '<td class="td-quantity">-</td>'
            html += '<td class="td-price">-</td>'
            html += '<td class="td-sku">-</td>'
            html += '<td class="hidden td-variant">'
            html += '<input type="text" name="variant[quantity][]" class="variant_quantity">'
            html += '<input type="text" name="variant[sku][]" class="variant_sku">'
            html += '<input type="text" name="variant[price][]" class="variant_price">'
            html += '<input type="text" name="variant[barcode][]" class="variant_barcode">'
            html += '<input type="text" name="variant[file_name][]" class="variant_filename">'
            html += '<input type="text" name="variant[file_url][]" class="variant_fileurl">'
            html += '<input type="text" name="variant[album][]" class="variant_album">'
            html += '<input type="text" name="attribute[name][]" value="' + attributeString + '">'
            html += '<input type="text" name="attribute[id][]" value="' + attibuteId + '">'
            html += '</td>'
            html += '</tr>'
        }
        html += '</tbody>'
        return html;
    }



    HT.variantAlbum = () =>{
        $(document).on('click', '.click-to-upload-variant', function(e){
            HT.browseVariantServerAlbum()
            e.preventDefault()
        })
    }


    

    HT.browseVariantServerAlbum = () => {
        var type = 'Images';
        var finder = new CKFinder();

        finder.resourceType = type;
        finder.selectActionFunction = function (fileUrl, data, allFiles) {
            let html = '';
            for (var i = 0; i < allFiles.length; i++) {
                var image = allFiles[i].url;
                html += `
                    <li class="ui-state-default">
                        <div class="thumb">
                            <span class="span image img-scaledown">
                                <img src="${image}" alt="${image}">
                                <input type="hidden" name="variantAlbum[]" value="${image}">
                            </span>
                            <button class="variant-delete-image">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </li>
                `;
            }
            $('.click-to-upload-variant').addClass('hidden');
            $('#sortable2').append(html);
            $('.upload-variant-list').removeClass('hidden');
        };

        finder.popup();
    };
    



    HT.deleteVariantAlbum = () => {
        $(document).on('click', '.variant-delete-image', function () {
            let _this = $(this)
            _this.parents('.ui-state-default').remove()
            if ($('.ui-state-default').length == 0) {
                $('.click-to-upload-variant').removeClass('hidden')
                $('.upload-variant-list').addClass('hidden')
            }
        })
    }


    HT.swichChange = () => {
        $(document).on('change', '.js-switch', function () {
            let _this = $(this)
            let isChecked = _this.prop('checked')
            if (isChecked == true) {
                _this.parents('.col-lg-2').siblings('.col-lg-10').find('.disabled').removeAttr('disabled', true)
            } else {
                _this.parents('.col-lg-2').siblings('.col-lg-10').find('.disabled').attr('disabled', true)
            }
        })
    }



    HT.updateVariant = () => {
        $(document).on('click', '.variant-row', function () {
            let _this = $(this)
            let variantData = {}
            _this.find(".td-variant input[type=text][class^='variant_']").each(function () {
                let className = $(this).attr('class')
                variantData[className] = $(this).val()
            })

            let updateVariantBox = HT.updateVariantHtml(variantData)
            if ($('.updateVariantTr').length == 0) {
                _this.after(updateVariantBox)
            }
        })
    }

    HT.variantAlbumList = (album) => {
        let html = ''
        if (album.length && album[0] !== '') {
            for (let i = 0; i < album.length; i++) {
                html += '<li class="ui-state-default">'
                html += '<div class="thumb">'
                html += '<span class="span image img-scaledown">'
                html += '<img src="'+album[i]+'">'
                html += '<input type="hidden" name="variantAlbum[]" value="'+album[i]+'">'
                html += '</span>'
                html += '<button class="variant-delete-image">'
                html += '<i class="fa fa-trash"></i>'
                html += '</button>'
                html += '</div>'
                html += ' </li>'
            }
        }
        return html
    }



    HT.updateVariantHtml = (variantData) => {
        let variantAlbum = variantData.variant_album.split(',')
        let variantAlbumItem = HT.variantAlbumList(variantAlbum)
        let html = ''
        html += '<tr class="updateVariantTr">'
        html += '<td colspan="6">'
        html += '<div class="updateVariant">'
        html += '<div class="uk-flex uk-flex-middle uk-flex-space-between mb-2">'
        html += '<div class="card-title fs-16">Cập nhật thông tin phiên bản</div>'
        html += ' <div class="button-group">'
        html += '<div class="uk-flex uk-flex-middle">'
        html += '<button type="button" class="cancleUpdate btn btn-danger mr10">Huỷ bỏ</button>'
        html += ' <button type="button" class="saveUpdateVariant btn btn-primary">Lưu lại</button>'
        html += '</div>'
        html += ' </div>'
        html += '</div>'
        html += ' <div class="ibox-content">'
        html += '<div class="click-to-upload-variant mb-3 ">'
        html += '<div class="icon">'
        html += '<a href="" class="upload-variant-picture">'
        html += ' <svg style="width:80px;height:80px;fill: #d3dbe2;margin-bottom: 10px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 80 80"><path d="M80 57.6l-4-18.7v-23.9c0-1.1-.9-2-2-2h-3.5l-1.1-5.4c-.3-1.1-1.4-1.8-2.4-1.6l-32.6 7h-27.4c-1.1 0-2 .9-2 2v4.3l-3.4.7c-1.1.2-1.8 1.3-1.5 2.4l5 23.4v20.2c0 1.1.9 2 2 2h2.7l.9 4.4c.2.9 1 1.6 2 1.6h.4l27.9-6h33c1.1 0 2-.9 2-2v-5.5l2.4-.5c1.1-.2 1.8-1.3 1.6-2.4zm-75-21.5l-3-14.1 3-.6v14.7zm62.4-28.1l1.1 5h-24.5l23.4-5zm-54.8 64l-.8-4h19.6l-18.8 4zm37.7-6h-43.3v-51h67v51h-23.7zm25.7-7.5v-9.9l2 9.4-2 .5zm-52-21.5c-2.8 0-5-2.2-5-5s2.2-5 5-5 5 2.2 5 5-2.2 5-5 5zm0-8c-1.7 0-3 1.3-3 3s1.3 3 3 3 3-1.3 3-3-1.3-3-3-3zm-13-10v43h59v-43h-59zm57 2v24.1l-12.8-12.8c-3-3-7.9-3-11 0l-13.3 13.2-.1-.1c-1.1-1.1-2.5-1.7-4.1-1.7-1.5 0-3 .6-4.1 1.7l-9.6 9.8v-34.2h55zm-55 39v-2l11.1-11.2c1.4-1.4 3.9-1.4 5.3 0l9.7 9.7c-5.2 1.3-9 2.4-9.4 2.5l-3.7 1h-13zm55 0h-34.2c7.1-2 23.2-5.9 33-5.9l1.2-.1v6zm-1.3-7.9c-7.2 0-17.4 2-25.3 3.9l-9.1-9.1 13.3-13.3c2.2-2.2 5.9-2.2 8.1 0l14.3 14.3v4.1l-1.3.1z"></path></svg>'
        html += '  </a>'
        html += '</div>'
        html += '<div class="text-note">'
        html += '  Chọn hình để thêm hình ảnh'
        html += '</div>'
        html += '</div>'
        html += '<ul id="sortable2" class="upload-variant-list ' + ((variantAlbumItem.length) ? '' : 'hidden') + ' sortui ui-sortable">' + variantAlbumItem + '</ul>'
        html += '<div class="row mb-2">'
        html += '<div class="col-lg-2 form-switch prc-0 uk-flex uk-flex-middle uk-flex-space-around">'
        html += '<label class="col-form-label w-70">Tồn kho</label>'
        html += '<input class="form-check-input js-switch" type="checkbox" ' + ((variantData.variant_quantity !== '') ? 'checked' : '') + ' >'
        html += '</div>'
        html += ' <div class="col-lg-10">'
        html += '<div class="row">'
        html += ' <div class="col-lg-3">'
        html += ' <label class="control-lablel">Số lượng</label>'
        html += ' <input type="text" id="variantQuantity" name="variant_quantity" value="' + variantData.variant_quantity + '" class="form-control ' + ((variantData.variant_quantity == '') ? 'disabled' : '') + '" ' + ((variantData.variant_quantity == '') ? 'disabled' : '') + '>'
        html += ' </div>'
        html += ' <div class="col-lg-3">'
        html += ' <label class="control-lablel">SKU</label>'
        html += '<input type="text" name="variant_sku" value="' + variantData.variant_sku + '" class="form-control">'
        html += '</div>'
        html += ' <div class="col-lg-3">'
        html += '<label class="control-lablel">Barcode</label>'
        html += '<input type="text" name="variant_barcode" value="' + variantData.variant_barcode + '" class="form-control">'
        html += '</div>'
        html += '<div class="col-lg-3">'

        html += '<label class="control-lablel">Giá</label>'
        html += '<input type="text" id="priceInput" name="variant_price" value="' + variantData.variant_price + '" class="form-control">'
        html += '</div>'
        html += '</div>'
        html += ' </div>'
        html += ' </div>'
        html += '<div class="row">'
        html += '<div class="col-lg-2 form-switch prc-0 uk-flex uk-flex-middle uk-flex-space-around">'

        html += '<label class="col-form-label w-70">Quản lý file</label>'
        html += ' <input class="form-check-input js-switch" type="checkbox" data-target="disabled" ' + ((variantData.variant_filename !== '') ? 'checked' : '') + '>'
        html += '</div>'
        html += ' <div class="col-lg-10">'
        html += ' <div class="row">'
        html += '<div class="col-lg-6">'
        html += '<label class="control-lablel">Tên file</label>'
        html += ' <input type="text" name="variant_file_name" value="' + variantData.variant_filename + '" class="form-control ' + ((variantData.variant_filename == '') ? 'disabled' : '') + ' " ' + ((variantData.variant_filename == '') ? 'disabled' : '') + ' >'
        html += '</div>'
        html += '<div class="col-lg-6">'
        html += ' <label class="control-lablel">Url</label>'
        html += '<input type="text" name="variant_file_url" value="' + variantData.variant_fileurl + '" class="form-control ' + ((variantData.variant_fileurl == '') ? 'disabled' : '') + ' " ' + ((variantData.variant_fileurl == '') ? 'disabled' : '') + ' >'
        html += ' </div>'
        html += '</div>'
        html += ' </div>'
        html += '</div>'
        html += '</div>'
        html += '</div>'
        html += '</td>'
        html += '</tr>'

        return html;
    }


    HT.cancleVariantUpdate = () => {
        $(document).on('click', '.cancleUpdate', function () {
            HT.closeUpdateVariantBox()
        })
    }

    HT.closeUpdateVariantBox = () => {
        $('.updateVariantTr').remove()
    }

    HT.saveVariantUpdate = () => {
        $(document).on('click', '.saveUpdateVariant', function () {
            let variant = {
                'quantity': $('input[name=variant_quantity]').val(),
                'sku': $('input[name=variant_sku]').val(),
                'price': HT.addCommas($('input[name=variant_price]').val()),
                'barcode': $('input[name=variant_barcode]').val(),
                'filename': $('input[name=variant_file_name]').val(),
                'fileurl': $('input[name=variant_file_url]').val(),
                'album': $("input[name='variantAlbum[]']").map(function () {
                    return $(this).val()
                }).get(),
            }
            $.each(variant, function (index, value) {
                $('.updateVariantTr').prev().find('.variant_' + index).val(value)
            })

            HT.previewVariantTr(variant)
            HT.closeUpdateVariantBox()
        })
    }

    HT.previewVariantTr = (variant) => {
        let option = {
            'quantity': variant.quantity,
            'price': variant.price,
            'sku': variant.sku,
        }
        $.each(option, function (index, value) {
            $('.updateVariantTr').prev().find('.td-' + index).html(value)
        })
        $('.updateVariantTr').prev().find('.imageSrc').attr('src', variant.album[0])

    }

    HT.addCommas = (nStr) => {
        nStr = String(nStr);
        nStr = nStr.replace(/\./gi, "");
        let str = '';
        for (let i = nStr.length; i > 0; i -= 3) {
            let a = ((i - 3) < 0) ? 0 : (i - 3);
            str = nStr.slice(a, i) + '.' + str;
        }
        str = str.slice(0, str.length - 1);
        return str;
    }


    HT.setupSelectMultiple = (callback) => {
        if ($('.selectVariant').length) {
            let count = $('.selectVariant').length
            $('.selectVariant').each(function () {
                let _this = $(this)
                let attributeCatalogueId = _this.attr('data-catid')
                if (attribute != '') {
                    $.get('ajax/attribute/loadAttribute', {
                        attribute: attribute,
                        attributeCatalogueId: attributeCatalogueId
                    }, function (json) {
                        console.log(json)
                        if (json.items != 'undefined' && json.items.length) {
                            for (let i = 0; i < json.items.length; i++) {
                                var option = new Option(json.items[i].text, json.items[i].id, true, true)
                                _this.append(option).trigger('change')
                            }
                        }
                        if(--count === 0 && callback){
                            callback()
                        }
                    });
                }
                HT.getSelect2(_this)
            })
        }
    }

    HT.productVariant = () => {
        variant = JSON.parse(atob(variant))
        $('.variant-row').each(function (index, value) {
            let _this = $(this)
            let inputHiddenFields = [
                { name: 'variant[quantity][]', class: 'variant_quantity', value: variant.quantity[index] },
                { name: 'variant[sku][]', class: 'variant_sku', value: variant.sku[index] },
                { name: 'variant[price][]', class: 'variant_price', value: variant.price[index] },
                { name: 'variant[barcode][]', class: 'variant_barcode', value: variant.barcode[index] },
                { name: 'variant[file_name][]', class: 'variant_filename', value: variant.file_name[index] },
                { name: 'variant[file_url][]', class: 'variant_fileurl', value: variant.file_url[index] },
                { name: 'variant[album][]', class: 'variant_album', value: variant.album[index] },
            ]
            for(let i = 0; i < inputHiddenFields.length; i++){
                _this.find('.' + inputHiddenFields[i].class).val((inputHiddenFields[i].value) ? inputHiddenFields[i].value : 0 )
            }

            let album = variant.album[index]
            let variantImage = (album) ? album.split(',')[0] : '/userfiles/image/product/no-image.jpg'

            _this.find('.td-quantity').html(variant.quantity[index])
            _this.find('.td-price').html(variant.price[index])
            _this.find('.td-sku').html(variant.sku[index])
            _this.find('.imageSrc').attr('src', variantImage)
        })
    }



    $(document).on('input', 'input[name="variant_price"], input[name="variant_quantity"]', function() {
        let formattedValue = HT.addCommas($(this).val());
        $(this).val(formattedValue);
    });
    

    $(document).ready(function () {
        HT.addVariant()
        HT.chooseVariantGroup()
        HT.createProductVariant()
        HT.saveVariantUpdate()
        HT.variantAlbum()
        HT.deleteVariantAlbum()
        HT.updateVariant()

        HT.setupProductVariant()
        HT.swichChange()
        HT.removeAttribute()
        HT.niceSelect()
        HT.cancleVariantUpdate()
        HT.setupSelectMultiple(() => { HT.productVariant() })
    });

    
    

})(jQuery);

