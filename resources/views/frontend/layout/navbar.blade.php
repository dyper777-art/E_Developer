<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0 px-lg-5">
        <a href="index.html" class="navbar-brand ml-lg-3">
            <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Edukate</h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mx-auto py-0">
                <a href="{{ route('home') }}"
                    class="nav-item nav-link @if ($__env->yieldContent('title') === 'home') active @endif">Home</a>
                <a href="{{ route('about') }}"
                    class="nav-item nav-link @if ($__env->yieldContent('title') === 'about') active @endif">About</a>
                <a href="{{ route('service') }}"
                    class="nav-item nav-link @if ($__env->yieldContent('title') === 'service') active @endif"
                    class="nav-item nav-link">Services</a>
                @auth
                    <a href="{{ route('cart.index') }}"
                        class="nav-item nav-link @if ($__env->yieldContent('title') === 'cart') active @endif"
                        class="nav-item nav-link">Cart</a>
                @endauth

            </div>
            <!-- If user is not logged in -->
            @guest
                <a href="{{ route('login') }}" class="btn btn-primary py-2 px-4 d-none d-lg-block">
                    Join Us
                </a>
            @endguest

            <!-- If user is logged in -->
            @auth
                <a href="{{ route('login') }}" class="btn btn-primary py-2 px-4 d-none d-lg-block">
                    {{ Auth::user()->name }}
                </a>
            @endauth
        </div>
    </nav>
</div>
<!-- Navbar End -->
