<?php

namespace App\Jobs\Promotion;

use App\Models\Promotion;
use App\Services\ImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CreatePromotionWebpImage implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(protected Promotion $promotion)
    {
    }

    public function handle()
    {
        $imagePath = $this->promotion->image_path;
        $fullPath = Storage::disk('public')->path($imagePath);

        if (Storage::disk('public')->exists($this->promotion->image_path)) {
            $webpPath = ImageService::convertToWebp($fullPath);

            if ($webpPath) {
                $relativePath = str_replace(Storage::disk('public')->path(''), '', $webpPath);
                $this->promotion->webp_image_path = $relativePath;
                $this->promotion->save();
            }
        } else {
            Log::error('Image file not found', ['path' => $fullPath]);
        }
    }
}
