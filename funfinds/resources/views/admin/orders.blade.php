@extends('layouts.app')

@section('title', 'Manage Orders')

@section('content')
    @include('components.header')

    <section class="orders">
        <h3 class="heading">Manage Orders</h3>

        @if(session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif

        <table class="order_table">
            <tr class="table_row">
                <th class="table_head">Customer name</th>
                <th class="table_head">Price</th>
                <th class="table_head">Quantity</th>
                <th class="table_head">Status</th>
                <th class="table_head"></th>
            </tr>

            @forelse($orders as $order)
                <tr class="table_row">
                    <td class="table_cell">{{ $order->name }}</td>
                    <td class="table_cell">€{{ number_format($order->price, 2) }}</td>
                    <td class="table_cell">{{ $order->qty }}</td>
                    <td class="table_cell">{{ ucfirst($order->status) }}</td>
                    <td class="table_cell">
                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn">More Details</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No orders found.</td>
                </tr>
            @endforelse
        </table>
    </section>
@endsection