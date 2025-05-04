@extends('layouts.app')

@section('title', 'My Orders')

@section('content')
    @include('components.header')

    <section class="products">
        <h1 class="heading">Your Orders</h1>

        @if($orders->isEmpty())
            <p class="empty">You haven't placed any orders yet.</p>
        @else
            <div class="box-container">
                @foreach($orders as $order)
                    <div class="box">
                        <img src="{{ asset('images/uploaded/' . $order->image) }}" class="image" alt="">
                        <h3 class="name">{{ $order->name }}</h3>
                        <p>Quantity: {{ $order->qty }}</p>
                        <p>Total: €{{ number_format($order->price * $order->qty, 2) }}</p>
                        <p>Address: {{ $order->address }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
@endsection