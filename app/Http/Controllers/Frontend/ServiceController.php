<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('user')->get();

        return view('frontend.service.index', compact('services'));
    }
}
