<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model
{
    use HasFactory;
    protected $table = 'shopping_cart_item';
    public $primaryKey = 'id';
    public $fillable = [
        'shopping_cart_id',
        'product_id',
        'variant_id',
        'quantity',
        'price',
        'created_at',
        'updated_at'
    ];
}
