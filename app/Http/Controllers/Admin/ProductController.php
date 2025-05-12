<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\VariantProduct;
use App\Models\Color;
use App\Models\Size;
use App\Models\Image;

class ProductController extends Controller
{
    public function listProduct()
    {
        $listProduct = Product::paginate(5);
        return view('admins.products.listProduct')
        ->with(['listProduct' => $listProduct]);
    } 
    public function addProduct()
    {
        $categories = ProductCategory::all();
        $colors = Color::all();
        $sizes = Size::all();
        return view('admins.products.addProduct', compact('categories', 'colors', 'sizes'));
    }

    public function addPostProduct(Request $request)
    {
        try {
            $request->validate([
                'nameSP' => 'required',
                'descriptionSP' => 'required',
                'base_price' => 'required|numeric',
                'sale_price' => 'required|numeric',
                'product_category_id' => 'required|exists:product_categories,id',
                'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'nameSP.required' => 'Tên sản phẩm là bắt buộc.',
                'descriptionSP.required' => 'Mô tả sản phẩm là bắt buộc.',
                'base_price.required' => 'Giá sản phẩm là bắt buộc.',
                'base_price.numeric' => 'Giá sản phẩm phải là số.',
                'sale_price.numeric' => 'Giá khuyến mãi phải là số.',
                'product_category_id.required' => 'Danh mục sản phẩm là bắt buộc.',
                'product_category_id.exists' => 'Danh mục sản phẩm không hợp lệ.',
                'images.*.image' => 'Tệp tải lên phải là hình ảnh.',
                'images.*.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, hoặc gif.',
                'images.*.max' => 'Hình ảnh không được vượt quá 2MB.',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->with('error', 'Lỗi xác thực dữ liệu!');
        }

        $product = Product::create([
            'name' => $request->nameSP,
            'base_price' => $request->base_price,
            'sale_price' => $request->sale_price,
            'description' => $request->descriptionSP,
            'product_category_id' => $request->product_category_id,
            'is_new' => $request->is_new ?? 0,
            'view' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Lưu nhiều ảnh cho sản phẩm chính
        if ($request->hasFile('product_images')) {
            $imageIndex = 1; // Để đánh số thứ tự ảnh
            foreach ($request->file('product_images') as $image) {
                $newName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $linkStorage = 'imageProducts/';
                $image->move(public_path($linkStorage), $newName);
                $linkImage = $linkStorage . $newName;

                Image::create([
                    'product_id' => $product->id,
                    'image' => $linkImage,
                    'alt' => 'Ảnh sản phẩm (' . $product->name . ') - ' . $imageIndex,
                ]);
                $imageIndex++;
            }
        }

        // Lưu ảnh cho sản phẩm biến thể
        if ($request->has('variant_name') && !empty(array_filter($request->variant_name))) {
            foreach ($request->variant_name as $key => $name) {
                $sizeId = $request->variant_size[$key];
                $colorId = $request->variant_color[$key];

                // Kiểm tra xem biến thể với kích cỡ và màu sắc này đã tồn tại chưa
                $existingVariant = VariantProduct::where('product_id', $product->id)
                    ->where('size_id', $sizeId)
                    ->where('color_id', $colorId)
                    ->first();

                if (!$existingVariant) {
                    // Tạo sản phẩm biến thể nếu chưa tồn tại
                    $variant = VariantProduct::create([
                        'name' => $name,
                        'quantity' => $request->variant_quantity[$key],
                        'product_id' => $product->id,
                        'size_id' => $sizeId,
                        'color_id' => $colorId,
                        'variant_price' => $request->variant_price[$key],
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                    // Lưu một ảnh cho mỗi biến thể
                    if ($request->hasFile('variant_image') && isset($request->file('variant_image')[$key])) {
                        $image = $request->file('variant_image')[$key];
                        $newName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $linkStorage = 'imageProducts/';
                        $image->move(public_path($linkStorage), $newName);
                        $linkImageVP = $linkStorage . $newName;

                        Image::create([
                            'variant_product_id' => $variant->id,
                            'image' => $linkImageVP,
                            'alt' => 'Ảnh sản phẩm (' . $product->name . ') - Biến thể ' . $name,
                        ]);
                    }
                }
            }
        }

        return redirect()->route('admin.products.listProduct')->with(['message' => 'Thêm sản phẩm thành công!']);
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);

        // Xóa các ảnh liên quan trong thư mục public
        foreach ($product->images as $image) {
            $imagePath = public_path($image->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $image->delete();
        }

        // Xóa sản phẩm
        $product->delete();

        return redirect()->route('admin.products.listProduct')->with('message', 'Sản phẩm đã được xóa thành công!');
    }

    public function detailProduct($id)
    {
        // Lấy thông tin sản phẩm cùng với tên màu và kích thước của sản phẩm biến thể
        $product = Product::with([
            'productCategory',
            'variantProducts.color',
            'variantProducts.size',
            'variantProducts.images',
            // 'reviews'
        ])->findOrFail($id);

        
        // // Tính số lượng đánh giá

        // $totalReviews = $product->reviews->count();

        // // Tính điểm trung bình đánh giá
        // $averageRating = $totalReviews > 0 ? $product->reviews->avg('rating') : 0;

        // Trả về view chi tiết sản phẩm
        return view('admins.products.detailProduct', compact('product'))
            ->with([
                'product' => $product,
                // 'totalReviews' => $totalReviews,
                // 'averageRating' => $averageRating
            ]);
    }
}
