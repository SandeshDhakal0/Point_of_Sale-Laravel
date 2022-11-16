<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Inventory extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable = [
        'product_code',
        'product_name',
        'tag_number',
        'marked_price',
        'quantity',
    ];

    protected $dates = ['deleted_at'];
}
