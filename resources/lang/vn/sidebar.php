<?php

return [
    'module' => [
        [
            'dropdown' => 'sidebarPost',
            'title' => 'QL Bài viết',
            'icon' => 'fa fa-file',
            'name' => ['post'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm Bài Viết',
                    'route' => 'post/catalogue/index'
                ],
                [
                    'title' => 'QL Bài Viết',
                    'route' => 'post/index'
                ]
            ]
        ],
        [
            'dropdown' => 'sidebarUser',
            'title' => 'QL Thành Viên',
            'icon' => 'fa fa-user',
            'name' => ['user','permission'],
            'subModule' => [
                [
                    'title' => 'QL Nhóm',
                    'route' => 'user/role/index'
                ],
                [
                    'title' => 'QL Thành Viên',
                    'route' => 'user/index'
                ],
                
            ]
        ],
        [
            'dropdown' => 'sidebarlanguague',
            'title' => 'QL ngôn ngữ',
            'icon' => 'fa fa-globe',
            'name' => ['user','permission'],
            'subModule' => [
                [
                    'title' => 'QL ngôn ngữ',
                    'route' => 'language/index'
                ],
                
            ]
        ],
        
    ],
];