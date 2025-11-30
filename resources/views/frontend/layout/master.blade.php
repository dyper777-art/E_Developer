<!DOCTYPE html>
<html lang="en">

<head>

    @include('frontend.layout.style')

</head>

<body>


    @include('frontend.layout.navbar')

    @include('frontend.layout.header')

    
    @yield('content')


    @include('frontend.layout.footer')


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    @include('frontend.layout.jsshop')

</body>

</html>
