<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class ClientController extends Controller
{
    public function index()
    {
        $listProductClient = Product::paginate(6);
        
        $topViewedProducts = Product::with('images')
        ->orderByDesc('view')
        ->orderBy('id') 
        ->take(6)
        ->get();

        return view('client.index', [
            'listProductClient' => $listProductClient,
            'topViewedProducts' => $topViewedProducts,
            
        ]);
    }  
    
    public function allProducts(Request $request)
    {
       

        $query = Product::with('images');

        if ($request->has('category') && $request->category) {
            $query->where('product_category_id', $request->category); // Sửa chỗ này
        }

        $products = $query->paginate(9);

        return view('client.allproducts', [
            'products' => $products,
            
        ]);
    }

    public function detail($id)
    {
        
        $product = Product::with(['images', 'productCategory', 'variantProducts'])->findOrFail($id);
        return view('client.detailproduct', [
            'product' => $product,
            
        ]);
    }
    public function contact()
    {   
        return view('client.contact');
    }
    public function cart()
    {
        
        return view('client.cart');
    }
}
