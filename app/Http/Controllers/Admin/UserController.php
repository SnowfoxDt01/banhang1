<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function listUser()
    {
        $users = User::paginate(5);
        return view('admins.users.listUser')
            ->with(['users' => $users]);
    }
    
    public function detailUser($id)
    {
        $user = User::findOrFail($id);
        return view('admins.users.detailUser', compact('user'));
    }

    public function updateUser($id)
    {
        $user = User::findOrFail($id);
        return view('admins.users.updateUser', compact('user'));
    }

    public function updatePatchUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:0,1',
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->role = $request->input('role');
        $user->updated_at = now();
        $user->save();
        return redirect()->route('admin.users.listUser')->with('message', 'Cập nhật người dùng thành công!');
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.listUser')->with('message', 'Người dùng đã được xóa thành công!');
    }
}
