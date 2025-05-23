<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function login(){
        return view('login');
    }
    public function postLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $dataUserLogin = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $remember = $request->has('remember');
        if (Auth::attempt($dataUserLogin, $remember)) {
            if (Auth::user()->role == 1) {
                return redirect()->route('index')->with('message', 'Đăng nhập thành công!');
            }
            if (Auth::user()->role == 0) {
                return redirect()->route('admin.products.listProduct')->with('message', 'Chào mừng đến trang quản trị!');
            }
        } else {
            return redirect()->back()->with('message', 'Đăng nhập thất bại! Vui lòng kiểm tra lại thông tin.');
        }
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login')->with('message', 'Đăng xuất thành công!');
    }

    public function register(){
        return view('register');
    }
    public function postRegister(Request $request){
        $checkEmail = User::where('email', $request->email)->exists();
        if ($checkEmail) {
            return redirect()->back()->with('message', 'Email đã tồn tại!');
        }
        else {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:6|confirmed'
            ]);
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => hash::make($request->password)
            ];
            $newUser = User::create($data);
            return redirect()->route('login')->with('message', 'Đăng ký thành công! Vui lòng đăng nhập.');
        }
    }
}
