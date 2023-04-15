<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    /**
     * @var string[]
     *
     * @psalm-var list{'quantity', 'product_variation_id'}
     */
    protected $fillable = [
    	'quantity', 'product_variation_id'
    ];
}
