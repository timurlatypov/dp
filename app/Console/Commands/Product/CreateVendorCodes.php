<?php

namespace App\Console\Commands\Product;

use App\Models\Product;
use App\Services\VendorService;
use Illuminate\Console\Command;

class CreateVendorCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create_vendor_codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда создаёт для всех продуктов номер артикула.';
}
