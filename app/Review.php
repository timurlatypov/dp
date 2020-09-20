<?php

namespace App;

use App\Traits\PublishedAware;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use SoftDeletes;
    use PublishedAware;

    protected $fillable = [
        'user_id',
        'product_id',
        'stars',
        'review',
        'published',
    ];

    protected $casts = [
        'published' => 'bool',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
