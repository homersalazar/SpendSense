@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 grid-rows-4 text-center border-b-2 border-[#adb071]">
        <div class="grid grid-cols-3 grid-rows-1">
            <div class="text-left pl-3">
                <a href="{{ url()->previous() }}">
                    <i class="fas fa-chevron-left fa-xl"></i>
                </a>
            </div>
            <div class="text-3xl max-sm:text-xl font-semibold mt-3">
                {{ $year }}
            </div>
        </div>
        <div class="text-4xl font-bold md:text-6xl">{{ $matchMonth }}</div>
        <div class="text-xl text-[#99b26c] font-bold mt-4">Income</div>
        <div class="text-2xl font-bold">
            @if ($income !== null && $income != 0)
                {{ number_format($income,2) }}
            @endif
        </div>
    </div>
    <form id="dateForm" action="/add" method="POST">
        @csrf
        <input type="hidden" name="year" id="yearInput">
        <input type="hidden" name="date" id="dateInput">
        <input type="hidden" name="day" id="dayInput">
        <input type="hidden" name="month" id="monthInput">
    </form>
    <div class="grid font-semibold pt-2 md:pr-[5rem] md:pl-[5rem]">
        @for($day = 1; $day <= $daysInMonth; $day++)
            @php
                $date = date("j", mktime(0, 0, 0, $month, $day, $year));
                $dayName = date("l", mktime(0, 0, 0, $month, $day, $year));
                session(['selectedDate' => $date]);
                $total = isset($totals[$date]) ? $totals[$date] : null;
            @endphp
            <div class="border-b-2 border-[#adb071] cursor-pointer" onclick="submitForm('{{ $year }}', '{{ $date }}', '{{ $dayName }}', '{{ $month }}')">
                <div class="flex justify-between pb-2">
                    <span class="pl-3">{{ $date }} - {{ $dayName }}</span>
                    @if ($total !== null && $total != 0)
                        <span class="pr-3">{{ number_format($total,2) }}</span>
                    @endif
                </div>
            </div>
        @endfor
    </div>
    <script>
        const submitForm = (year, date, day, month) => {
            const yearInput = document.getElementById('yearInput');
            const dateInput = document.getElementById('dateInput');
            const dayInput = document.getElementById('dayInput');
            const monthInput = document.getElementById('monthInput');
            yearInput.value = year;
            dateInput.value = date;
            dayInput.value = day;
            monthInput.value = month;

            const form = document.getElementById('dateForm');
            form.submit();
        }
    </script>

@endsection
