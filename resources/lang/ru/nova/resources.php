<?php

return [
    'user' => [
        'label' => 'Пользователи',
        'singularLabel' => 'Пользователь',
        'fields' => [
            'name' => 'Имя',
            'email' => 'Почта',
            'password' => 'Пароль',
        ],
    ],
    'brand' => [
        'label' => 'Бренды',
        'singularLabel' => 'Бренд',
        'fields' => [
            'name' => 'Бренд',
            'slug' => 'Якорь (Slug)',
            'title' => 'Заголовок',
            'description' => 'Описание',
            'live' => 'Видимость',
        ],
    ],
    'line' => [
        'label' => 'Линии',
        'singularLabel' => 'Линия',
        'fields' => [
            'name' => 'Линия',
            'slug' => 'Якорь (Slug)',
        ],
    ],
    'product' => [
        'label' => 'Продукты',
        'singularLabel' => 'Продукт',
        'fields' => [
            'title_rus' => 'Название (RU)',
            'title_eng' => 'Название (EN)',
            'slug' => 'Якорь (Slug)',
            'description_short' => 'Краткое описание',
            'description_full' => 'Полное описание',
            'ph' => 'pH',
            'image_path' => 'Картинка',
            'thumb_path' => 'Превью',
            'price' => 'Цена',
            'discount' => 'Скидка',
            'live' => 'На сайте',
            'feed' => 'Фид',
            'stock' => 'В наличии',
            'reviews' => 'Отзывов',
            'vendor_code' => 'Артикул',
            'wb_code' => 'WB Артикул',
            'ozon_code' => 'OZON Артикул',
            'mm_code' => 'Мега Маркет Артикул',
            'ya_code' => 'Яндекс Маркет Артикул',
            'webp_image_path' => 'Webp'
        ],
        'hint' => [
            'slug' => 'Уникальная составляющая URL-пути',
            'image_path' => 'Размер картинки должен быть 1080х1080',
            'thumb_path' => 'Размер картинки должен быть 400х400',
        ],
    ],
    'volume' => [
        'label' => 'Объёмы',
        'singularLabel' => 'Объём',
        'fields' => [
            'name' => 'Объём',
        ],
    ],
    'volumeType' => [
        'label' => 'Тип объёма',
        'singularLabel' => 'Тип объёма',
        'fields' => [
            'name' => 'Тип объёма',
        ],
    ],
    'gift_card' => [
        'label' => 'Подарочные Карты',
        'singularLabel' => 'Подарочная Карта',
        'fields' => [
            'serial' => 'Памятка',
            'code' => 'Номер карты',
            'amount' => 'Сумма',
            'used' => 'Использован',
            'expired_at' => 'Истекает срок',
            'user_id' => 'User ID',
            'order_id' => 'Order ID',
        ],
    ],
    'review' => [
        'label' => 'Отзывы',
        'singularLabel' => 'Отзыв',
        'fields' => [
            'review' => 'Отзыв',
            'author' => 'Автор',
            'product' => 'Продукт',
            'stars' => 'Оценка',
            'published_at' => 'Дата',
            'published' => 'Опубликован',
        ],
    ],
    'banner' => [
        'label' => 'Баннеры',
        'singularLabel' => 'Баннер',
        'fields' => [
            'name' => 'Название',
            'banner_desktop' => 'Desktop',
            'banner_mobile' => 'Mobile',
            'bg_color' => 'Цвет фона',
            'link' => 'Ссылка',
            'sort_order' => 'Сортировка',
            'live' => 'Видимость',
            'published_at' => 'Опубликован',
            'expired_at' => 'Истекает срок',
        ],
    ],
    'promotion' => [
        'label' => 'Промоакции',
        'singularLabel' => 'Промоакция',
        'fields' => [
            'name' => 'Название',
            'link' => 'Ссылка',
            'image_path' => 'Баннер',
            'sort_order' => 'Сортировка',
            'live' => 'Видимость',
            'published_at' => 'Опубликован',
            'expired_at' => 'Истекает срок',
        ],
    ],
    'coupon' => [
        'label' => 'Промокоды',
        'singularLabel' => 'Промокод',
        'fields' => [
            'coupon' => 'Промокод',
            'entity_id' => 'ID Сущности',
            'discount' => 'Скидка',
            'reusable' => 'Многоразовый',
            'used' => 'Использован',
            'level' => 'Уровень',
            'expired_at' => 'Действует до',
        ],
    ],
    'menus' => [
        'label' => 'Категории фида',
        'singularLabel' => 'Категория фида',
        'fields' => [
            'name' => 'Название',
            'slug' => 'Якорь (Slug)',
        ],
    ],
    'categories' => [
        'label' => 'Категории',
        'singularLabel' => 'Категория',
        'fields' => [
            'name' => 'Название',
            'slug' => 'Якорь (Slug)',
        ],
    ],
    'subcategory' => [
        'label' => 'Подкатегории',
        'singularLabel' => 'Подкатегория',
        'fields' => [
            'name' => 'Название',
            'slug' => 'Якорь (Slug)',
        ],
    ],
    'role' => [
        'label' => 'Роли',
        'singularLabel' => 'Роль',
        'fields' => [
            'name' => 'Название',
        ],
    ],
    'permission' => [
        'label' => 'Разрешения',
        'singularLabel' => 'Разрешение',
        'fields' => [
            'name' => 'Название',
        ],
    ],
    'filters' => [
        'live' => [
            'title' => 'На сайте',
            'options' => [
                'yes' => 'Да',
                'no' => 'Нет',
            ],
        ],
        'stock' => [
            'title' => 'В наличии',
            'options' => [
                'yes' => 'Да',
                'no' => 'Нет',
            ],
        ],
        'brand' => [
            'title' => 'По бренду',
        ],
        'line' => [
            'title' => 'По Линии',
        ],
        'group' => [
            'title' => 'По Группе',
        ],
    ],
];
