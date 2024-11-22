<?php

if (!function_exists('convert_price')) {
    function convert_price(mixed $price = '', $flag = false){
        if($price === null) return 0;
        return ($flag === false) ? str_replace('.','', $price) : number_format($price, 0, ',', '.');
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

if (!function_exists('pre')) {
    function pre($data, $exit = false) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        if ($exit) {
            exit;
        }
    }
}


if (!function_exists('image')) {
    function image(string $image = ''){
        return $image;
    }
}


if (!function_exists('getPercent')) {
    function getPercent($product = null, $discountValue = 0){
         dd($product->price > 0) ? round($discountValue/$product->price*100) : 0;
    }
}

if (!function_exists('getPromotionPrice')) {
    function getPromotionPrice($priceMain = 0, $discountValue = 0, $discountType = ''){
        $priceSale = 0;
        if($discountType == 'percent'){
            $priceSale = $priceMain - ($priceMain*$discountValue/100);
        }else{
            $priceMain = $priceMain - $discountValue;
        }
        return $priceSale;
    }
}


if (!function_exists('getPrice')) {
    function getPrice($product = null,){
        $result = [
            'price' => $product->price,
            'priceSale' => 0,
            'percent' => 0,
            'html' => '',
        ];
        if(isset($product->promotions) && count($product->promotions->toArray())){
            $result['percent'] = ($product->promotions->first()->discountType == 'percent') ? $product->promotions->first()->discountValue : getPercent($product, $product->promotions->first()->discountValue);
            if($product->promotions->first()->discountValue > 0){
                $result['priceSale'] = getPromotionPrice($product->price, $product->promotions->first()->discountValue, $product->promotions->first()->discountType);
            }
        }

        $result['html'] .= '<span class="ec-price">';
            $result['html'] .= '<span class="new-price">'.(($result['priceSale'] > 0) ? convert_price($result['priceSale'], true) : convert_price($result['price'], true)).'₫</span>';
            if($result['priceSale'] > 0){
                $result['html'] .= '<span class="old-price">'.convert_price($result['price'], true).'₫</span>';
                $result['html'] .= '</span>';
            }
        return $result;
    }
}


if (!function_exists('getReview')) {
    function getReview(string $product = ''){
        return [
            'star' => rand(1, 5),
            'count' => rand(0, 100),
        ];
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
        $result['html'] = '<select class="form-control form-select" name="config['.$name.']" >';
        foreach ($item['option'] as $key => $val) {
            $result['html'] .= '<option value="' . ((isset($systems[$name]) && $key == ($systems[$name] ?? '')) ? 'selected' : '') . '">' . ($val) . '</option>';
        }
        $result['html'] .= '</select>';
        return $result['html'];
    }
}

if(!function_exists('write_url')){
    function write_url($canonical = null, bool $fullDomain = true, $suffix = false){
        $canonical = ($canonical) ?? '';
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

if (!function_exists('convertDateTime')) {
    function convertDateTime(string $date = '', string $format = 'd/m/Y H:i'){
        $cartbonDate = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date);
        return $cartbonDate->format($format);
    }
}

if (!function_exists('renderQuickBuy')) {
    function renderQuickBuy($product, string $canonical = '', string $name = ''){

        $class = 'btn-addCart';
        $openModal = '';
        if(isset($product->product_variants) && count(($product->product_variants))){
            $class = '';
            $canonical = '#popup';
            $openModal = 'data-uk-modal';
        }

        $html = '<a href="'.$canonical.'" '.$openModal.' class="btn-addCart" data-link-action="quickview" title="'.$name.'" data-bs-toggle="modal" data-bs-target="#ec_quickview_modal">
            <i class="fi-rr-shopping-basket"></i>
        </a>';
        return $html;
    }
}
