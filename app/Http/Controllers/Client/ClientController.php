<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItem;
use App\Models\VariantProduct;
use Illuminate\Support\Facades\Auth;

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
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $variantId = $request->input('variant_id');
        $quantity = (int) $request->input('quantity', 1);
        $userId = Auth::id();

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng!');
        }

        $shoppingCart = ShoppingCart::firstOrCreate(['user_id' => $userId]);
        $variantProduct = VariantProduct::findOrFail($variantId);
        $availableStock = $variantProduct->quantity;

        if ($quantity > $availableStock) {
            return redirect()->back()->with('error', 'Số lượng yêu cầu vượt quá số lượng tồn kho!');
        }

        $existingItem = $shoppingCart->items()->where('variant_id', $variantId)->first();
        if ($existingItem) {
            $newQuantity = $existingItem->quantity + $quantity;
            if ($newQuantity > $availableStock) {
                return redirect()->back()->with('error', 'Trong giỏ hàng không thể vượt quá số lượng tồn kho!');
            }
            $existingItem->update(['quantity' => $newQuantity]);
        } else {
            ShoppingCartItem::create([
                'shopping_cart_id' => $shoppingCart->id,
                'variant_id' => $variantId,
                'product_id' => $productId,
                'quantity' => $quantity,
                'price' => $variantProduct->product->sale_price > 0 ? $variantProduct->product->sale_price : $variantProduct->product->base_price,
            ]);
        }
        return redirect()->route('client.cart')->with('success', 'Đã thêm vào giỏ hàng!');
    }
    public function checkout()
    {
        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thanh toán!');
        }

        $shoppingCart = ShoppingCart::where('user_id', $userId)->with('items.variantProduct.product', 'items.variantProduct.images')->first();
        if (!$shoppingCart || $shoppingCart->items->isEmpty()) {
            return redirect()->route('client.cart')->with('error', 'Giỏ hàng của bạn đang trống!');
        }

        // Prepare display data for cart items
        $cartDisplayItems = $shoppingCart->items->map(function ($item) {
            $product = $item->variantProduct->product;
            $variant = $item->variantProduct;
            $price = $product->sale_price > 0 ? $product->sale_price : $product->base_price;
            $lineTotal = $price * $item->quantity;
            $variantImage = $variant->images->image ?? ($product->images->first()->image ?? 'client/img/default.png');
            $shortName = mb_strlen($product->name) > 10 ? mb_substr($product->name, 0, 10) . '...' : $product->name;

            return [
                'image' => $variantImage,
                'name' => $shortName,
                'quantity' => $item->quantity,
                'line_total' => $lineTotal,
            ];
        });

        // Tính tổng tiền
        $cartTotal = $cartDisplayItems->sum('line_total');

        return view('client.checkout', [
            'shoppingCart' => $shoppingCart,
            'cartDisplayItems' => $cartDisplayItems,
            'cartTotal' => $cartTotal,
        ]);
    }
}
