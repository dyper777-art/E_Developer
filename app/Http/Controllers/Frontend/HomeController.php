<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $customers = User::where('role', 'customer')->with('profile')->get();

        $services = Service::with('user')->get();

        $customer_count = $customers->count();
        $service_count = $services->count();
        $buyer_count = User::where('role', 'business')->count();

        return view('frontend.home.index', compact('customers', 'services', 'customer_count', 'service_count', 'buyer_count'));
    }
}
