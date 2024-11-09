<?php   

if(!function_exists('convert_price')){
    function convert_price(string $price = ''){
        return str_replace('.','', $price);
    }
}

if(!function_exists('renderSystemInput')){
    function renderSystemInput(string $name = ''){
        return '<input
            type="text"
            name=".$name."
            value="'.old($name).'"
            class= "form-control"
            placeholder = ""
            autocomplete="off"
        >';
    }
}

if(!function_exists('renderSystemImages')){
    function renderSystemImages(string $name = ''){
        return '<input
            type="text"
            name="config[.$name.]"
            value="'.old($name).'"
            class= "form-control upload-image"
            placeholder = ""
            autocomplete="off"
        >';
    }
}

if(!function_exists('renderSystemTexarea')){
    function renderSystemTexarea(string $name = ''){
        return '<textarea name="config['.$name.']" value='.old($name).'" class="form-control" ></textarea>';
    }
}

if (!function_exists('renderSystemSelect')) {
    function renderSystemSelect(array $item, string $name = '') {
        $html = '<select name="config['.$name.']" class="form-control" name="' . $name . '">';
        foreach ($item['option'] as $key => $val) {
            $html .= '<option value="' . $key . '">' . $val . '</option>';
        }
        $html .= '</select>';
        
        return $html;
    }
}


