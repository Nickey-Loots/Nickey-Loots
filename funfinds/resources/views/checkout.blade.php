@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
    @include('components.header')

    <section class="checkout">
        <h1 class="heading">checkout summary</h1>

        <div class="row">
            <form method="POST" action="{{ route('checkout.process') }}">
                @csrf
                <h3>Billing details</h3>

                <div class="flex">
                    <div class="box">
                        <p>your email <span>*</span></p>
                        <input type="email" name="email" placeholder="enter your email" required class="input">
                    </div>

                    <div class="box">
                        <p>your address <span>*</span></p>
                        <input type="text" name="flat" placeholder="e.g. flat & building number" required class="input">
                    </div>

                    <div class="box">
                        <p>your name <span>*</span></p>
                        <input type="text" name="name" placeholder="enter your name" required class="input">
                    </div>

                    <div class="box">
                        <p>your city <span>*</span></p>
                        <input type="text" name="city" placeholder="enter your city name" required class="input">
                    </div>

                    <div class="box">
                        <p>your number <span>*</span></p>
                        <input type="text" name="number" placeholder="enter your number" required class="input">
                    </div>
                </div>

                <input type="submit" value="place order" class="btn">
                <a href="{{ route('cart.index') }}" class="btn deleteBtn">cancel order</a>
            </form>

            <div class="summary">
                <h3 class="title">cart items</h3>

                @foreach($cartItems as $item)
                    <div class="flex">
                        <img src="{{ asset('images/uploaded/' . $item->image) }}" alt="">
                        <div>
                            <h3 class="name">{{ $item->name }}</h3>
                            <p class="price">€{{ number_format($item->price, 2) }} x {{ $item->qty }}</p>
                        </div>
                    </div>
                @endforeach

                <div class="grand-total">
                    <span>grand total :</span>
                    <span>€{{ number_format($grandTotal, 2) }}</span>
                </div>
            </div>
        </div>
    </section>
@endsection