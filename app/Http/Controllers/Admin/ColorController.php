<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    public function listColor()
    {
        $colors = Color::paginate(5);
        return view('admins.colors.listColor', compact('colors'));
    }

    public function addColor()
    {
        return view('admins.colors.addColor');
    }

    public function addPostColor(Request $request)
    {
        $request->validate([
            'name' => 'required',
            
        ]);
        Color::create([
            'name' => $request->input('name'),
            
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.colors.listColor')->with('message', 'Thêm màu thành công!');
    }

    public function deleteColor($id)
    {
        $color = Color::findOrFail($id);
        $color->delete();
        return redirect()->route('admin.colors.listColor')->with('message', 'Màu đã được xóa thành công!');
    }

    public function detailColor($id)
    {
        $color = Color::findOrFail($id);
        return view('admins.colors.detailColor', compact('color'));
    }

    public function updateColor($id)
    {
        $color = Color::findOrFail($id);
        return view('admins.colors.updateColor', compact('color'));
    }

    public function updatePatchColor(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            
        ]);
        $color = Color::findOrFail($id);
        $color->name = $request->input('name');
        $color->updated_at = now();
        $color->save();
        return redirect()->route('admin.colors.listColor')->with('message', 'Cập nhật màu thành công!');
    }
}
