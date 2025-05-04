@extends('layouts.app')

@section('title', 'Add Product')

@section('content')
    @include('components.header')

    <section class="add-product">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h3>Product Details</h3>

            <p>Product Name <span>*</span></p>
            <input type="text" name="name" required maxlength="50" placeholder="Enter product name" class="box">

            <p>Product Price <span>*</span></p>
            <input type="number" name="price" required min="0" max="9999999999" placeholder="Enter product price"
                class="box">

            <p>Product Image <span>*</span></p>
            <input type="file" name="image" required accept="image/*" class="box">

            <input type="submit" value="Add Product" class="btn">
        </form>
    </section>
@endsection