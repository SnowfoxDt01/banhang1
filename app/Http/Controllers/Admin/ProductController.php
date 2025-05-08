<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        echo "Product 321";
    } 
    public function getProduct()
    {
        echo "Product 123";
    }
}
