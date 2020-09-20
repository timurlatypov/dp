<?php

namespace App\Jobs\Product;

use App\Product;
use App\Services\VendorService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MakeVendorCodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $id;

    /**
     * Create a new job instance.
     *
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $product = Product::where('id', $this->id)->first();
        $brand   = $product->brand()->first();

        $product->update([
            'vendor_code' => VendorService::makeCode($brand->id, $this->id),
        ]);

        $product->save();
    }

    public function failed()
    {
        Log::error('Couldn\'t create vendor code ');
    }
}
