@extends('frontend.layout.master')

@section('title', 'Cart')

@section('content')

<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="row">
            <div class="col-12 mt-5 mt-lg-0">
                <div class="bg-primary mb-5 py-3 px-5">
                    <h3 class="text-center text-white py-3 px-4 m-0">CART ITEMS</h3>

                    @forelse($cartItems as $item)
                        <div class="d-flex justify-content-between align-items-center px-4 border-bottom py-3">
                            <h6 class="text-white my-3">{{ $item->service->title ?? 'Service' }}</h6>
                            <h6 class="text-white my-3">${{ number_format($item->service->price, 2) }}</h6>

                            <div class="d-flex text-center align-items-center">
                                <button class="btn btn-light my-3 decrease-qty" data-id="{{ $item->id }}" style="font-weight: bold">-</button>
                                <h6 class="text-white my-3 mx-3">{{ $item->quantity }}</h6>
                                <button class="btn btn-light my-3 increase-qty" data-id="{{ $item->id }}">+</button>
                            </div>

                            <h6 class="text-white my-3">Total: ${{ number_format($item->service->price * $item->quantity, 2) }}</h6>

                            <i class="fa fa-trash text-white my-3 fa-2x remove-item" style="cursor: pointer;" data-id="{{ $item->id }}"></i>
                        </div>
                    @empty
                        <p class="text-white text-center py-3">Your cart is empty.</p>
                    @endforelse

                    @if($cartItems->count() > 0)
                        <div class="py-3 px-4 border-top">
                            <a class="btn btn-block btn-secondary py-3 px-5" href="{{ route('checkout.index') }}">Check Out</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
