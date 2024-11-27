<?php

return [
    'module' => [
        [
            'dropdown' => 'Dashboard',
            'title' => 'Dashboard',
            'icon' => 'fa fa-database',
            'route' => 'dashboard.index',
            'class' => 'special',
        ],
        [
            'dropdown' => 'sidebarProduct',
            'title' => 'QL Mặt hàng',
            'icon' => 'fa fa-cube',
            'subModule' => [
                [
                    'dropdown' => 'sidebarProductManagement',
                    'title' => 'Sản phẩm',
                    'subSubModule' => [
                        [
                            'title' => 'Danh mục Sản phẩm',
                            'route' => 'product.catalogue.index',
                        ],
                        [
                            'title' => 'Sản phẩm',
                            'route' => 'product.index',
                        ],
                    ],
                ],
                [
                    'dropdown' => 'sidebarAttributeManagement',
                    'title' => 'Thuộc tính',
                    'subSubModule' => [
                        [
                            'title' => 'Loại Thuộc tính',
                            'route' => 'attribute.catalogue.index',
                        ],
                        [
                            'title' => 'Thuộc tính',
                            'route' => 'attribute.index',
                        ],
                    ],
                ],
            ],
        ],
        [
            'dropdown' => 'sidebarCustomer',
            'title' => 'QL Khách hàng',
            'icon' => 'fa fa-user menu-icon',
            'subModule' => [
                [
                    'title' => 'QL Nhóm khách hàng',
                    'route' => 'customer.catalogue.index'
                ],
                [
                    'title' => 'QL khách hàng',
                    'route' => 'customer.index'
                ],
            ]
        ],
        [
            'dropdown' => 'sidebarslide',
            'title' => 'QL slide',
            'icon' => 'lar la-image',
            'subModule' => [
                [
                    'title' => 'Slide & banner',
                    'route' => 'slide.index'
                ]
            ]
        ],
        [
            'dropdown' => 'sidebarPost',
            'title' => 'QL Bài viết',
            'icon' => 'fa fa-file',
            'subModule' => [
                [
                    'title' => 'Danh mục Bài Viết',
                    'route' => 'post.catalogue.index'
                ],
                [
                    'title' => 'Bài Viết',
                    'route' => 'post.index'
                ]
            ]
        ],
        [
            'dropdown' => 'sidebarUser',
            'title' => 'QL Thành Viên',
            'icon' => 'fa fa-user menu-icon',
            'subModule' => [
                [
                    'title' => 'QL Nhóm',
                    'route' => 'user.role.index'
                ],
                [
                    'title' => 'Thành Viên',
                    'route' => 'user.index'
                ],
                [
                    'title' => 'Thêm quyền',
                    'route' => 'permission.index'
                ],

            ]
        ],
        [
            'dropdown' => 'sidebarMaketing',
            'title' => 'QL Maketing',
            'icon' => 'icofont-money ',
            'subModule' => [
                [
                    'title' => 'QL Khuyến mãi',
                    'route' => 'promotion.index'
                ],
                [
                    'title' => 'QL Nguồn Khách',
                    'route' => 'source.index'
                ],

            ]
        ],
        [
            'dropdown' => 'sidebarGeneral',
            'title' => 'Cấu hình chung',
            'icon' => 'fa fa-wrench',
            'subModule' => [
                [
                    'title' => 'Ngôn ngữ',
                    'route' => 'language.index'
                ],
                [
                    'title' => 'QL Widget',
                    'route' => 'widget.index'
                ],
                [
                    'title' => 'Cấu hình hệ thống',
                    'route' => 'system.index'
                ],

            ]
        ],
        [
            'dropdown' => 'menu',
            'title' => 'QL Menu',
            'icon' => 'fa fa-bars',
            'subModule' => [
                [
                    'title' => 'Cài đặt menu',
                    'route' => 'menu.index'
                ],

            ]
        ],

    ],
];
