<?php

return [
    'module' => [

        [
            'dropdown' => 'sidebarProduct',
            'title' => 'Product Management',
            'icon' => 'fa fa-cube',
            'subModule' => [
                [
                    'dropdown' => 'sidebarProductManagement',
                    'title' => 'Products',
                    'subSubModule' => [
                        [
                            'title' => 'Product Category',
                            'route' => 'product.catalogue.index',
                        ],
                        [
                            'title' => 'Product List',
                            'route' => 'product.index',
                        ],
                    ],
                ],
                [
                    'dropdown' => 'sidebarAttributeManagement',
                    'title' => 'Attributes',
                    'subSubModule' => [
                        [
                            'title' => 'Attribute Types',
                            'route' => 'attribute.catalogue.index',
                        ],
                        [
                            'title' => 'Attributes List',
                            'route' => 'attribute.index',
                        ],
                    ],
                ],
            ],
        ],
        [
            'dropdown' => 'sidebarPost',
            'title' => 'Post Management',
            'icon' => 'fa fa-file',
            'subModule' => [
                [
                    'title' => 'Post Category',
                    'route' => 'post.catalogue.index'
                ],
                [
                    'title' => 'Posts',
                    'route' => 'post.index'
                ]
            ]
        ],
        [
            'dropdown' => 'sidebarUser',
            'title' => 'User Management',
            'icon' => 'fa fa-user',
            'subModule' => [
                [
                    'title' => 'User Groups',
                    'route' => 'user.role.index'
                ],
                [
                    'title' => 'Users',
                    'route' => 'user.index'
                ],
                [
                    'title' => 'Add Permissions',
                    'route' => 'permission.index'
                ],
            ]
        ],
        [
            'dropdown' => 'sidebarGeneral',
            'title' => 'General Settings',
            'icon' => 'fa fa-wrench',
            'subModule' => [
                [
                    'title' => 'Languages',
                    'route' => 'language.index'
                ],
            ]
        ],

    ],
];
