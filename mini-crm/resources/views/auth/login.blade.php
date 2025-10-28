@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white rounded-lg shadow p-6">
    <h2 class="text-2xl font-bold mb-4 text-primary">Login</h2>

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-red-700">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" class="w-full border rounded px-3 py-2" required autofocus>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium mb-1">Password</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2" required>
        </div>

        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" name="remember" class="mr-2">
                <span class="text-sm">Remember me</span>
            </label>
        </div>

        <button type="submit" class="w-full bg-primary text-white px-4 py-2 rounded hover:shadow-lg transition">
            Login
        </button>
    </form>

    <div class="mt-4 text-center text-sm space-y-2">
        <div>
            <a href="{{ route('password.request') }}" class="text-primary hover:underline">Forgot your password?</a>
        </div>
        <div>
            Don't have an account? <a href="{{ route('register') }}" class="text-primary hover:underline">Register</a>
        </div>
    </div>
</div>
@endsection
