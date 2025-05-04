@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
    @include('components.header')

    <section class="products">
        <h1 class="heading">Shopping Cart</h1>

        @if($cartItems->isEmpty())
            <p class="empty">Your cart is empty.</p>
        @else
            <div class="box-container">
                @php $grandTotal = 0; @endphp

                @foreach($cartItems as $item)
                    @php
                        $subTotal = $item->price * $item->qty;
                        $grandTotal += $subTotal;
                    @endphp

                    <div class="box">
                        <img src="{{ asset('images/uploaded/' . $item->image) }}" class="image" alt="">

                        <h3 class="name">{{ $item->name }}</h3>
                        <div class="flex">
                            <div class="price">€{{ $item->price }}</div>

                            <form method="POST" action="{{ route('cart.update') }}">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                <input type="number" name="qty" class="qty" min="1" max="99" value="{{ $item->qty }}">
                                <button type="submit" class="fas fa-edit"></button>
                            </form>
                        </div>

                        <div class="sub-total">sub total: <span>€{{ number_format($subTotal, 2) }}</span></div>

                        <form method="POST" action="{{ route('cart.delete') }}">
                            @csrf
                            <input type="hidden" name="cart_id" value="{{ $item->id }}">
                            <button type="submit" class="btn deleteBtn">Delete Item</button>
                        </form>
                    </div>
                @endforeach
            </div>

            <div class="grand-total">
                <p>Grand Total : <span>€{{ number_format($grandTotal, 2) }}</span></p>

                <a href="{{ route('checkout') }}" class="btn">Proceed To Checkout</a>

                <form method="POST" action="{{ route('cart.empty') }}">
                    @csrf
                    <button type="submit" class="btn deleteBtn">Empty Cart</button>
                </form>
            </div>
        @endif
    </section>
@endsection