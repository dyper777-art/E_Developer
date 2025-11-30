<div class="owl-item active" style="width: 330px; margin-right: 30px;">
    <div class="team-item">
        <img class="img-fluid w-100" src="{{ $customer->profile->image ?? asset('frontend/assets/img/default-profile.jpg') }}" alt="">
        <div class="bg-light text-center p-4">
            <h5 class="mb-3">{{ $customer->name }}</h5>
            <p class="mb-2">Web Design &amp; Development</p>
            <div class="d-flex justify-content-center">
                <a class="mx-1 p-1" href="#"><i class="fab fa-twitter"></i></a>
                <a class="mx-1 p-1" href="#"><i class="fab fa-facebook-f"></i></a>
                <a class="mx-1 p-1" href="#"><i class="fab fa-linkedin-in"></i></a>
                <a class="mx-1 p-1" href="#"><i class="fab fa-instagram"></i></a>
                <a class="mx-1 p-1" href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</div>
