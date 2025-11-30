@extends('frontend.layout.master')

@section('title', $service->title)

@section('content')

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mb-4">
            <img src="{{ asset($service->image) }}" class="img-fluid" alt="{{ $service->title }}">
        </div>
        <div class="col-lg-6">
            <h1>{{ $service->title }}</h1>
            <p>{{ $service->description }}</p>
            <h4>Price: ${{ number_format($service->price, 2) }}</h4>
            <p>Status: <strong>{{ ucfirst($service->status) }}</strong></p>
            <a href="{{ route('cart.add', $service->id) }}" class="btn btn-primary mt-3">Add to Cart</a>
        </div>
    </div>
</div>

@endsection
