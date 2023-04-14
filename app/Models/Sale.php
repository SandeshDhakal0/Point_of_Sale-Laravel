<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = ['sold_to_user_id','sold_to_user_name','sold_quantity','sold_amount','product_id','created_at','updated_at'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
