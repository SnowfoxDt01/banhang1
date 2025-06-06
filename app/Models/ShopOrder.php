<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopOrder extends Model
{
    use HasFactory;
    protected $table = 'shop_order';
    protected $fillable = [
        'user_id',
        'address_id',
        'total_price',
        'order_status',
        'payment_method',
        'payment_status',
        'created_at',
        'updated_at'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

}
