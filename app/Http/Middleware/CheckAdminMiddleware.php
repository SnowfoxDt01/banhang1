<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with(['message' => 'Bạn phải đăng nhập trước']);
        }
        // Nếu là admin (role = 0) thì cho đi tiếp
        if (Auth::user()->role == 0) {
            return $next($request);
        }
        // Nếu là user thường (role = 1) thì chuyển hướng về trang người dùng (hoặc trang phù hợp)
        if (Auth::user()->role == 1) {
            // Nếu đã có route trang người dùng, chuyển hướng về đó
            // return redirect()->route('user.home')->with('message', 'Bạn không có quyền truy cập trang quản trị!');
            return $next($request);
        }
        // Trường hợp khác (phòng lỗi)
        Auth::logout();
        return redirect()->route('login')->with('message', 'Tài khoản không hợp lệ!');
    }
}
