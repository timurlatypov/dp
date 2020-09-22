<?php

return [
    'user'        => [
        'label'         => 'Пользователи',
        'singularLabel' => 'Пользователь',
        'fields'        => [
            'name'     => 'Имя',
            'email'    => 'Почта',
            'password' => 'Пароль',
        ],
    ],
    'brand'       => [
        'label'         => 'Бренды',
        'singularLabel' => 'Бренд',
        'fields'        => [
            'name'        => 'Бренд',
            'slug'        => 'Якорь (Slug)',
            'title'       => 'Заголовок',
            'description' => 'Описание',
        ],
    ],
    'line'        => [
        'label'         => 'Линии',
        'singularLabel' => 'Линия',
        'fields'        => [
            'name' => 'Линия',
            'slug' => 'Якорь (Slug)',
        ],
    ],
    'product'     => [
        'label'         => 'Продукты',
        'singularLabel' => 'Продукт',
        'fields'        => [
            'title_rus'         => 'Название (RU)',
            'title_eng'         => 'Название (EN)',
            'slug'              => 'Якорь (Slug)',
            'description_short' => 'Краткое описание',
            'description_full'  => 'Полное описание',
            'ph'                => 'pH',
            'image_path'        => 'Картинка',
            'thumb_path'        => 'Превью',
            'price'             => 'Цена',
            'discount'          => 'Скидка',
            'live'              => 'На сайте',
            'stock'             => 'В наличии',
            'reviews'           => 'Отзывов',
            'vendor_code'       => 'Артикул',
        ],
        'hint'          => [
            'slug'       => 'Уникальная составляющая URL-пути',
            'image_path' => 'Размер картинки должен быть 1080х1080',
            'thumb_path' => 'Размер картинки должен быть 650х650',
        ],
    ],
    'review'      => [
        'label'         => 'Отзывы',
        'singularLabel' => 'Отзыв',
        'fields'        => [
            'review'       => 'Отзыв',
            'author'       => 'Автор',
            'product'      => 'Продукт',
            'stars'        => 'Оценка',
            'published_at' => 'Дата',
            'published'    => 'Опубликован',
        ],
    ],
    'coupon'      => [
        'label'         => 'Промокоды',
        'singularLabel' => 'Промокод',
        'fields'        => [
            'coupon'     => 'Промокод',
            'entity_id'  => 'ID Сущности',
            'discount'   => 'Скидка',
            'reusable'   => 'Многоразовый',
            'used'       => 'Использован',
            'level'      => 'Уровень',
            'expired_at' => 'Действует до',
        ],
    ],
    'categories'  => [
        'label'         => 'Категории',
        'singularLabel' => 'Категория',
        'fields'        => [
            'name' => 'Название',
            'slug' => 'Якорь (Slug)',
        ],
    ],
    'subcategory' => [
        'label'         => 'Подкатегории',
        'singularLabel' => 'Подкатегория',
        'fields'        => [
            'name' => 'Название',
            'slug' => 'Якорь (Slug)',
        ],
    ],
    'filters'     => [
        'live'  => [
            'title'   => 'На сайте',
            'options' => [
                'yes' => 'Да',
                'no'  => 'Нет',
            ],
        ],
        'stock' => [
            'title'   => 'В наличии',
            'options' => [
                'yes' => 'Да',
                'no'  => 'Нет',
            ],
        ],
        'brand' => [
            'title' => 'По бренду',
        ],
        'line'  => [
            'title' => 'По Линии',
        ],
    ],
];
