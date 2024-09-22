<?php

namespace App\Jobs\Banner;

use App\Models\Banner;
use App\Services\ImageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CreateBannerWebpImage implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(protected Banner $banner)
    {
    }

    public function handle()
    {
        $bannerDesktopPath = $this->banner->banner_desktop;
        $bannerMobilePath = $this->banner->banner_mobile;

        $fullBannerDesktopPath = Storage::disk('public')->path($bannerDesktopPath);
        $fullBannerMobilePath = Storage::disk('public')->path($bannerMobilePath);

        if (
            Storage::disk('public')->exists($bannerDesktopPath)
            && Storage::disk('public')->exists($bannerMobilePath)
        ) {
            $webpDesktopPath = ImageService::convertToWebp($fullBannerDesktopPath);
            $webpMobilePath = ImageService::convertToWebp($fullBannerMobilePath);

            if ($webpDesktopPath && $webpMobilePath) {
                $relativeDesktopPath = str_replace(Storage::disk('public')->path(''), '', $webpDesktopPath);
                $relativeMobilePath = str_replace(Storage::disk('public')->path(''), '', $webpMobilePath);
                $this->banner->banner_desktop_webp = $relativeDesktopPath;
                $this->banner->banner_mobile_webp = $relativeMobilePath;
                $this->banner->save();
            }
        } else {
            Log::error(
                'Image file not found',
                [
                    'desktopPath' => $fullBannerDesktopPath,
                    'mobilePath' => $fullBannerMobilePath,
                ]
            );
        }
    }
}
