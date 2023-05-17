@extends('layouts.partials')

@section('contents')
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-[var(--bg)] px-6 py-8 rounded-lg">
            <h2 class="text-2xl font-semibold text-center text-pc mb-6">Sign Up</h2>

            <!-- Login form code here -->
            <form method="POST" action="{{ route('user.store') }}" class="space-y-4">
                @csrf
                <div>
                    <label for="name" class="text-pc">Name</label>
                    <input type="text" name="name" id="name" class="w-full border border-pc rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-pc" required autofocus>
                    @error('name')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="email" class="text-pc">Email</label>
                    <input type="email" name="email" id="email" class="w-full border border-pc rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-pc" required>
                    @error('email')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="text-pc">Password</label>
                    <input type="password" name="password" id="password" class="w-full border border-pc rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-pc" required>
                    @error('password')
                        <span>{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="text-pc">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border border-pc rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-pc" required>
                </div>

                <div>
                    <button type="submit" class="w-full bg-[var(--sc)] text-bg font-semibold py-2 px-4 rounded-md transition-colors duration-300 hover:bg-[var(--pc)] focus:outline-none focus:ring focus:ring-sc">Sign Up</button>
                </div>
            </form>

            <p class="mt-4 text-center">
                Already Registered? <a href="{{ route('user.index') }}" class="text-blue-600 underline">Sign in</a>
            </p>
            <p class="mt-4 text-center">or</p>

            <div class="flex items-center justify-center mt-4">
                <!-- Google Login Button -->
                <a href="{{ url('/login/google') }}" class="bg-red-600 hover:bg-red-500 text-white p-2 rounded-full transition-colors duration-300">
                    <i class="fa-brands fa-google fa-xl"></i>
                </a>

                <!-- Facebook Login Button -->
                <a href="{{ url('/login/facebook') }}" class="bg-blue-700 hover:bg-blue-600 text-white p-2 rounded-full transition-colors duration-300 ml-2">
                    <i class="fa-brands fa-facebook fa-xl"></i>
                </a>
            </div>
        </div>
    </div>

@endsection
