<?php
return [
    'module' => [
        [
            'dropdown' => 'sidebarPost',
            'title' => 'Post',
            'icon' => 'fa fa-file',
            'subModule' => [
                [
                    'title' => 'Post Categories',
                    'route' => 'post/catalogue/index'
                ],
                [
                    'title' => 'Post',
                    'route' => 'post/index'
                ]
            ]
        ],
        [
            'dropdown' => 'sidebarUser',
            'title' => 'User',
            'icon' => 'fa fa-user',
            'subModule' => [
                [
                    'title' => 'Role',
                    'route' => 'user/role/index'
                ],
                [
                    'title' => 'User',
                    'route' => 'user/index'
                ],
                [
                    'title' => 'Permission',
                    'route' => 'permission/index'
                ],
            ]
        ],
        [
            'dropdown' => 'sidebarLanguage',
            'title' => 'Language',
            'icon' => 'fa fa-globe',
            'subModule' => [
                [
                    'title' => 'Language',
                    'route' => 'language/index'
                ],
                
            ]
        ],
        
    ],
];
