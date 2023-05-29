<?php

namespace App\Models;

use App\Cart\Money;
use App\Models\Collections\ProductVariationCollection;
use App\Traits\ClearsResponseCache;
use App\Traits\HasPrice;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariation extends Model
{
    use ClearsResponseCache;
    use HasPrice;
    use SoftDeletes;

    /**
     * @var string[]
     *
     * @psalm-var list{'product_id', 'name', 'vol', 'price', 'min_order', 'max_order', 'product_variation_type_id'}
     */
    protected $fillable = [
        'product_id',
        'name',
        'vol',
        'price',
        'min_order',
        'max_order',
        'product_variation_type_id',
    ];

    /**
     * @var string[]
     *
     * @psalm-var list{'measure'}
     */
    protected $with = [
        'measure',
    ];

    public function getPriceAttribute($value): Money
    {
        if ($value === null) {
            return $this->product->price;
        }

        return new Money($value);
    }

    public function minStock($count)
    {
        return min($this->stockCount(), $count);
    }

    public function minOrder()
    {
        return $this->min_order;
    }

    public function priceVaries(): bool
    {
        return $this->price->amount() !== $this->product->price->amount();
    }

    public function inStock(): bool
    {
        return $this->stockCount() > 0;
    }

    public function stockCount()
    {
        return $this->stock->sum('pivot.stock');
    }

    public function type(): HasOne
    {
        return $this->hasOne(ProductVariationType::class, 'id', 'product_variation_type_id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function measure(): HasOne
    {
        return $this->hasOne(Measure::class, 'id', 'measure_id');
    }

    public function stocks(): HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function stock(): BelongsToMany
    {
        return $this->belongsToMany(__CLASS__, 'product_variation_stock_view')
            ->withPivot(['stock', 'in_stock']);
    }

    public function newCollection(array $models = []): ProductVariationCollection
    {
        return new ProductVariationCollection($models);
    }
}
