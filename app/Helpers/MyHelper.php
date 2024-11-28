<?php

if (!function_exists('convert_price')) {
    function convert_price(string $price = '')
    {
        return str_replace('.', '', $price);
    }
}

if (!function_exists('convert_array')) {
    function convert_array($system = null, $keyword = '', $value = ''){
        $temp = [];
        if(is_array(($system))){
            foreach($system as $key => $val){
                $system[$val[$keyword]] = $val[$value];
            }
        }
        if(is_object($system)){
            foreach($system as $key => $val){
                $temp[$val->{$keyword}] = $val->{$value};
            }
        }
        return $temp;
    }
}

if (!function_exists('loadClass')) {
    function loadClass(string $model = '', $interface = 'Repository')
    {
        $serviceInterfaceNamespace = '\App\Repositories\\' . ucfirst($model) . $interface;
        if (class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }
        return $serviceInstance;
    }
}

if(!function_exists('renderSystemInput')){
    function renderSystemInput(string $name = '', $systems = null){
        return '<input
            type="text" 
            name="config['.$name.']" 
            value="'.old($name, ($systems[$name] ?? '')).'"
            class="form-control" 
            placeholder="nhập tên bài viết..." 
        >';
    }
}

if(!function_exists('renderSystemImages')){
    function renderSystemImages(string $name = '', $systems = null){
        return '<input
            type="text" 
            name="config['.$name.']"  
            value="'.old($name, ($systems[$name] ?? '')).'"
            class="form-control upload-image" 
            placeholder="nhập tên bài viết..." 
        >';
    }
}

if(!function_exists('renderSystemTextarea')){
    function renderSystemTextarea(string $name = '', $systems = null){
        return '<textarea name="config['.$name.']" class="form-control">'.old($name, ($systems[$name] ?? '')).'</textarea>';
    }
}

if(!function_exists('renderSystemLink')){
    function renderSystemLink(array $item = [], $systems = null){
        return (isset($item['link'])) ? '<a href="'.$item['link']['href'].'">'.$item['link']['text'].'</a>' : '';
    }
}

if (!function_exists('renderSystemSelect')) {
    function renderSystemSelect(array $item, string $name = '', $systems = null): string {
        if (!isset($item['option']) || !is_array($item['option'])) {
            return '<select class="form-control" name="config['.$name.']" ></select>';
        }
        $html = '<select class="form-control form-select" name="config['.$name.']" >';
        foreach ($item['option'] as $key => $val) {
            $html .= '<option value="' . ((isset($systems[$name]) && $key == ($systems[$name] ?? '')) ? 'selected' : '') . '">' . ($val) . '</option>';
        }
        $html .= '</select>';
        return $html;
    }
}

if(!function_exists('write_url')){
    function write_url(string $canonical = '', bool $fullDomain = true, $suffix = false){
        if(strpos($canonical, 'http') !== false){
            return $canonical;
        }
        $fullUrl = (($fullDomain === true) ? config('app.url') : '').$canonical.(($suffix == true) ? config('app.general.suffix') : '');
        return $fullUrl;
    }
}


if(!function_exists('frontend_recursive_menu')){
    function frontend_recursive_menu($data, $parentId = 0){
    }
}



if(!function_exists('covertDatetime')) {
    function coverDatetime(string $data = '', string $format = 'd/m/Y H:i' ){
        $carbonDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $data);
        return $carbonDate->format($format);
    }
}

if(!function_exists('renderDiscountInformation')) {
    function renderDiscountInformation($promotion = []){
        if($promotion->method === 'product_and_quantity'){
            $discountValue = $promotion->discountInformation['info']['discountValue'];
            $discountType = ($promotion->discountInformation['info']['discountType'] == 'percent') ? '%' : 'đ';
            return '
                <div class="badge bg-primary text-small">
                     '.$discountValue. $discountType.'
                </div>
                ';
        }
        return '<div><a href="'.route('promotion.edit', $promotion->id).'">Xem chi tiết</a></div>';
    }
}

if (!function_exists('convertArrayByKey')) {
    function convertArrayByKey($object = null, $fields = [])
    {
        $temp = [];
        foreach ($object as $key => $value) {
            foreach ($fields as $field) {
                if(is_array($object)){
                    $temp[$field][] = $value[$field];
                }
                else
                {
                    $extract = explode('.',$field);
                    if(count($extract) == 2) {
                        $temp[$extract[0]][] =   $value->{$extract[1]}->first()->pivot->{$extract[0]};

                    }else {
                        $temp[$field][] = $value->{$field};
                    }
                }
            }
        }
        return $temp;
    }
}

