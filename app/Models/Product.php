<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'brand_id',
        'promotion_id',
        'name',
        'slug',
        'reference',
        'description',
        'image',
        'price',
        'stock',
        'status',
        'is_featured',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'stock' => 'integer',
            'is_featured' => 'boolean',
        ];
    }

    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'active';
    }

    public function getOldPriceAttribute()
    {
        if ($this->hasActivePromotion()) {
            return $this->attributes['price'] ?? null;
        }
        return null;
    }

    public function getPriceAttribute($value)
    {
        if ($this->hasActivePromotion()) {
            $promo = $this->promotion;
            if ($promo->discount_type === 'percentage') {
                return $value * (1 - $promo->discount_percentage / 100);
            } elseif ($promo->discount_type === 'fixed') {
                return max(0.00, $value - $promo->discount_value);
            }
        }
        return $value;
    }

    public function hasActivePromotion(): bool
    {
        // Check if relation is loaded, load if not
        if (!$this->relationLoaded('promotion')) {
            $this->load('promotion');
        }

        $promo = $this->promotion;
        if (!$promo) {
            return false;
        }

        return $promo->is_active && now()->between($promo->start_date, $promo->end_date);
    }

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function browsingHistories(): HasMany
    {
        return $this->hasMany(BrowsingHistory::class);
    }

    public function requestItems(): HasMany
    {
        return $this->hasMany(RequestItem::class);
    }

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}