<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\VariantProduct;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Image;

class VariantController extends Controller
{
    public function listVariant(){
        $variants = VariantProduct::paginate(5);
        return view('admins.variants.listVariant')
        ->with(['variants' => $variants]);
    }
    
    public function deleteVariant($id)
    {
        $variant = VariantProduct::findOrFail($id);
        // Xóa ảnh liên quan trong thư mục public
        if ($variant->image) {
            $imagePath = public_path($variant->image->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $variant->image->delete();
        }
        $variant->delete();
        return redirect()->route('admin.variants.listVariant')->with('message', 'Biến thể đã được xóa thành công!');
    }
    public function detailVariant($id)
    {
        $variant = VariantProduct::findOrFail($id);
        return view('admins.variants.detailVariant')
        ->with(['variant' => $variant]);
    }
    public function updateVariant($id)
    {
        $variant = VariantProduct::findOrFail($id);
        $sizes = Size::all();
        $colors = Color::all();
        $products = Product::all();
        return view('admins.variants.updateVariant', compact('variant', 'sizes', 'colors', 'products'));
    }
    public function updatePatchVariant(Request $request, $id)
    {
        $request->validate([
            'variant_name' => 'required',
            'variant_price' => 'required|numeric',
            'variant_quantity' => 'required|numeric',
            'variant_size' => 'required|exists:sizes,id',
            'variant_color' => 'required|exists:colors,id',
            'variant_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $variant = VariantProduct::findOrFail($id);
        $variant->update([
            'name' => $request->variant_name,
            'variant_price' => $request->variant_price,
            'quantity' => $request->variant_quantity,
            'size_id' => $request->variant_size,
            'color_id' => $request->variant_color,
            'updated_at' => now(),
        ]);
        // Xử lý ảnh biến thể nếu có upload mới
        if ($request->hasFile('variant_image')) {
            if ($variant->images) {
                $imagePath = public_path($variant->images->image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $variant->images->delete();
            }
            $image = $request->file('variant_image');
            $newName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $linkStorage = 'imageProducts/';
            $image->move(public_path($linkStorage), $newName);
            $linkImage = $linkStorage . $newName;
            Image::create([
                'variant_product_id' => $variant->id,
                'image' => $linkImage,
                'alt' => 'Ảnh biến thể (' . $variant->name . ')',
            ]);
        }
        return redirect()->route('admin.variants.listVariant')->with('message', 'Biến thể đã được cập nhật thành công!');
    }
}
