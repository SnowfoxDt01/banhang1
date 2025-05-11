<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariantProduct extends Model
{
    use HasFactory;
    protected $table = 'variant_products';
    public $primaryKey = 'id';
    public $fillable = [
        'product_id',
        'name',
        'quantity',
        'color_id',
        'size_id',
        'variant_price',
        'created_at',
        'updated_at'
    ];
}
