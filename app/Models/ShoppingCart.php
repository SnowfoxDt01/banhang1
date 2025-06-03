<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;
    protected $table = 'shopping_cart';
    public $primaryKey = 'id';
    public $fillable = [
        'user_id',
        'created_at',
        'updated_at',
    ];
    public function items()
    {
        return $this->hasMany(ShoppingCartItem::class, 'shopping_cart_id');
    }
}
