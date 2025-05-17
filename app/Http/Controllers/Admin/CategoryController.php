<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class CategoryController extends Controller
{
    public function listCategory()
    {
        $categories = ProductCategory::paginate(5);
        return view('admins.categories.listCategory')
            ->with(['categories' => $categories]);
        
    }
    public function addCategory()
    {
        return view('admins.categories.addCategory');
    }
    public function addPostCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $newName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $linkStorage = 'imageCategory/';
            $image->move(public_path($linkStorage), $newName);
            $data['image'] = $linkStorage . $newName;
        }
        ProductCategory::create($data);
        return redirect()->route('admin.categories.listCategory')->with('message', 'Thêm danh mục thành công!');
    }
    public function deleteCategory($id)
    {
        $category = ProductCategory::findOrFail($id);
        // Xóa ảnh liên quan trong thư mục public
        if ($category->image) {
            $imagePath = public_path($category->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $category->delete();
        return redirect()->route('admin.categories.listCategory')->with('message', 'Danh mục đã được xóa thành công!');
    }
    public function detailCategory($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('admins.categories.detailCategory')
            ->with(['category' => $category]);
    }
    public function updateCategory($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('admins.categories.updateCategory', compact('category'));
    }

    public function updatePatchCategory(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $category = ProductCategory::findOrFail($id);
        $category->name = $request->input('name');
        $category->description = $request->input('description');
        $category->updated_at = now();
        // Xử lý ảnh nếu có upload mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($category->image) {
                $oldImagePath = public_path($category->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            $image = $request->file('image');
            $newName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $linkStorage = 'imageCategory/';
            $image->move(public_path($linkStorage), $newName);
            $category->image = $linkStorage . $newName;
        }
        $category->save();
        return redirect()->route('admin.categories.listCategory')->with('message', 'Cập nhật danh mục thành công!');
    }
}
