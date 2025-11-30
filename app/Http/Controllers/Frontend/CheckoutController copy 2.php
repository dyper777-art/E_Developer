<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Checkout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Resend\Laravel\Facades\Resend;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public $userId;
    public $cartItems;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->userId = Auth::id();
            $this->cartItems = CartItem::whereHas('cart', function($q){
                    $q->where('user_id', $this->userId)->where('status', 'pending');
                })
                ->with('service')
                ->get();
            return $next($request);
        });
    }

    // Show checkout page
    public function index()
    {
        $cartItems = $this->cartItems;

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $totalAmount = $cartItems->sum(function($item) {
            return $item->quantity * $item->service->price;
        });

        return view('frontend.checkout.index', compact('cartItems', 'totalAmount'));
    }

    // Generate QR Code placeholder (if needed)
    public function generateQr(Request $request)
    {
        $cartItems = $this->cartItems;

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $totalAmount = $cartItems->sum(fn($item) => $item->quantity * $item->service->price);

        // Generate QR string (placeholder, adapt your payment gateway)
        $qrString = "PAYMENT|" . $totalAmount . "|" . $this->userId;
        $qrUrl = 'https://quickchart.io/qr?text=' . urlencode($qrString) . '&size=250';

        session([
            'checkout_cart_ids' => $cartItems->pluck('id')->toArray(),
        ]);

        return response()->json([
            'qrUrl' => $qrUrl,
            'amount' => $totalAmount,
        ]);
    }

    // Manual payment simulation
    public function manualPayment(Request $request)
    {
        $user = Auth::user();
        $cartItems = $this->cartItems;

        if ($cartItems->isEmpty()) {
            return response()->json(['paid' => false, 'error' => 'No pending items'], 400);
        }

        return response()->json($this->finalizePayment($cartItems, $user));
    }

    // Complete checkout
    private function finalizePayment($cartItems, $user)
    {
        $totalAmount = $cartItems->sum(fn($item) => $item->quantity * $item->service->price);

        // Create Checkout records and mark cart items as completed
        foreach ($cartItems as $item) {
            $item->update(['status' => 'completed']);

            Checkout::create([
                'user_id' => $user->id,
                'service_id' => $item->service_id,
                'quantity' => $item->quantity,
                'total_price' => $item->quantity * $item->service->price,
            ]);
        }

        $planDetails = $cartItems->map(fn($item) => "{$item->service->title} x{$item->quantity} - $" . number_format($item->quantity * $item->service->price, 2))->implode("\n");

        $emailStatus = $this->sendEmailReceipt($user, $planDetails, $totalAmount);
        $telegramStatus = $this->sendTelegramNotification($user, $planDetails, $totalAmount);

        return [
            'paid' => true,
            'total' => $totalAmount,
            'planDetails' => $planDetails,
            'email' => $emailStatus,
            'telegram' => $telegramStatus
        ];
    }

    private function sendEmailReceipt($user, $planDetails, $totalAmount)
    {
        try {
            Resend::emails()->send([
                'from' => env('MAIL_FROM_ADDRESS'),
                'to' => $user->email,
                'subject' => '🎉 Payment Successful!',
                'html' => "<h1>Hello {$user->name}</h1>
                          <p>Thank you for your purchase! ✅</p>
                          <pre>{$planDetails}</pre>
                          <p><strong>Total Paid:</strong> \${$totalAmount}</p>"
            ]);

            return 'Email sent successfully';
        } catch (\Exception $e) {
            Log::error('Email sending failed', ['error' => $e->getMessage()]);
            return 'Email failed: ' . $e->getMessage();
        }
    }

    private function sendTelegramNotification($user, $planDetails, $totalAmount)
    {
        try {
            $botToken = env('TELEGRAM_BOT_TOKEN');
            $chatId = env('TELEGRAM_CHAT_ID');

            $message = "🎉 *New Payment Received!*\n\n";
            $message .= "👤 *User:* {$user->name} ({$user->email})\n";
            $message .= "🛒 *Items Purchased:*\n{$planDetails}\n";
            $message .= "💰 *Total Paid:* \${$totalAmount}\n";
            $message .= "✅ Status: Completed";

            Http::post("https://api.telegram.org/bot{$botToken}/sendMessage", [
                'chat_id' => $chatId,
                'text' => $message,
                'parse_mode' => 'Markdown',
            ]);

            return 'Telegram sent successfully';
        } catch (\Exception $e) {
            Log::error('Telegram error', ['error' => $e->getMessage()]);
            return 'Telegram failed: ' . $e->getMessage();
        }
    }
}
