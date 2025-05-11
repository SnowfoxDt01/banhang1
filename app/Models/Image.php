<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $table = 'images';
    public $primaryKey = 'id';
    protected $fillable = [
        'image',
        'product_id', 
        'variant_product_id',
        'alt',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function variantProduct()
    {
        return $this->belongsTo(VariantProduct::class);
    }
}
