<?php

use App\Models\Banner\Banner;
use App\Models\Blog\Blog;
use App\Models\File\Enums\FileType;
use App\Models\Gallery\Gallery;
use App\Models\OurTeam\OurTeam;
use App\Models\Partner\Partner;
use App\Models\Product\Product;
use App\Models\User\User;

return [
    User::getClassName() => [
        'signature' => [
            'field_name' => 'signature',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff,webp|max:4096',
            //            'multiple' => true
        ],

        'avatar' => [
            'field_name' => 'avatar',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff,webp|max:4096',
            'is_cropped' => true,
        ],
    ],
    Product::getClassName() => [
        'photos' => [
            'field_name' => 'photos',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff,webp|max:10000',
            'multiple' => true,
        ],
    ],
    Banner::getClassName() => [
        'photo' => [
            'field_name' => 'photo',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff,webp|max:10000',
        ],
    ],
    Gallery::getClassName() => [
        'photo' => [
            'field_name' => 'photo',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff,webp|max:10000',
        ],
    ],
    Partner::getClassName() => [
        'photo' => [
            'field_name' => 'photo',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff,webp|max:10000',
        ]
    ],
    Blog::getClassName() => [
        'photo' => [
            'field_name' => 'photo',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff,webp|max:10000',
        ]
    ],
    OurTeam::getClassName() => [
        'photo' => [
            'field_name' => 'photo',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff,webp|max:10000',
        ]
    ]
];
