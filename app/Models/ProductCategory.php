<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = 'product_categories';
    public $primaryKey = 'id';
    protected $fillable = [
        'name',
        'description',
        'image',
        'created_at',
        'updated_at',
    ];
    // App\Models\Category
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
