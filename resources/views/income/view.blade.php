@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 grid-rows-4 text-center border-b-2 border-[#adb071]">
        <div class="grid grid-cols-3 grid-rows-1">
            <div class="text-left pl-3">
                <a href="{{ url()->previous() }}">
                    <i class="fas fa-chevron-left fa-xl"></i>
                </a>
            </div>
            <div class="text-lg font-bold">
                {{ $year }}
            </div>
        </div>
        <div class="text-4xl font-bold md:text-6xl">{{ $matchMonth }}</div>
        <div class="text-xl text-[#99b26c] font-bold">Income</div>
        <div class="text-2xl font-bold">
            {{ number_format($income,0) }}
        </div>
    </div>
    @php
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    @endphp

    <div class="grid md:grid-cols-1 max-sm:grid-cols-1 gap-1 font-semibold pt-2">
        @for($day = 1; $day <= $daysInMonth; $day++)
            @php
                $date = date("j", mktime(0, 0, 0, $month, $day, $year));
                $dayName = date("l", mktime(0, 0, 0, $month, $day, $year));
                session(['selectedDate' => $date]);
                $total = isset($totals[$date]) ? $totals[$date] : 0;
            @endphp
            <div class="border-b-2 border-[#adb071] cursor-pointer" onclick="fetchDate('{{ $year }}', '{{ $date }}', '{{ $dayName }}', '{{ $month }}')">
                <div class="flex justify-between">
                    <span class="pl-3 ">{{ $date }} - {{ $dayName }}</span>
                    <span class="pr-3">{{ $total !== null ? number_format($total) : 'null' }}</span>
                </div>
            </div>
        @endfor
    </div>
    <script>
        const fetchDate = (year, date, day, month) => {
            const url = '/add?year=' + year + '&month=' + month + '&date=' + date + '&day=' + day;
            window.location.href = url;
        }
    </script>



@endsection
