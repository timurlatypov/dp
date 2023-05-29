<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Measure extends Model
{
    /**
     * @var string[]
     *
     * @psalm-var list{'type'}
     */
    protected $fillable = [
        'type',
    ];
}
