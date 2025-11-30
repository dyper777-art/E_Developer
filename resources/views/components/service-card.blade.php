<div class="courses-item position-relative" style="margin: 0px 2px">
    <img src="{{ $service->image ? asset($service->image) : asset('frontend/assets/img/default-service.jpg') }}"
         alt="Service Image"
         style="width: 100%; height: 100%; object-fit: cover; aspect-ratio: 0.8 / 1;">

    <div class="courses-text">
        <h4 class="text-center text-white px-3">{{ $service->title }}</h4>
        <div class="border-top w-100 mt-3">
            <div class="d-flex justify-content-between p-4">
                <span class="text-white"><i class="fa fa-user mr-2"></i>{{ $service->user->name ?? 'Anonymous' }}</span>
            </div>
        </div>
        <div class="w-100 bg-white text-center p-4">
            <a class="btn btn-primary mr-4" href="{{ route('detail', $service->id) }}">Detail</a>
            @auth
                <a href="#" class="btn btn-primary add-to-cart" data-service-id="{{ $service->id }}">
                    Add To Cart
                </a>
            @endauth
        </div>
    </div>
</div>
