<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VariantProduct;

class VariantController extends Controller
{
    public function listVariant(){
        $variants = VariantProduct::paginate(5);
        return view('admins.variants.listVariant')
        ->with(['variants' => $variants]);
    }
}
