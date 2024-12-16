<?php

return [
    'module' => [
        [
            'dropdown' => 'Dashboard',
            'title' => 'Thống kê',
            'icon' => 'fa fa-database',
            'route' => 'dashboard.index',
            'class' => 'special',
        ],
        [
            'dropdown' => 'sidebarProduct',
            'title' => 'Mặt hàng',
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
            'dropdown' => 'sidebarOrder',
            'title' => 'Đơn hàng',
            'icon' => 'fa fa-shopping-bag menu-icon',
            'subModule' => [
                [
                    'dropdown' => 'sidebarOrders',
                    'title' => 'Đơn hàng',
                    'route' => 'order.index',
                ],
            ],
        ],
        [
            'dropdown' => 'sidebarCustomer',
            'title' => 'Khách hàng',
            'icon' => 'las la-users',
            'subModule' => [
                [
                    'title' => 'Nhóm khách hàng',
                    'route' => 'customer.catalogue.index'
                ],
                [
                    'title' => 'Khách hàng',
                    'route' => 'customer.index'
                ],
            ]
        ],
        [
            'dropdown' => 'sidebarslide',
            'title' => 'Slide',
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
            'title' => 'Bài viết',
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
            'title' => 'Thành Viên',
            'icon' => 'fa fa-user menu-icon',
            'subModule' => [
                [
                    'title' => 'Nhóm',
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
            'title' => 'Maketing',
            'icon' => 'icofont-money',
            'subModule' => [
                [
                    'title' => 'Khuyến mãi',
                    'route' => 'promotion.index'
                ],
                [
                    'title' => 'Nguồn Khách',
                    'route' => 'source.index'
                ],

            ]
        ],
        [
            'dropdown' => 'sidebarReview',
            'title' => 'Bình luận',
            'icon' => 'icofont-speech-comments ',
            'subModule' => [
                [
                    'title' => 'Bình luận',
                    'route' => 'review.index'
                ],
            ]
        ],
        [
            'dropdown' => 'menu',
            'title' => 'Menu',
            'icon' => 'fa fa-bars',
            'subModule' => [
                [
                    'title' => 'Cài đặt menu',
                    'route' => 'menu.index'
                ],

            ]
        ],
        [
            'dropdown' => 'sidebarGeneral',
            'title' => 'Cài đặt chung',
            'icon' => 'las la-cog',
            'subModule' => [
                [
                    'title' => 'Ngôn ngữ',
                    'route' => 'language.index'
                ],
                [
                    'title' => 'Widget',
                    'route' => 'widget.index'
                ],
                [
                    'title' => 'Cấu hình hệ thống',
                    'route' => 'system.index'
                ],

            ]
        ],

    ],
];
