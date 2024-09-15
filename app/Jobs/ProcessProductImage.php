<?php

namespace App\Jobs;

use App\Models\Product;
use App\Services\ImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProcessProductImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle()
    {
        $imagePath = $this->product->image_path;
        $fullPath = Storage::disk('public')->path($imagePath);

        if (Storage::disk('public')->exists($this->product->image_path)) {
            $webpPath = ImageService::convertToWebp($fullPath);
            
            if ($webpPath) {
                $relativePath = str_replace(Storage::disk('public')->path(''), '', $webpPath);
                $this->product->webp_image_path = $relativePath;
                $this->product->save();
            }
        } else {
            Log::error("Image file not found", ['path' => $fullPath]);
        }
    }
}