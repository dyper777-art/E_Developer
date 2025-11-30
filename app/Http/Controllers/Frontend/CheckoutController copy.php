<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    /**
     * Add a service to cart by service ID
     */

    public function processCheckout(Request $request)
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Please log in to proceed to checkout.');
        }

        $cart = Cart::where('user_id', $userId)->first();

        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        // Calculate total
        $totalAmount = $cart->cartItems->sum(function ($item) {
            return $item->service->price * $item->quantity;
        });

        // Create Order
        $order = Order::create([
            'user_id' => $userId,
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        // Create Order Items
        foreach ($cart->cartItems as $item) {
            $order->items()->create([
                'service_id' => $item->service_ids,
                'quantity' => $item->quantity,
                'price' => $item->service->price,
            ]);
        }

        // Clear user's cart
        $cart->cartItems()->delete();

        return redirect()->route('checkout.success', $order->id)->with('success', 'Order placed successfully!');
    }

    public function success(Order $order)
{
    return view('frontend.checkout.success', compact('order'));
}

}


