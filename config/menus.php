<?php
return [
    [
        'title' => 'Đầu sách',
        'name' => 'dausach',
        'icon' => 'fab fa-leanpub',
        'type' => 'public',
        'children' => [
            [
                'title' => 'Danh Sách Đầu Sách',
                'name' => 'index',
                'type' => 'public',
                'icon' => 'fa fa-list',
                'route' => 'admin.dausach.index',
            ],
            [
                'title' => 'Thêm Đầu Sách',
                'name' => 'create',
                'type' => 'public',
                'icon' => '',
                'route' => 'admin.dausach.create',
            ],
            [
                'title' => 'Chỉnh sửa Đầu Sách',
                'name' => 'edit',
                'icon' => 'fa fa-edit',
            ],
            [
                'title' => 'Danh Sách Sách',
                'name' => 'indexsach',
                'type' => 'public',
                'icon' => 'fa fa-plus',
                'route' => 'admin.sach.index'
            ],
            [
                'title' => 'Danh Sách Sách Đã Thanh Lý',
                'name' => 'indexthanhly',
                'type' => 'public',
                'route' => 'admin.thanhly.index',
            ],


        ],
    ],
    [
        'title' => 'Độc Giả',
        'name' => 'docgia',
        'type' => 'public',
        'icon' => 'la la-drivers-license-o',
        'children' => [
            [
                'title' => 'Danh Sách Độc Giả',
                'name' => 'index',
                'type' => 'public',
                'route' => 'admin.docgia.index',
            ],
            [
                'title' => 'Thêm Độc Giả',
                'name' => 'create',
                'type' => 'public',
                'route' => 'admin.docgia.create',
            ],
            [
                'title' => 'Chỉnh sửa Độc Giả',
                'name' => 'edit',
                'icon' => 'fa fa-edit',


            ]
        ],
    ],
    [
        'title' => 'Nhà Cung Cấp',
        'name' => 'nhacungcap',
        'type' => 'public',
        'icon' => 'la la-building-o',
        'children' => [
            [
                'title' => 'Danh Sách Nhà Cung Cấp',
                'name' => 'index',
                'type' => 'public',
                'route' => 'admin.nhacungcap.index',
            ],
            [
                'title' => 'Thêm Nhà Cung Cấp',
                'name' => 'create',
                'type' => 'public',
                'route' => 'admin.nhacungcap.create',
            ]
        ],
    ],

    [
        'title' => 'Phiếu Mượn',
        'name' => 'phieumuon',
        'type' => 'public',
        'icon' => 'la la-ticket-alt',
        'children' => [
            [
                'title' => 'Danh Sách Phiếu Mượn',
                'name' => 'index',
                'type' => 'public',
                'route' => 'admin.phieumuon.index',
            ],
            [
                'title' => 'Thêm Phiếu Mượn',
                'name' => 'create',
                'type' => 'public',
                'route' => 'admin.phieumuon.create',
            ]
        ],
    ],
    [
        'title' => 'Phiếu Nhập',
        'name' => 'phieunhap',
        'type' => 'public',
        'icon' => 'la la-book-medical',
        'children' => [
            [
                'title' => 'Danh Sách Phiếu Nhập',
                'name' => 'index',
                'type' => 'public',
                'route' => 'admin.phieunhap.index',
            ],
            [
                'title' => 'Thêm Phiếu Nhập',
                'name' => 'create',
                'type' => 'public',
                'route' => 'admin.phieunhap.create',
            ]
        ],
    ],
    [
        'title' => 'Thể Loại',
        'name' => 'theloai',
        'type' => 'public',
        'icon' => 'fas fa-list-alt',
        'children' => [
            [
                'title' => 'Danh Sách Thể Loại',
                'name' => 'index',
                'type' => 'public',
                'route' => 'admin.theloai.index',
            ],
            [
                'title' => 'Thêm Thể Loại',
                'name' => 'create',
                'type' => 'public',
                'route' => 'admin.theloai.create',
            ]
        ],
    ],
    [
        'title' => 'Phân Loại',
        'name' => 'phanloai',
        'type' => 'public',
        'icon' => 'fa fa-list',
        'children' => [
            [
                'title' => 'Danh Sách Phân Loại',
                'name' => 'index',
                'type' => 'public',
                'route' => 'admin.phanloai.index'
            ],
            [
                'title' => 'Thêm Phân Loại',
                'name' => 'create',
                'type' => 'public',
                'route' => 'admin.phanloai.create'
            ]
        ],
    ],
    [
        'title' => 'Ngôn Ngữ',
        'name' => 'ngonngu',
        'type' => 'public',
        'icon' => 'la la-language',
        'children' =>[
            [
                'title' => 'Danh Sách Ngôn Ngữ',
                'name' => 'index',
                'type' => 'public',
                'route' => 'admin.ngonngu.index'
            ],
            [
                'title' => 'Thêm Ngôn Ngữ',
                'name' => 'create',
                'type' => 'public',
                'route' => 'admin.ngonngu.create'
            ],
            [
                'title' => 'Chỉnh Sửa Ngôn Ngữ',
                'name' => 'edit',

            ]
        ],
    ],
    [
        'title' => 'Vi Phạm',
        'name' => 'vipham',
        'type' => 'public',
        'icon' => 'fas fa-exclamation-circle',
        'children' => [
            [
                'title' => 'Dánh Sách Vi Phạm',
                'name' => 'index',
                'type' => 'public',
                'route' => 'admin.vipham.index',
            ],
            [
                'title' => 'Thêm Vi Phạm',
                'name' => 'create',
                'type' => 'public',
                'route' => 'admin.vipham.create',
            ]
        ],
    ],
    [
        'title' => 'User',
        'name' => 'user',
        'type' => 'public',
        'icon' => 'la la-user-secret',
        'children' => [
            [
                'title' => 'Danh Sách User',
                'name' => 'index',
                'type' => 'public',
                'route' => 'admin.user.index',
            ],
            [
                'title' => 'Thêm User',
                'name' => 'create',
                'type' => 'public',
                'route' => 'admin.user.create',
            ],
        ],
    ],
    [
        'title' => 'Thống Kê',
        'name' => 'statistical',
        'type' => 'public',
        'icon' => 'fab fa-sellsy',
        'children' => [
            [
                'title' => 'Tổng Quát',
                'name' => 'index',
                'type' => 'public',
                'route' => 'admin.statistical.index',
            ],

        ],
    ],

];
