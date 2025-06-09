<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShopOrder;
use App\Models\Bill;

class OrderController extends Controller
{
    public function index()
    {
        // Lấy danh sách đơn hàng, kèm thông tin user và address, phân trang
        $orders = ShopOrder::with(['user', 'address'])->orderByDesc('created_at')->paginate(10);

        // Trả về view danh sách đơn hàng
        return view('admins.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = ShopOrder::with(['user', 'address', 'orderItems.variant'])->findOrFail($id);
        return view('admins.orders.show', compact('order'));
    }

    public function edit($id)
    {
        $order = ShopOrder::with(['user', 'address', 'orderItems.variant'])->findOrFail($id);
        return view('admins.orders.edit', compact('order'));
    }

    public function update(Request $request, $id)
    {
        $order = ShopOrder::findOrFail($id);
        $oldStatus = $order->payment_status;
        $newStatus = $request->input('payment_status', $oldStatus);
        $order->payment_status = $newStatus;
        $order->save();

        // Nếu trạng thái mới là "completed", tạo hóa đơn nếu chưa có
        if ($newStatus == 'completed') {
            if (!Bill::where('order_id', $order->id)->exists()) {
                Bill::create([
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'created_at' => now(),
                ]);
            }
            return redirect()->route('admin.bills.index')->with('success', 'Đơn hàng đã hoàn thành. Hóa đơn đã được tạo.');
        }
        return redirect()->route('admin.orders.index')->with('message', 'Cập nhật đơn hàng thành công!');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = ShopOrder::findOrFail($id);

        // Lấy trạng thái hiện tại và trạng thái mới từ yêu cầu
        $currentStatus = $order->order_status;
        $newStatus = $request->input('order_status');

        // Nếu không cần kiểm tra chuyển đổi trạng thái, chỉ cần cập nhật trực tiếp
        $updateData = ['order_status' => $newStatus];

        

        // Cập nhật đơn hàng
        $order->update($updateData);

        // Nếu trạng thái mới là "completed", tạo hóa đơn nếu chưa có
        if ($newStatus == 'completed') {
            if (!$order->bill) {
                Bill::create([
                    'order_id' => $order->id,
                    'user_id' => $order->user_id,
                    'created_at' => now(),
                ]);
            }
            return redirect()->route('admin.bills.index', $order->id)->with('success', 'Đơn hàng đã hoàn thành. Hóa đơn đã được tạo.');
        }

        return redirect()->route('admin.orders.index')->with('success', 'Trạng thái đơn hàng đã được cập nhật.');
    }
}
