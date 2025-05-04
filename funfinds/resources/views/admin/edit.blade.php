@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')
    @include('components.header')

    <section class="edit-product">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h3>Edit the product</h3>

            <p>product name <span>*</span></p>
            <input type="text" name="name" required maxlength="50" placeholder="enter product name"
                value="{{ old('name', $product->name) }}" class="box">

            <p>product price <span>*</span></p>
            <input type="number" name="price" required min="0" max="9999999999" placeholder="enter product price"
                value="{{ old('price', $product->price) }}" class="box">

            <p>product image <span>*</span></p>
            <input type="file" name="image" accept="image/*" class="box">

            <input type="submit" value="Edit Product" class="btn">
        </form>
    </section>
@endsection