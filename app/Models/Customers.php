<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    use HasFactory;
    protected $table = 'customers';
    protected $fillable = ['firstname','middlename','lastname','email','mobilenumber','dtstamp'];
    public $timestamps = false;

}
