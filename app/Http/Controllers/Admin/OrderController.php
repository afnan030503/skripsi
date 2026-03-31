<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.menu'])
            ->latest()
            ->paginate(15);

        return Inertia::render('Admin/Orders', [
            'orders' => $orders
        ]);
    }

    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:proses,success,cancel',
            'cancel_reason' => 'nullable|string|max:500',
        ]);

        $data = ['status' => $request->status];

        if ($request->status === 'cancel') {
            $data['cancel_reason'] = $request->cancel_reason;
        } else {
            // Reset cancel_reason jika status bukan cancel
            $data['cancel_reason'] = null;
        }

        $order->update($data);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui!');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Pesanan berhasil dihapus!');
    }
}
