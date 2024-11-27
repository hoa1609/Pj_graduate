<?php

if (!function_exists('convert_price')) {
    function convert_price(mixed $price = '', $flag = false){
        if($price === null) return 0;
        return ($flag === false) ? str_replace('.','', $price) : number_format($price, 0, ',', '.');
    }
}


if (!function_exists('recursive_menu')) {
    function recursive_menu($menus)
    {
        $html = '';

        // Kiểm tra nếu menus có dữ liệu
        if (count($menus)) {
            $html .= "<ul class='dd-list'>"; // Mở thẻ <ul> cho menu cha

            foreach ($menus as $menu) {
                $itemId = $menu->id;
                $itemName = $menu->languages->first()->pivot->name;
                $itemUrl = route('menu.children', ['id' => $itemId]);

                // Thêm thẻ <li> cho mỗi menu
                $html .= "<li class='dd-item' data-id='$itemId'>";
                $html .= "<div class='dd-handle'>";
                $html .= "<span class='label label-info'><i class='fa fa-arrows'></i></span> $itemName";
                $html .= "</div>";
                $html .= "<a class='create-children-menu' href='$itemUrl'>Quản lý menu con</a>";
                // Thêm nút "+" hoặc "-" dưới thẻ dd-item
                if (count($menu->children)) {
                    $html .= "<button class='expand-collapse-btn'>+</button>"; // Nút "+"
                }
                // Kiểm tra nếu menu có menu con
                if (count($menu->children)) {
                    // Thêm phần tử để chứa menu con, ban đầu ẩn đi
                    $html .= "<div class='submenu-wrapper' style='display: none;'>";
                    $html .= recursive_menu($menu->children);
                    $html .= "</div>";
                }
                // Đóng thẻ <li>
                $html .= "</li>";
            }
            $html .= "</ul>"; // Đóng thẻ <ul>
        }
        return $html;
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
         return ($product->price > 0) ? round($discountValue/$product->price*100) : 0;
    }
}


if (!function_exists('getPromotionPrice')) {
    function getPromotionPrice($priceMain = 0, $discountValue = 0, $discountType = '', $maxDiscountValue = 0) {
        $value = 0;
        if ($discountType == 'percent') {
            $value = ($priceMain * $discountValue / 100);
        } else {
            $value = $discountValue;
        }

        $finalDiscount = ($maxDiscountValue > 0) ? min($value, $maxDiscountValue) : $value;
        $priceSale = $priceMain - $finalDiscount;

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
        if(isset($product->promotions) && isset($product->promotions['discountType'])){
            $result['percent'] = ($product->promotions['discountType'] == 'percent') ? $product->promotions['discountValue'] : getPercent($product, $product->promotions['discountValue']);
            if($product->promotions['discountValue'] > 0){
                $result['priceSale'] = getPromotionPrice(
                    $product->price,
                    $product->promotions['discountValue'],
                    $product->promotions['discountType'],
                    $product->promotions['maxDiscountValue'],
                );
            }
        }

        $result['html'] .= '<span class="ec-price">';
            $result['html'] .= '<span class="new-price text-danger">'.(($result['priceSale'] > 0) ? convert_price($result['priceSale'], true) : convert_price($result['price'], true)).'₫</span>';
            if($result['priceSale'] > 0){
                $result['html'] .= '<span class="old-price">'.convert_price($result['price'], true).'₫</span>';
                $result['html'] .= '</span>';
            }
        return $result;
    }
}



