@extends('layouts.app')

@section('title', 'Login')

@section('content')
    @include('components.header')

    <section class="login">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <h3>Log in</h3>

            {{-- Validatie-fouten --}}
            @if($errors->any())
                <div class="empty">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <p>Email</p>
            <input type="email" name="email" class="box" value="{{ old('email') }}" required>

            <p>Password</p>
            <input type="password" name="password" class="box" required>

            <button type="submit" class="btn">Login</button>

            <p>Nog geen account? <a href="{{ route('register') }}">Registreren</a></p>
        </form>
    </section>
@endsection