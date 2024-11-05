<?php

return [
    'module' => [
        'title' => 'QL Sản Phẩm',
        'icon' => 'fa fa-cube',
        'name' => ['product', 'attribute'],
        'subModule' => [
            [
                'title' => 'QL Nhóm Sản Phẩm',
                'route' => 'product/catelogue/index'
            ],
            [
                'title' => 'QL Sản Phẩm',
                'route' => 'product/index'
            ],
            [
                'title' => 'QL Loại Thuộc Tính',
               'route' => 'attribute/catelogue/index'
           ],
            [
                'title' => 'QL Thuộc Tính',
                'route' => 'attribute/index'
            ]
        ]
    ],
    [
        'title' => 'QL Bài Viết',
        'icon' => 'fa fa-file',
        'name' => ['post'],
        'subModule' => [
            [
                'title' => 'QL Nhóm Bài Viết',
                'route' => 'post/catelogue/index'
            ],
            [
                'title' => 'QL Bài Viết',
                'route' => 'product/index'
            ]
        ]
    ],
    [
        'title' => 'QL Thành Viên',
        'icon' => 'fa fa-user',
        'name' => ['user', 'permission'],
        'subModule' => [
            [
                'title' => 'QL Nhóm Thành Viên',
                'route' => 'product/catelogue/index'
            ],
            [
                'title' => 'QL Thành Viên',
                'route' => 'product/index'
            ],
            [
                'title' => 'QL Quyền',
                'route' => 'permission/index'
            ]
        ]
    ],
    [
        'title' => 'QL Banner & Slide',
        'icon' => 'fa fa-picture-o',
        'name' => ['slide'],
        'subModule' => [
            [
                'title' => 'QL slide',
                'route' => 'slide/index'
            ]
        ]
    ],
    [
        'title' => 'QL Menu',
        'icon' => 'fa fa-bars',
        'name' => ['menu'],
        'subModule' => [
            [
                'title' => 'Cài đặt Menu',
                'route' => 'menu/index'
            ]
        ]
    ],
    // [
    //     'title' => 'Cấu hình chung',
    //     'icon' => 'fa fa-file',
    //     'name' => ['language', 'generate', 'system'],
    //     'subModule' => [
    //         [
    //             'title' => 'QL Ngôn Ngữ',
    //             'route' => 'language/index'
    //         ],
    //         [
    //             'title' => 'QL Module',
    //             'route' => 'language/index'
    //         ]
    //     ]
    // ],



];
