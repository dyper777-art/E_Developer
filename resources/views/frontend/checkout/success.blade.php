@extends('frontend.layout.master')

@section('title', 'Order Success')

@section('content')
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="bg-primary text-white text-center p-5">
                    <h2>Thank You!</h2>
                    <p>Your order #{{ $order->id }} has been placed successfully.</p>
                    <p>Total Amount: ${{ number_format($order->total_amount, 2) }}</p>
                    <a href="{{ route('home') }}" class="btn btn-light mt-3">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
