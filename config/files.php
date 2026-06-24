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
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:4096',
            //            'multiple' => true
        ],

        'avatar' => [
            'field_name' => 'avatar',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:4096',
            'is_cropped' => true,
        ],
    ],
    Product::getClassName() => [
        'photo1' => [
            'field_name' => 'photo1',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo2' => [
            'field_name' => 'photo2',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo3' => [
            'field_name' => 'photo3',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo4' => [
            'field_name' => 'photo4',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo5' => [
            'field_name' => 'photo5',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo6' => [
            'field_name' => 'photo6',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo7' => [
            'field_name' => 'photo7',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo8' => [
            'field_name' => 'photo8',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo9' => [
            'field_name' => 'photo9',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo10' => [
            'field_name' => 'photo10',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo11' => [
            'field_name' => 'photo11',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo12' => [
            'field_name' => 'photo12',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo13' => [
            'field_name' => 'photo13',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo14' => [
            'field_name' => 'photo14',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo15' => [
            'field_name' => 'photo15',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo16' => [
            'field_name' => 'photo16',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo17' => [
            'field_name' => 'photo17',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo18' => [
            'field_name' => 'photo18',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo19' => [
            'field_name' => 'photo19',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo20' => [
            'field_name' => 'photo20',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo21' => [
            'field_name' => 'photo21',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo22' => [
            'field_name' => 'photo22',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo23' => [
            'field_name' => 'photo23',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo24' => [
            'field_name' => 'photo24',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo25' => [
            'field_name' => 'photo25',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo26' => [
            'field_name' => 'photo26',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo27' => [
            'field_name' => 'photo27',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo28' => [
            'field_name' => 'photo28',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo29' => [
            'field_name' => 'photo29',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo30' => [
            'field_name' => 'photo30',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo31' => [
            'field_name' => 'photo31',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo32' => [
            'field_name' => 'photo32',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo33' => [
            'field_name' => 'photo33',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo34' => [
            'field_name' => 'photo34',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo35' => [
            'field_name' => 'photo35',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo36' => [
            'field_name' => 'photo36',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo37' => [
            'field_name' => 'photo37',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo38' => [
            'field_name' => 'photo38',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo39' => [
            'field_name' => 'photo39',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo40' => [
            'field_name' => 'photo40',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo41' => [
            'field_name' => 'photo41',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo42' => [
            'field_name' => 'photo42',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo43' => [
            'field_name' => 'photo43',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo44' => [
            'field_name' => 'photo44',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo45' => [
            'field_name' => 'photo45',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo46' => [
            'field_name' => 'photo46',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo47' => [
            'field_name' => 'photo47',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
        'photo48' => [
            'field_name' => 'photo48',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
    ],
    Banner::getClassName() => [
        'photo' => [
            'field_name' => 'photo',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
    ],
    Gallery::getClassName() => [
        'photo' => [
            'field_name' => 'photo',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ],
    ],
    Partner::getClassName() => [
        'photo' => [
            'field_name' => 'photo',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ]
    ],
    Blog::getClassName() => [
        'photo' => [
            'field_name' => 'photo',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ]
    ],
    OurTeam::getClassName() => [
        'photo' => [
            'field_name' => 'photo',
            'file_type' => FileType::IMAGE,
            'validation' => 'nullable|mimes:jpg,jpeg,png,bmp,tiff|max:10000',
        ]
    ]
];
