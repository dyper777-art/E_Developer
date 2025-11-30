@extends('frontend.layout.master')

@section('title', 'home')

@section('content')
    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="{{ asset('frontend/assets/img/about.jpg') }}"
                            style="object-fit: contain;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">About Us</h6>
                        <h1 class="display-4">First Choice For Website Developing</h1>
                    </div>
                    <p>
                        perfectly captures the essence of a modern e-learning platform. It conveys trust and credibility by
                        positioning the service as the top option for learners. The phrase “online education” immediately
                        tells users what the platform offers, while “anywhere” emphasizes flexibility and accessibility,
                        highlighting that learning can happen from any location at any time. Overall, this slogan
                        communicates quality, convenience, and a global reach, making it clear that the platform is a
                        reliable and accessible choice for learners everywhere.
                    </p>
                    <div class="row pt-3 mx-0">
                        <div class="col-3 px-0">
                            <div class="bg-success text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">{{ $customer_count }}</h1>
                                <h6 class="text-uppercase text-white">Offering<span class="d-block">Services</span></h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-primary text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">{{ $service_count }}</h1>
                                <h6 class="text-uppercase text-white">Web<span class="d-block">Developers</span></h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-secondary text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">{{ $buyer_count }}</h1>
                                <h6 class="text-uppercase text-white">Current<span class="d-block">Buyers</span></h6>
                            </div>
                        </div>
                        {{-- <div class="col-3 px-0">
                            <div class="bg-warning text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">1234</h1>
                                <h6 class="text-uppercase text-white">Happy<span class="d-block">Students</span></h6>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Courses Start -->
    <div class="container-fluid px-0 py-5">
        <div class="row mx-0 justify-content-center pt-5 bg-image">
            <div class="col-lg-6">
                <div class="section-title text-center position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Our Services</h6>
                    <h1 class="display-4">Checkout New Offer Of Our Services</h1>
                </div>
            </div>
        </div>
        <div class="owl-carousel courses-carousel bg-image">
            @foreach ($services as $service)
                <x-service-card :service="$service" />
            @endforeach
        </div>
        <div class="row justify-content-center bg-image mx-0 mb-5">
            <div class="col-lg-6 py-5">
                <div class="form-row justify-content-center">
                    <div class="col-sm-6 ">
                        <button class="btn btn-primary btn-block service_read" style="height: 60px;">
                            Read More
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Courses End -->


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="section-title text-center position-relative mb-5">
                <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Instructors</h6>
                <h1 class="display-4">Meet Our Developers</h1>
            </div>
            <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
                @foreach ($customers as $customer)
                    <x-team-card :customer="$customer" />
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->


    <!-- Contact Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="bg-light d-flex flex-column justify-content-center px-5" style="height: 450px;">
                        <div class="d-flex align-items-center mb-5">
                            <div class="btn-icon bg-primary mr-4">
                                <i class="fa fa-2x fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="mt-n1">
                                <h4>Our Location</h4>
                                <p class="m-0">123 Street, New York, USA</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-5">
                            <div class="btn-icon bg-secondary mr-4">
                                <i class="fa fa-2x fa-phone-alt text-white"></i>
                            </div>
                            <div class="mt-n1">
                                <h4>Call Us</h4>
                                <p class="m-0">+012 345 6789</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="btn-icon bg-warning mr-4">
                                <i class="fa fa-2x fa-envelope text-white"></i>
                            </div>
                            <div class="mt-n1">
                                <h4>Email Us</h4>
                                <p class="m-0">info@example.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title position-relative mb-4 d-flex justify-content-between align-items-center">
                        <!-- Text Section -->
                        <div class="flex-grow-1 me-3">
                            <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Register</h6>
                            <h1 class="display-4">Create Account</h1>
                        </div>

                        <!-- Image Section -->
                        <div>
                            <img id="profileImage" src="{{ asset('frontend/assets/img/default-profile.jpg')}}" alt="Register Image"
                                class="img-fluid rounded" style="width:200px; height:200px; flex-shrink:0; border-radius: 50px;">
                        </div>
                    </div>

                    <div class="contact-form">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-6 form-group mb-3">
                                    <input type="text" name="name"
                                        class="form-control border-top-0 border-right-0 border-left-0 p-0"
                                        placeholder="Your Name" required>
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 form-group mb-3">
                                    <input type="email" name="email"
                                        class="form-control border-top-0 border-right-0 border-left-0 p-0"
                                        placeholder="Your Email" required>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6 form-group mb-3">
                                    <input type="password" name="password"
                                        class="form-control border-top-0 border-right-0 border-left-0 p-0"
                                        placeholder="Password" required>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-6 form-group mb-5">
                                    <input type="password" name="password_confirmation"
                                        class="form-control border-top-0 border-right-0 border-left-0 p-0"
                                        placeholder="Confirm Password" required>
                                </div>
                            </div>

                            <input type="file" id="imageInput" accept="image/*" style="display: none;">

                            <div class="d-flex justify-content-between">
                                <button class="btn btn-primary py-3 px-5" type="submit">Create Account</button>
                                <button type="button" class="btn btn-primary py-3 px-5" id="selectImageBtn">Image</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->

    <script>
const imageInput = document.getElementById('imageInput');
const selectImageBtn = document.getElementById('selectImageBtn');
const profileImage = document.getElementById('profileImage');

// Open file selector when button is clicked
selectImageBtn.addEventListener('click', () => {
    imageInput.click();
});

// Update image preview when a file is selected
imageInput.addEventListener('change', (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = e => {
            profileImage.src = e.target.result; // update image dynamically
        };
        reader.readAsDataURL(file);
    }
});
</script>


@endsection
