@extends('layouts.app')

@section('title', 'Order Details')

@section('content')
    @include('components.header')

    <section class="view-order">
        <h1 class="heading">Order Details</h1>

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        @php $grandTotal = 0; @endphp

        @foreach($orders as $order)
            @php
                $subTotal = $order->price * $order->qty;
                $grandTotal += $subTotal;
                $statusColor = match ($order->status) {
                    'delivered' => 'green',
                    'cancelled' => 'red',
                    default => 'orange',
                };
            @endphp

            <div class="row">
                <div class="col">
                    <p class="title"><i class="fas fa-calendar"></i> {{ $order->created_at->format('Y-m-d') }}</p>
                    <img src="{{ asset('images/uploaded/' . $product->image) }}" class="image" alt="">
                    <h3 class="name">{{ $product->name }}</h3>
                    <p class="price">€{{ number_format($order->price, 2) }} x {{ $order->qty }}</p>
                    <p class="grand-total">grand total : <span>€{{ number_format($grandTotal, 2) }}</span></p>
                </div>
                <div class="col">
                    <p class="title">Billing Address</p>
                    <p class="user"><i class="fas fa-user"></i> {{ $order->name }}</p>
                    <p class="user"><i class="fas fa-envelope"></i> {{ $order->email }}</p>
                    <p class="user"><i class="fas fa-phone"></i> {{ $order->number }}</p>
                    <p class="user"><i class="fas fa-map-marker-alt"></i> {{ $order->address }}</p>
                    <p class="title">Status</p>
                    <p class="status" style="color:{{ $statusColor }}">{{ ucfirst($order->status) }}</p>

                    @if($order->status !== 'cancelled')
                        <form action="{{ route('admin.orders.cancel', $order->id) }}" method="POST"
                            onsubmit="return confirm('Cancel this order?');">
                            @csrf
                            <input type="submit" value="Cancel Order" class="deleteBtn cancelForm">
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </section>
@endsection