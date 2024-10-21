<?php
return [
    'module' => [
        [
            'dropdown' => 'sidebarPost',
            'title' => 'Post',
            'icon' => 'fa fa-file',
            'name' => ['post'],
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
            'name' => ['user','permission'],
            'subModule' => [
                [
                    'title' => 'Role',
                    'route' => 'user/role/index'
                ],
                [
                    'title' => 'User',
                    'route' => 'user/index'
                ],
                
            ]
        ],
        [
            'dropdown' => 'sidebarLanguage',
            'title' => 'Language',
            'icon' => 'fa fa-globe',
            'name' => ['user','permission'],
            'subModule' => [
                [
                    'title' => 'Language',
                    'route' => 'language/index'
                ],
                
            ]
        ],
        
    ],
];
