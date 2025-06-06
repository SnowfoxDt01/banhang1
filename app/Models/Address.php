<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'addresses';
    protected $fillable = [
        'user_id',
        'name',
        'phone',
        'address_line1',
        'address_line2',
        'city',
        'zip_code',
        'created_at',
        'updated_at'
    ];
}
