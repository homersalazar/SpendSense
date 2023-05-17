@extends('layouts.partials')

@section('contents')
    <div class="h-screen flex flex-col justify-center">
        <!-- First Row -->
        <div class="flex items-center justify-center">
            <p class="text-3xl font-semibold text-[#72EB3A]">SpendSense</p>
        </div>

        <div class="flex items-center justify-center">
            <img src="{{ asset('storage/assets/index-logo.png') }}" alt="Logo" class="w-64 h-64">
        </div>

        <!-- Second Row -->
        <div class="flex justify-center mt-8">
        <div class="flex space-x-4">
            <a href="{{ route('user.index') }}" class="px-4 py-2 text-white rounded bg-[var(--sc)] hover:bg-[var(--pc)]">Log in</a>
            <a href="{{ route('user.create') }}" class="px-4 py-2 text-white rounded bg-[var(--sc)] hover:bg-[var(--pc)]">Sign up</a>
        </div>
        </div>
    </div>

@endsection
