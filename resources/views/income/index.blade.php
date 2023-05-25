@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-3 justify-center justify-items-center p-4 border-b-2 border-[#adb071]">
        <form id="decrement-form">
            @csrf
            <button type="submit" id="decrement-btn">
                <i class="fa-solid fa-angle-left text-5xl md:text-6xl"></i>
            </button>
        </form>
        {{-- <div class="text-4xl font-semibold md:text-6xl">{{ date('Y', strtotime($currentDate)) }}</div> --}}
        <div class="text-4xl font-semibold md:text-6xl">{{ $years }}</div>
        <form id="increment-form">
            @csrf
            <button type="submit" id="increment-btn">
                <i class="fa-solid fa-angle-right text-5xl md:text-6xl"></i>
            </button>
        </form>
        <div class="pt-4 col-span-3">
            <p class="text-xl text-[#99b26c] font-bold">Income</p>
        </div>
        <div class="col-span-3">
            <p class="text-2xl font-bold p-2">
                {{ number_format($income, 2) }}
            </p>
        </div>
    </div>
    <div class="grid md:grid-cols-4 max-sm:grid-cols-2 gap-4 p-4">
        @for ($i = 1; $i <= $currentMonth; $i++)
            @php $monthName = date('F', mktime(0, 0, 0, $i, 1));
                session(['selectedMonth' => $monthName]);
            @endphp
            <div class="bg-[var(--card)] rounded-lg p-4 month-link" data-month="{{ $i }}">
                <div class="font-bold text-2xl text-center font-bold mb-2">
                    {{ $monthName }}
                </div>
                <div class="text-gray-700 text-center">
                    {{-- {{ $total }} --}}
                </div>
            </div>
        @endfor
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
