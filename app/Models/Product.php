<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    public $primaryKey = 'id';

    protected $fillable = [
        'product_category_id',
        'name',
        'description',
        'base_price',
        'sale_price',
        'is_new',
        'view',
        'created_at',
        'updated_at'
    ];
    public function images()
{
    return $this->hasMany(Image::class);
}

    public function variantProducts()
    {
        return $this->hasMany(VariantProduct::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
