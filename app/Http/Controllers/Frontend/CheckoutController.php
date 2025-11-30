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
use KHQR\BakongKHQR;
use KHQR\Helpers\KHQRData;
use KHQR\Models\IndividualInfo;

class CheckoutController extends Controller
{
    protected $userId;
    protected $cartItems;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->userId = Auth::id();

            $this->cartItems = CartItem::where('user_id', $this->userId)
                ->where('status', 'pending')
                ->with('service:id,title,price')
                ->get();

            return $next($request);
        });
    }

    public function index()
    {
        if ($this->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $this->cartItems->sum(fn($i) => $i->quantity * $i->service->price);

        return view('frontend.checkout.index', [
            'cartItems' => $this->cartItems,
            'totalAmount' => $total
        ]);
    }

    public function generateQr()
    {
        if ($this->cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        $user = Auth::user();
        $totalAmount = $this->cartItems->sum(fn($i) => $i->quantity * $i->service->price);


        $individual = new IndividualInfo(
            bakongAccountID: 'sopheaktra_peng@aclb',
            merchantName: "Men Sokeang",
            merchantCity: 'PHNOM PENH',
            currency: KHQRData::CURRENCY_KHR,
            amount: $totalAmount
        );

        $response = BakongKHQR::generateIndividual($individual);

        if ($response->status['code'] !== 0) {
            Log::error("KHQR generation failed", $response->status);
            return response()->json(['error' => 'Failed to generate KHQR'], 500);
        }

        $qrString = $response->data['qr'];
        $md5 = $response->data['md5'];
        $qrUrl = 'https://quickchart.io/qr?text=' . urlencode($qrString) . '&size=250';

        session([
            'checkout_cart_ids' => $this->cartItems->pluck('id')->toArray(),
            'checkout_md5' => $md5,
            'checkout_amount' => $totalAmount
        ]);

        return response()->json([
            'qrUrl' => $qrUrl,
            'amount' => $totalAmount,
            'md5' => $md5
        ]);
    }

    public function manualPayment(Request $request)
    {
        if ($this->cartItems->isEmpty()) {
            return response()->json(['paid' => false, 'error' => 'No pending items'], 400);
        }

        return response()->json(
            $this->finalizePayment($this->cartItems, Auth::user())
        );
    }

    private function finalizePayment($cartItems, $user)
    {
        $totalAmount = $cartItems->sum(fn($i) => $i->quantity * $i->service->price);

        // Prevent duplicate payments if processed already
        CartItem::whereIn('id', $cartItems->pluck('id'))->update([
            'status' => 'completed'
        ]);

        foreach ($cartItems as $item) {
            Checkout::create([
                'user_id' => $user->id,
                'service_id' => $item->service_id,
                'quantity' => $item->quantity,
                'total_price' => $item->quantity * $item->service->price,
            ]);
        }

        $planDetails = $cartItems
            ->map(fn($i) => "{$i->service->title} x{$i->quantity} - $" . number_format($i->service->price * $i->quantity, 2))
            ->implode("\n");

        return [
            'paid' => true,
            'total' => $totalAmount,
            'planDetails' => $planDetails,
            'email' => $this->sendEmailReceipt($user, $planDetails, $totalAmount),
            'telegram' => $this->sendTelegramNotification($user, $planDetails, $totalAmount),
        ];
    }

    private function sendEmailReceipt($user, $planDetails, $total)
    {
        try {
            Resend::emails()->send([
                'from' => env('MAIL_FROM_ADDRESS'),
                'to' => $user->email,
                'subject' => '🎉 Payment Successful!',
                'html' => "
                    <h1>Hello {$user->name}</h1>
                    <p>Thank you for your purchase!</p>
                    <pre>{$planDetails}</pre>
                    <p><strong>Total Paid:</strong> \${$total}</p>"
            ]);

            return 'Email sent';
        } catch (\Exception $e) {
            Log::error("Email error: " . $e->getMessage());
            return 'Email failed';
        }
    }

    private function sendTelegramNotification($user, $planDetails, $total)
    {
        try {
            $token = env('TELEGRAM_BOT_TOKEN');
            $chat = env('TELEGRAM_CHAT_ID');

            if (!$token || !$chat) {
                return "Telegram config missing";
            }

            Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id' => $chat,
                'text' =>
                    "🎉 *New Payment Received!*\n\n" .
                    "👤 *User:* " . e($user->name) . " (" . e($user->email) . ")\n" .
                    "🛒 *Items Purchased:*\n" . $planDetails . "\n" .
                    "💰 *Total Paid:* \${$total}\n" .
                    "✅ Status: Completed",
                'parse_mode' => 'Markdown'
            ]);

            return 'Telegram sent';
        } catch (\Exception $e) {
            Log::error("Telegram error: " . $e->getMessage());
            return 'Telegram failed';
        }
    }



}
