@extends('layouts.app')

@section('title', 'Manage Products')

@section('content')
    @include('components.header')

    <section class="products">

        @if(session('success'))
            <div class="alert success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3 class="heading">Manage Products</h3>

        <table class="product_table">
            <tr class="table_row">
                <th class="table_head">name</th>
                <th class="table_head">price</th>
                <th class="table_head">action</th>
            </tr>

            @foreach($products as $product)
                <tr class="table_row">
                    <td class="table_cell">{{ $product->name }}</td>
                    <td class="table_cell">€{{ number_format($product->price, 2) }}</td>
                    <td class="table_cell">
                        <div class="action-buttons">
                            <a href="{{ route('admin.products.edit', $product->id) }}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" class="delete-form"
                                onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

        <div class="link">
            <a href="{{ route('admin.products.create') }}">Add Product</a>
        </div>
    </section>
@endsection