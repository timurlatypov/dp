<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Log;
use Intervention\Image\Facades\Image;

class ImageService
{
    public static function convertToWebp($imagePath, $quality = 50)
    {
        try {
            $image = Image::make($imagePath);
            $webpPath = pathinfo($imagePath, PATHINFO_DIRNAME) . '/' . pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';

            $image->encode('webp', $quality)->save($webpPath);

            return $webpPath;
        } catch (Exception $e) {
            Log::error('Failed to convert image to WebP: ' . $e->getMessage(), [
                'image_path' => $imagePath,
            ]);

            return null;
        }
    }
}