if (!function_exists('getVariantPrice')) {
    function getVariantPrice($variant, $variantPromotion) {
        $result = [
            'price' => $variant->price,
            'priceSale' => 0,
            'percent' => 0,
            'html' => '',
        ];

        if (!is_null($variantPromotion) && !empty($variantPromotion)) {
            $promotion = $variantPromotion->first();
            if ($promotion) {
                $result['percent'] = ($promotion->discountType == 'percent')
                    ? $promotion->discountValue
                    : getPercent($variant, $promotion->discountValue);

                $result['priceSale'] = getPromotionPrice(
                    $variant->price,
                    $promotion->discountValue,
                    $promotion->discountType,
                    $promotion->maxDiscountValue,
                );
            }
        }

        $result['html'] .= '<span class="new-price text-danger">'.(($result['priceSale'] > 0) ? convert_price($result['priceSale'], true) : convert_price($result['price'], true)).'₫</span>';
        if ($result['priceSale'] > 0) {
            $result['html'] .= '<span class="old-price">'.convert_price($result['price'], true).'₫</span>';
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
            placeholder="nhập nội dung..."
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
            placeholder="nhập nội dung..."
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
        $fullUrl = (($fullDomain === true) ? config('app.url') : '').$canonical.(($suffix == true) ? config('apps.general.suffix') : '');
        return $fullUrl;
    }
}

if(!function_exists('seo')){
    function seo($model = null, $page = 1){
        $canonical = ($page >1) ? write_url($model->canonical, true, false).'/trang-'.$page.config('apps.general.suffix') : write_url($model->canonical, true, true);
        return [
            'meta_title' => ($model->meta_title) ?? $model->name,
            'meta_keyword' => ($model->meta_keyword) ?? '',
            'meta_description' => ($model->meta_description) ?? cut_string_and_code($model->description, 168),
            'canonical' => $canonical,
        ];
    }
}


if (!function_exists('frontend_recursive_menu')) {
    function frontend_recursive_menu($data, $parentId = 0, $count = 1, $type = 'html') {
        $html = '';
        if (count($data) && !is_null($data) && isset($data)){
            if($type == 'html'){
                foreach ($data as $key => $val) {
                    $name = $val['item']->languages->first()->pivot->name;
                    $canonical = write_url($val['item']->languages->first()->pivot->canonical, true, true);

                    $ulClass = ($count > 1) ? 'menu-level--' . ($count) : '';

                    $html .= '<li class="dropdown">';
                    $html .= '<a href="' . $canonical . '" title="' . $name . '">' . $name . '</a>';
                    if (count($val['children'])) {
                        $html .= '<ul class="sub-menu position-static ' . $ulClass . '">';
                        $html .= frontend_recursive_menu($val['children'], $val['item']->parent_id, $count + 1, $type);
                        $html .= '</ul>';
                    }
                    $html .= '</li>';
                }
                return $html;
            }
        }
        return $data;
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
                }else{
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


if (!function_exists('recursive')) {
    function recursive($data, $parentId = 0) {
        $temp = [];
        if(!is_null($data) && count($data)){
            foreach ($data as $key => $val) {
                if ($val->parent_id == $parentId) {
                    $temp[] = [
                        'item' => $val,
                        'children' => recursive($data, $val->id),
                    ];
                }
            }
        }
        return $temp;
    }
}

if(!function_exists('cut_string_and_code')) {
    function cut_string_and_code($str = null, $n = 200){
        $str = html_entity_decode(($str));
        $str = strip_tags($str);
        $str = cutnchar($str, $n);
        return $str;
    }
}

if (!function_exists('cutnchar')) {
    function cutnchar($str, $n){
        if (strlen($str) <= $n){
            return $str;
        }
        return substr($str, 0, $n) . '...';
    }
}

if (!function_exists('sorString')) {
    function sorString($string = '') {
        $extract = explode(',', $string);
        $extract = array_map('trim', $extract);
        sort($extract, SORT_NUMERIC);
        $newArray = implode(',', $extract);
        return $newArray;
    }
}

if (!function_exists('sorAttributeId')) {
    function sorAttributeId(array $attributeId = []){
        sort($attributeId, SORT_NUMERIC);
        $attributeId = implode(',', $attributeId);
        return $attributeId;
    }
}

if (!function_exists('getReviewName')) {
    function getReviewName($string, $limit = 2) {
        $string = trim(preg_replace('/\s+/', ' ', $string));

        $words = explode(' ', $string);
        $initialize = '';

        if (count($words) === 1) {
            $initialize = mb_strtoupper(mb_substr($words[0], 0, $limit));
        } else {
            $initialize = mb_strtoupper(mb_substr($words[0], 0, 1));
            $initialize .= mb_strtoupper(mb_substr(end($words), 0, 1));
        }

        return $initialize;
    }
}


if (!function_exists('generateStar')) {
    function generateStar($rating) {
        $rating = max(1, min( 5, $rating));
        $ouput = '<div class="ec-t-review-rating">';
            for($i = 1; $i <= $rating; $i++){
                $ouput .= '<i class="ecicon eci-star fill"></i>';
            }
            for($i = $rating + 1; $i <= 5; $i++){
                $ouput .= '<i class="ecicon eci-star-o"></i>';
            }
        $ouput .= '</div>';

        return $ouput;
    }
}
