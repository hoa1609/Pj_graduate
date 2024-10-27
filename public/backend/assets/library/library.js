(function($){
    "use strict";

    var HT = {};

    HT.select2 = ()=>{
        $('.setUpSelect2').select2();
    }

    HT.sortui = () => {
        $( "#sortable" ).sortable();
		$( "#sortable" ).disableSelection();
    }

    HT.changeStatus = () => { 
        $(document).on('change', '.status', function(){
            let _this= $(this)
            let option = {
                'value' : _this.val(),
                'modelId' : _this.attr('data-modeId'),
                'model' : _this.attr('data-model'),
                'field' : _this.attr('data-field'),
                '_token' : $('meta[name="csrf-token"]').attr('content')
            }

            $.ajax({
                url: 'ajax/dashboard/changeStatus', 
                type: 'POST', 
                data: option,
                dataType: 'json', 
                success: function(res) {
                    let inputValue = ((option.value == 1) ? 2 : 1)
                    if (res.flag == true) {
                        _this.val(inputValue)
                    } 
                },

                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                    alert('An error occurred. Please try again.');
                }
            });
        })
    }


    HT.changeStatusAll = () => { 
        if($('.changeStatusAll').length){
            $(document).on('click', '.changeStatusAll', function(e){
                let _this = $(this);
                let ids = [];
    
                $('.checkBoxItem').each(function(){
                    if($(this).prop('checked')){
                        ids.push($(this).val());  
                    }
                });
    
                let option = {
                    'value' : _this.attr('data-value'),
                    'model' : _this.attr('data-model'),
                    'field' : _this.attr('data-field'),
                    'id' : ids,
                    '_token' : $('meta[name="csrf-token"]').attr('content')
                };
    
                $.ajax({
                    url: 'ajax/dashboard/changeStatusAll', 
                    type: 'POST', 
                    data: option,
                    dataType: 'json',
                    
                    success: function(res){
                        if(res.flag == true){
                            ids.forEach(function(id){
                                const checkbox = $('.js-switch-' + id);
    
                                if(checkbox.length){
                                    checkbox.prop('checked', option.value == 2);
                                }
                            });
                        } else {
                            alert('Cập nhật thất bại');
                        }
                    },
    
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log('Lỗi: ' + textStatus + ' ' + errorThrown);
                        alert('An error occurred. Please try again.');
                    }
                });
                e.preventDefault();
            });
        }
    }; 
    
    



    HT.checkAll = () => {
        if($('#checkAll').length){
            $(document).on('click', '#checkAll', function(){
                let isChecked = $(this).prop('checked')
                $('.checkBoxItem').prop('checked', isChecked);
                $('.checkBoxItem').each(function(){
                    let _this = $(this)
                    HT.changeBackground(_this)
                })
            })
        }
    }

    HT.checkBoxItem = () => {
        if($('.checkBoxItem').length){
            $(document).on('click', '.checkBoxItem', function(){
                let _this = $(this)
                HT.changeBackground(_this)
                HT.allChecked()
            })
        }
    }

    HT.changeBackground = (object) => {
        let isChecked = object.prop('checked')
        if(isChecked){
            object.closest('tr').addClass('active-bg')
        }else{
            object.closest('tr').removeClass('active-bg')
        }
    }

    HT.allChecked = () => {
        let allChecked = $('.checkBoxItem:checked').length === $('.checkBoxItem').length;
        $('#checkAll').prop('checked', allChecked);
    }


   

    $(document).ready(function(){
        HT.select2();
        HT.changeStatus();
        HT.checkAll();
        HT.checkBoxItem();
        HT.allChecked();
        HT.changeStatusAll();
        HT.sortui();
        
    });

})(jQuery);