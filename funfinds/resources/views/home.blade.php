@extends('layouts.app')

@section('title', 'Homepagina')

@section('content')

    @include('components.header')

    <section class="products">

        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert error">
                {{ session('error') }}
            </div>
        @endif


        <h1 class="heading">all products</h1>
        <div class="box-container">
            @foreach($products as $product)
                <form method="POST" action="{{ route('cart.add') }}" class="box">
                    @csrf
                    <img src="{{ asset('images/uploaded/' . $product->image) }}" class="image" alt="">
                    <h3 class="name">{{ $product->name }}</h3>
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="flex">
                        <div class="price">€{{ $product->price }}</div>
                        <input type="number" name="qty" class="qty" min="1" max="99" value="1">
                    </div>
                    <button type="submit" class="btn">add to cart</button>
                </form>
            @endforeach
        </div>
    </section>
@endsection