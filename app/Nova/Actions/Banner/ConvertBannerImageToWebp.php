<?php

namespace App\Nova\Actions\Banner;

use App\Jobs\Banner\CreateBannerWebpImage;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class ConvertBannerImageToWebp extends Action
{
    use InteractsWithQueue;
    use Queueable;

    public $name = 'Convert Image to WebP';

    /**
     * Perform the action on the given models.
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            CreateBannerWebpImage::dispatch($model);
        }

        return Action::message('Image conversion process has been queued for the selected products.');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
