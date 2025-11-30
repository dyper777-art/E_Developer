<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Add a service to cart by service ID
     */
public function index()
{
    $userId = Auth::id();

    // Return empty collection if no user is logged in
    if (!$userId) {
        $cartItems = collect();
        return view('frontend.cart.index', compact('cartItems'));
    }

    // Get all pending cart items for this user
    $cartItems = CartItem::where('user_id', $userId)
                        ->where('status', 'pending')
                        ->with('service') // eager load service
                        ->get();

    return view('frontend.cart.index', compact('cartItems'));
}






    public function addToCart(Request $request)
{
    $userId = Auth::id();

    if (!$userId) {
        return response()->json([
            'success' => false,
            'message' => 'You must be logged in to add to cart'
        ], 401);
    }

    $serviceId = $request->input('serviceId');
    if (!$serviceId) {
        return response()->json([
            'success' => false,
            'message' => 'Service ID is required'
        ], 400);
    }

    $service = Service::findOrFail($serviceId);
    if ($service->status !== 'active') {
        return response()->json([
            'success' => false,
            'message' => 'This service is not available'
        ], 400);
    }

    // Use updateOrCreate to either create or increment
    $cartItem = CartItem::updateOrCreate(
        [
            'user_id' => $userId,
            'service_id' => $service->id,
            'status' => 'pending'
        ],
        [
            'quantity' => 1,
            'total_price' => $service->price
        ]
    );

    return response()->json([
        'success' => true,
        'message' => 'Service added to cart successfully'
    ]);
}

    public function destroy($id)
{
    $cartItem = \App\Models\CartItem::find($id);

    if (!$cartItem) {
        return response()->json(['message' => 'Item not found'], 404);
    }

    $cartItem->delete();

    return response()->json(['message' => 'Item removed successfully']);
}

}
