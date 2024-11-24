<?php

if (!function_exists('convert_price')) {
    function convert_price(string $price = '')
    {
        return str_replace('.', '', $price);
    }
}

// if (!function_exists('recursive_menu')) {
//     function recursive_menu($data) {
//         $html = '';

//         if ($data instanceof \Illuminate\Support\Collection || is_array($data)) {
//             foreach ($data as $key => $value) {
//                 $itemId = $value->id;
//                 $itemName = $value->languages->first()->pivot->name;
//                 $itemUrl = route('menu.children', ['id' => $itemId]);

//                 $html .= "<li class='dd-item' data-id='$itemId'>";
//                 $html .= "<div class='dd-handle'>";
//                 $html .= "<span class='label label-info'><i class='fa fa-arrows'></i></span> $itemName";
//                 $html .= "</div>";
//                 $html .= "<a class='create-children-menu' href='$itemUrl'>Quản lý menu con</a>";

//                 if(isset($value->parent_id)) {
//                     // dd($value->languages->first()->pivot->name);
//                     $html .= "<ol class='dd-list'>";
//                     $html .= recursive_menu($value->languages->first()->pivot->name); // Gọi đệ quy
//                     $html .= "</ol>";
//                 }
//                 $html .= "</li>";
//             }
//         }
//         return $html;
//     }
// }

// if (!function_exists('recursive_menu')) {
//     function recursive_menu($data) {
//         $html = '';

//         if (count($data)) {
//             foreach ($data as $key => $value) {
//                 $itemId = $value['item']->id;
//                 $itemName = $value['item']->languages->first()->pivot->name;
//                 $itemUrl = route('menu.children', ['id' => $itemId]);

//                 $html .= "<li class='dd-item' data-id='$itemId'>";
//                 $html .= "<div class='dd-handle'>";
//                 $html .= "<span class='label label-info'><i class='fa fa-arrows'></i></span> $itemName";
//                 $html .= "</div>";
//                 $html .= "<a class='create-children-menu' href='$itemUrl'>Quản lý menu con</a>";

//                 if (count($value['children'])) {
//                     $html .= "<ol class='dd-list'>";
//                     $html .= recursive_menu($value['children']);
//                     $html .= "</ol>";
//                 }

//                 $html .= "</li>";
//             }
//         }
//         return $html;
//     }
// }


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
