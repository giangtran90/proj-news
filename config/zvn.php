<?php

return [
    'url' => [
        'prefix_admin'  => 'admin1',
        'prefix_news'  => 'news1',
    ],
    'format'  => [
        'long_time'     => 'H:i:s d-m-Y',
        'short_time'    => 'd-m-Y',
    ],
    'template' => [
        'form_input' => ['class' => 'form-control col-md-7 col-xs-12'],
        'form_label' => ['class' => 'control-label col-md-3 col-sm-3 col-xs-12'],
        'status' => [
            'all'           => ['name' => 'Tất cả',  'class' => ''],
            'active'        => ['name' => 'Kích hoạt',      'class' => 'btn-success'],
            'inactive'      => ['name' => 'Chưa kích hoạt', 'class' => 'btn-info'],
            'block'         => ['name' => 'Bị khóa',        'class' => 'btn-danger'],
            'default'       => ['name' => 'Chưa xác định',  'class' => 'btn-info']
        ],
        'is_home' => [
            'yes'           => ['name' => 'Hiển thị',       'class' => 'btn-primary'],
            'no'            => ['name' => 'Không hiển thị', 'class' => 'btn-warning'],
        ],
        'display' => [
            'list'          => ['name' => 'Danh sách'],
            'grid'          => ['name' => 'Lưới'],
        ],
        'search' => [
            'all'           => ['name' => 'Search by All '],
            'id'            => ['name' => 'Search by ID '],
            'name'          => ['name' => 'Search by Name '],        
            'username'      => ['name' => 'Search by Username '],        
            'fullname'      => ['name' => 'Search by Fullname '],        
            'email'         => ['name' => 'Search by Email '],        
            'description'   => ['name' => 'Search by Description '],        
            'link'          => ['name' => 'Search by Link '],        
            'content'       => ['name' => 'Search by Content '],        
        ],
        'button' => [
            'edit'          => ['class' => 'btn-success',   'title' => 'Edit',      'icon' => 'fa-pencil',      'route_name' => '/form'],
            'delete'        => ['class' => 'btn-danger btn-delete',    'title' => 'Delete',    'icon' => 'fa-trash',       'route_name' => '/delete'],
            'info'          => ['class' => 'btn-info',      'title' => 'Info',      'icon' => 'fa-pencil',      'route_name' => '/delete']
        ]
    ],
    'config' => [
        'search' => [
            'default'   => ['all', 'id', 'name'],
            'slider'    => ['all', 'id', 'name', 'description', 'link'],
            'category'  => ['all', 'id', 'name'],
        ],
        'button' => [
            'default'   => ['edit', 'delete'],
            'slider'    => ['edit', 'delete'],
            'category'  => ['edit', 'delete'],
        ],
    ]
];
