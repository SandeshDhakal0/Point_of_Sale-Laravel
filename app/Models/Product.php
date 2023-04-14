<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Product extends Model
{
    use HasFactory;
    protected $fillable = ['product_name','product_brand','product_sub_category','stock_quantity','sales_price','product_description','available_sizes','category_id'];
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,);
    }
    public function image(): HasMany
    {
        return $this->hasMany(Image::class, 'product_id');
    }

    public function sale(): HasMany
    {
        return $this->hasMany(Sale::class,'product_id');
    }
}
