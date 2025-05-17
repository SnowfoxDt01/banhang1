<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    public function listSize()
    {
        $sizes = Size::paginate(5);
        return view('admins.sizes.listSize', compact('sizes'));
    }

    public function addSize()
    {
        return view('admins.sizes.addSize');
    }

    public function addPostSize(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        Size::create([
            'name' => $request->input('name'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('admin.sizes.listSize')->with('message', 'Thêm kích cỡ thành công!');
    }

    public function deleteSize($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        return redirect()->route('admin.sizes.listSize')->with('message', 'Kích cỡ đã được xóa thành công!');
    }

    public function detailSize($id)
    {
        $size = Size::findOrFail($id);
        return view('admins.sizes.detailSize', compact('size'));
    }

    public function updateSize($id)
    {
        $size = Size::findOrFail($id);
        return view('admins.sizes.updateSize', compact('size'));
    }

    public function updatePatchSize(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $size = Size::findOrFail($id);
        $size->name = $request->input('name');
        $size->updated_at = now();
        $size->save();
        return redirect()->route('admin.sizes.listSize')->with('message', 'Cập nhật kích cỡ thành công!');
    }
}
