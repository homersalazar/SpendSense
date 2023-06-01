@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-3 justify-center justify-items-center pt-2 pb-2">
        <form id="decrement-form">
            @csrf
            <button type="submit" id="decrement-btn">
                <i class="fa-solid fa-angle-left text-5xl md:text-6xl"></i>
            </button>
        </form>
        <div class="text-4xl font-semibold md:text-6xl">{{ $years }}</div>
        <form id="increment-form">
            @csrf
            <button type="submit" id="increment-btn">
                <i class="fa-solid fa-angle-right text-5xl md:text-6xl"></i>
            </button>
        </form>
    </div>


    <script>
        $(document).ready(function () {
            $("#decrement-form").submit(function (event) {
                $.ajax({
                    url:"{{ route('income.decrement') }}",
                    type: "POST",
                    data:$('#decrement-form').serialize(),
                    dataType: 'json',
                    success:function(data){
                        console.log(data);
                    }
                });
            });

            $("#increment-form").submit(function (event) {
                $.ajax({
                    url:"{{ route('income.increment') }}",
                    type: "POST",
                    data:$('#increment-form').serialize(),
                    dataType: 'json',
                    success:function(data){
                        console.log(data);
                    }
                });
            });
        });
    </script>
@endsection
