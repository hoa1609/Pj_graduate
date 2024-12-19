(function($) {
	"use strict";
	var HT = {};
    var counter = 1;

    HT.addSlide = (type) => {
        $(document).on('click', '.addSlide', function(e){
            e.preventDefault()
            if(typeof(type) == 'undefined'){
                type = 'Images';
            }
            var finder = new CKFinder();
            finder.resourceType = type;
            finder.selectActionFunction = function( fileUrl, data, allFiles ) {
                let html = ''
                for(var i = 0; i < allFiles.length; i++){
                    let image = allFiles[i].url
                    html += HT.renderSlideItemHtml(image)
                }

                $('.slide-list').append(html)
                HT.checkSlideNotification()
            }
            finder.popup();
        })
    }

    HT.checkSlideNotification = () => {
        let slideItem = $('.slide-item')
        if(slideItem.length){
            $('.slide-notification').hide()
        }else{
            $('.slide-notification').show()

        }
    }

    HT.renderSlideItemHtml = (image) => {
        let tab_1 = "tab-" + counter
        let tab_2 = "tab-" + (counter +1 )
        let html = `
                    <div class="col-lg-12 ui-state-default">
                <div class="slide-item ">
                    <div class="row">
                        <div class="col-4 position-relative">
                            <img class="img-fluid img-slide" src="${image}" alt="">
                            <input type="hidden" name="slide[image][]" value="${image}">
                            <span class="deleteSlide btn btn-danger"><i class="icofont-ui-delete menu-icon"></i></span>

                        </div>
                        <div class="col-8">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#${tab_1}" role="tab" aria-selected="true">Thông tin chung</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#${tab_2}" role="tab" aria-selected="false" tabindex="-1">SEO</a>
                                </li>

                            </ul>

                            <div class="tab-content">
                                <div class="tab-pane p-2 active" id="${tab_1}" role="tabpanel">
                                    <label class="form-label">
                                        Mô tả
                                    </label>
                                    <textarea class="form-control mb-2" name="slide[description][]" rows="3"></textarea>
                                    <div class="row mb-2">
                                        <div class="col-lg-8 col-md-6 col-sm-12">
                                            <input class="form-control" type="text" name="slide[canonical][]" value="" placeholder="URL">
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="tab-pane p-2" id="${tab_2}" role="tabpanel">
                                <div class="form-contol mb-2">
                                        <label class="form-label">
                                            Tiêu đề ảnh
                                        </label>
                                        <input class="form-control" type="text" name="slide[name][]" value="" placeholder="Nhập tiêu đề">
                                </div>
                                <div class="form-contol mb-2">
                                        <label class="form-label">
                                            Mô tả ảnh
                                        </label>
                                        <input class="form-control" type="text" name="slide[alt][]" value="" placeholder="Nhập mô tả">
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="dashed-line mt-3">
            </div>
                 `

        counter +=2
        return html
    }

    HT.deleteSlide = () => {
        $(document).on('click', '.deleteSlide', function() {
            let _this = $(this)
            _this.parents('.ui-state-default').remove()
            HT.checkSlideNotification()
        })
    }

	$(document).ready(function(){
        HT.addSlide();
        HT.deleteSlide();
	});



})(jQuery);
