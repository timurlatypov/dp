<?php

namespace App\Services;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageService
{
    public static function convertToWebp($imagePath, $quality = 70)
    {
        try {
            $image = Image::make($imagePath);
            $webpPath = pathinfo($imagePath, PATHINFO_DIRNAME) . '/' . pathinfo($imagePath, PATHINFO_FILENAME) . '.webp';
            
            $image->encode('webp', $quality)->save($webpPath);
            
            return $webpPath;
        } catch (\Exception $e) {
            Log::error("Failed to convert image to WebP: " . $e->getMessage(), [
                'image_path' => $imagePath,
            ]);
            return null;
        }
    }
}