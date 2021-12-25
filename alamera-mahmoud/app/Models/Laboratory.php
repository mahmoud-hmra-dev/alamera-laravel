<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laboratory extends Model
{
    protected $table='laboratorys';
    use HasFactory;
    public $fillable = [
        'product_name',
        'product_desc',
        'product_qty'
    ];	
}
