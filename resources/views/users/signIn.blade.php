@extends('layouts.partials')

@section('contents')
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-[var(--bg)] px-6 py-8 rounded-lg">
            <h2 class="text-2xl font-semibold text-center text-pc mb-6">Sign In</h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="email" class="text-pc">Email</label>
                    <input type="email" name="email" id="email" class="w-full border border-pc rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--sc)]" required>
                    @error('email')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="text-pc">Password</label>
                    <input type="password" name="password" id="password"class="w-full border border-pc rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-[var(--sc)]" required>
                    @error('password')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="w-full bg-[var(--sc)] text-white font-semibold py-2 px-4 rounded-md transition-colors duration-300 hover:bg-[var(--pc)] focus:outline-none focus:ring-2 focus:ring-[var(--sc)]">Login</button>
                </div>
            </form>
            <p class="mt-4 text-center">
                Don't have an account? <a href="{{ route('user.create') }}" class="text-blue-600 underline">Sign up</a>
            </p>
            {{-- <p class="mt-4 text-center">
                or
            </p>
            <div class="flex items-center justify-center mt-4">
                <a href="{{ url('/login/google') }}" class="bg-red-600 hover:bg-red-500 text-white p-2 rounded-full transition-colors duration-300">
                    <i class="fa-brands fa-google fa-xl"></i>
                </a>

                <a href="{{ url('/login/facebook') }}" class="bg-blue-700 hover:bg-blue-600 text-white p-2 rounded-full transition-colors duration-300 ml-2">
                    <i class="fa-brands fa-facebook fa-xl"></i>
                </a>
            </div> --}}
        </div>
    </div>
@endsection
