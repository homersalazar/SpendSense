@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center loading-page">
        <div class="piggy-wrapper">
            <div class="piggy-wrap ">
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
    </div>
@endsection
