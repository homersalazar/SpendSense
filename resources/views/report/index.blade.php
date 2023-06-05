@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-3 justify-items-center pt-2 pb-2 ">
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
    <div class="flex flex-col pr-[30rem] pl-[30rem] max-sm:pr-[3rem] max-sm:pl-[3rem] font-bold border-b-2 border-[#adb071] mt-5 md:text-xl">
        <div class="flex justify-between pb-1">
          <div class="font-bold">Income</div>
          <div>{{ number_format($income,2) }}</div>
        </div>
        <div class="flex justify-between pb-2 border-b-2 border-[#adb071]">
          <div class="font-bold">Expense</div>
          <div class="text-red-600">{{ number_format($expense,2) }}</div>
        </div>
        <div class="flex justify-between pb-2">
            <div class="font-bold">Total</div>
            @if($income >= $expense)
                <div>{{ number_format($total,2) }}</div>
            @else
                <div class="text-red-600">{{ number_format($total,2) }}</div>
            @endif
        </div>
    </div>
    @foreach ($monthlyTotals as $month => $data)
        @php
            $monthName = date('M', mktime(0, 0, 0, $month, 1));
            $data['difference'] = $data['incomeMonthly'] - $data['expenseMonthly'];
        @endphp
        <form action="/basic" method="POST">
            @csrf
            <input type="hidden" name="month" value="{{ $month }}">
            <input type="hidden" name="year" value="{{ $years }}">
            <div class="flex bg-[var(--card)] rounded-lg m-3 p-2 cursor-pointer" onclick="this.parentNode.submit();">
                <div class="w-1/4 pr-4 bg-[#f0ef99] rounded-lg">
                    <p class="text-center mt-5 pl-3 font-bold text-2xl">{{ $monthName }}</p>
                </div>
                <div class="w-3/4">
                    <div class="flex flex-col font-bold md:text-xl pl-2">
                        <div class="flex justify-between">
                        <div class="font-bold">Income</div>
                        <div>
                            {{ number_format($data['incomeMonthly'],2) }}
                        </div>
                    </div>
                    <div class="flex justify-between border-b-2 border-[#adb071]">
                        <div class="font-bold">Expense</div>
                        <div class="text-red-600">
                            {{ number_format($data['expenseMonthly'],2) }}
                        </div>
                    </div>
                    <div class="flex justify-between ">
                        <div class="font-bold">Total</div>
                            {{ number_format($data['difference'],2) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
