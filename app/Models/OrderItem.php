<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $table = 'shop_order_item';
    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'quantity',
        'order_total_price',
        'created_at',
        'updated_at'
    ];
    public function order()
    {
        return $this->belongsTo(ShopOrder::class, 'order_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function variant()
    {
        return $this->belongsTo(VariantProduct::class, 'variant_id');
    }
}
