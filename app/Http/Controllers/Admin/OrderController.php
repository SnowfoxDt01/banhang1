<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopOrder;

class OrderController extends Controller
{
    public function index()
    {
        // Lấy danh sách đơn hàng, kèm thông tin user và address, phân trang
        $orders = ShopOrder::with(['user', 'address'])->orderByDesc('created_at')->paginate(10);

        // Trả về view danh sách đơn hàng
        return view('admins.orders.index', compact('orders'));
    }


}
