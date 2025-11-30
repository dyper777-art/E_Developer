<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;


class DetailController extends Controller
{
    public function show($id)
    {
        $service = Service::findOrFail($id);
        return view('frontend.detail.index', compact('service'));
    }
}

