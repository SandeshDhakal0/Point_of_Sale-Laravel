<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WholesalePurchaseRecord extends Model
{
    use HasFactory;
    protected $table = 'wholesale_purchase_record';
    protected $fillable = ['invoice_date','bill_no','vendor_name','vat_no','amount','amount_with_vat'];
    public $timestamps = false;
}
