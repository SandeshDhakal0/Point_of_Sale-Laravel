<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalInvoice extends Model
{
    use HasFactory;
    protected $table = 'finalinvoice';
    protected $fillable = ['customer_name','customer_email','customer_number','discount','vat','amount','invoice_id','payment_method','created_at','updated_at'];
}
