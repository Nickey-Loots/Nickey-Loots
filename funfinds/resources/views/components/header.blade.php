<header class="header">
    <section class="flex">
        <a href="{{ route('home') }}">
            <img class="logo" src="{{ asset('images/text.png') }}" alt="funfinds">
        </a>

        <nav class="navbar">
            @auth
                @if(auth()->user()->is_admin)
                    {{-- Admin header --}}
                    <a href="{{ route('admin.products') }}">Manage Products</a>
                    <a href="{{ route('admin.orders') }}">Manage Orders</a>
                @else
                    {{-- Logged-in user --}}
                    <a href="{{ route('home') }}">View Products</a>
                    <a href="{{ route('orders.index') }}">My Orders</a>
                    <a href="{{ route('cart.index') }}"><i class="fas fa-shopping-cart"></i></a>
                @endif

                <form method="POST" action="{{ route('logout') }}" class="logout-form">
                    @csrf
                    <button type="submit"><i class="fas fa-sign-out-alt"></i></button>
                </form>

                <p>Welcome, {{ auth()->user()->name }}</p>
            @else
                {{-- Guest --}}
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </nav>
    </section>
</header>