<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class OrderController extends Controller
{
    // Hiển thị tất cả đơn hàng
    public function index()
    {
        $orders = Order::all();
        return response()->json($orders);
    }
    public function getOrderById($Id)
    {
        $order = Order::with('items')->where('order_id', $Id)->first();
        return response()->json(['order' => $order]);
    }


    public function getOrderByUserId($userId)
    {
        $order = Order::with('items')->where('user_id', $userId)->get();
        return response()->json(['order' => $order]);
    }
    //lấy ra tất cả đơn hàng đã mua dựa trên id người dùng (page user)
    public function getOrderComplete($userId)
    {
        $order = Order::with('items')->where('user_id', $userId)->where('status', 'completed')->get();
        return response()->json(['order' => $order]);
    }
    //lấy ra tất cả đơn hàng đã giao (page admin)
    public function getOrderCompleteByAdmin()
    {
        $order = Order::with('items')->where('status', 'completed')->get();
        return response()->json(['order' => $order]);
    }
    // Tạo đơn hàng mới
    public function store(Request $request)
    {
        // Xác thực dữ liệu gửi lên
        $request->validate([
            'user_id' => 'required|integer',
            'customer_name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
            'items' => 'required|array',
            'payment_method' => 'required|string|max:20',
            'total_amount' => 'required|numeric',
            'status' => 'nullable|string|in:pending,completed',
        ]);

        do {
            $order_code = '#'.mt_rand(1, 999999999); // Tạo mã ngẫu nhiên
        } while (Order::where('order_code', $order_code)->exists());

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => $request->user_id,
            'order_code' => $order_code,
            'customer_name' => $request->customer_name,
            'address' => $request->address,
            'phone' => $request->phone,
            'payment_method' => $request->payment_method,
            'total_amount' => $request->total_amount,
            'status' => $request->status ?? 'pending',
        ]);

        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->order_id,
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json(['order' => $order], 201);
    }

    // Cập nhật thông tin đơn hàng
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->status = 'completed';
        $order->save();

        return response()->json($order);
    }

    // Hủy đơn hàng
    public function destroy($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        if ($order->status !== 'pending') {
            return response()->json(['message' => 'Không thể hủy đơn hàng'], 403);
        }

        $order->delete();
        return response()->json(['message' => 'Hủy đơn hàng thành công']);
    }

    //tìm kiếm theo mã đơn hàng
    public function searchOrderByCode(Request $request){
        $orderCode = $request->input('order_code');
        $order = Order::where('order_code', '=', $orderCode)->first();
        if (!$order) {
            return response()->json(['message' => 'Không tìm thấy đơn hàng'], 404);
        }
        return response()->json($order);
    }

}
