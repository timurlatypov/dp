<?php

return [
    'user'    => [
        'label'         => 'Пользователи',
        'singularLabel' => 'Пользователь',
        'fields'        => [
            'name'     => 'Имя',
            'email'    => 'Почта',
            'password' => 'Пароль',
        ],
    ],
    'brand'   => [
        'label'         => 'Бренды',
        'singularLabel' => 'Бренд',
        'fields'        => [
            'name'        => 'Бренд',
            'slug'        => 'Якорь (Slug)',
            'title'       => 'Заголовок',
            'description' => 'Описание',
        ],
    ],
    'line'    => [
        'label'         => 'Линии',
        'singularLabel' => 'Линия',
        'fields'        => [
            'name' => 'Линия',
            'slug' => 'Якорь (Slug)',
        ],
    ],
    'product' => [
        'label'         => 'Продукты',
        'singularLabel' => 'Продукт',
        'fields'        => [
            'title_rus'  => 'Название (RU)',
            'title_eng'  => 'Название (EN)',
            'image_path' => 'Картинка',
            'thumb_path' => 'Превью',
            'price'      => 'Цена',
            'discount'   => 'Скидка',
            'live'       => 'На сайте',
            'stock'      => 'В наличии',
        ],
    ],
    'review'  => [
        'label'         => 'Отзывы',
        'singularLabel' => 'Отзыв',
        'fields'        => [
            'review'  => 'Отзыв',
            'author'  => 'Автор',
            'product' => 'Продукт',
            'stars'   => 'Оценка',
        ],
    ],
    'filters' => [
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
    ],
];
