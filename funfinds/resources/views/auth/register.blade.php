@extends('layouts.app')

@section('title', 'Register')

@section('content')
    @include('components.header')

    <section class="login">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <h3>Register</h3>
            @if($errors->any())
                <div class="empty">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <p>Name</p>
            <input type="text" name="name" class="box" value="{{ old('name') }}" required>

            <p>Email</p>
            <input type="email" name="email" class="box" value="{{ old('email') }}" required>

            <p>Password</p>
            <input type="password" name="password" class="box" required>

            <p>Confirm Password</p>
            <input type="password" name="password_confirmation" class="box" required>

            <button type="submit" class="btn">Register</button>

            <p>Heb je al een account? <a href="{{ route('login') }}">Inloggen</a></p>
        </form>
    </section>
@endsection