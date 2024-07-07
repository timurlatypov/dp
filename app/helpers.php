<?php

/**
 * Получить путь к файлу, в зависимости от среды
 * Под докером надо перенастроить путь к storage
 *
 * @param $path
 *
 * @return string
 */
if (!function_exists('get_image_path')) {
    function get_image_path(string $path): string
    {
        if (app()->environment('production')) {
            return asset('/storage/' . $path);
        }

            return '/storage/' . $path;
    }
}
