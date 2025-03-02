<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem; // ✅ Fix Import: Ensure we use CartItem Model
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartItems = auth()->check()
            ? CartItem::where('user_id', auth()->id())->with('product')->get()
            : session()->get('cart', []);

        // ✅ Fix: Use count() instead of isEmpty() for arrays
        if (auth()->check() && $cartItems->isEmpty() || (!auth()->check() && count($cartItems) === 0)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('orders.checkout', compact('cartItems'));
    }

    public function placeOrder(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Please log in to place an order.');
        }

        $cartItems = CartItem::where('user_id', auth()->id())->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // ✅ Fix: Ensure we calculate the total price correctly
        $totalPrice = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        // ✅ Fix: Wrap order creation in a transaction to prevent errors
        \DB::beginTransaction();
        try {
            // Create Order
            $order = Order::create([
                'user_id' => auth()->id(),
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            // Save order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'plant_product_id' => $item->plant_product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Clear cart after order placement
            CartItem::where('user_id', auth()->id())->delete();
            session()->forget('cart');

            \DB::commit(); // ✅ Commit transaction if all goes well

            return redirect()->route('orders.success')->with('success', 'Your order has been placed successfully.');
        } catch (\Exception $e) {
            \DB::rollback(); // ✅ Rollback if something goes wrong
            return redirect()->route('cart.index')->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function orderSuccess()
    {
        return view('orders.success');
    }
}
