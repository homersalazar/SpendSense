@extends('layouts.partials')

@section('contents')
    <div class="flex flex-col justify-center items-center h-screen">
        <div>
            <h1 class="text-4xl font-bold text-[var(--sc)]">SpendSense</h1>
        </div>
        <div class="piggy-wrapper">
            <div class="piggy-wrap">
                <div class="piggy">
                    <div class="nose"></div>
                    <div class="mouth"></div>
                    <div class="ear"></div>
                    <div class="tail">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <div class="eye"></div>
                    <div class="hole"></div>
                </div>
            </div>
            <div class="coin-wrap">
                <div class="coin">$</div>
            </div>
            <div class="legs"></div>
            <div class="legs back"></div>
        </div>
        <div class="flex space-x-4 pt-4">
            <a href="{{ route('user.index') }}" class="px-4 py-2 text-white rounded bg-[var(--sc)] hover:bg-[var(--pc)]">Log in</a>
            <a href="{{ route('user.create') }}" class="px-4 py-2 text-white rounded bg-[var(--sc)] hover:bg-[var(--pc)]">Sign up</a>
        </div>
    </div>

@endsection
