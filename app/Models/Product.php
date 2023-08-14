<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['product_name','cost_price','product_sub_category','stock_quantity','sales_price','product_description','particulars','category_id','bar_code','prod_uniq','remarks'];
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
