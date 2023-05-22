@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 grid-rows-4 text-center border-b-2 border-[#adb071]">
        <div class="text-lg font-bold">
            {{ $year }}
        </div>
        <div class="text-4xl font-bold md:text-6xl">{{ $matchedMonth }}</div>
        <div class="text-xl text-[#99b26c] font-bold">Income</div>
        <div class="text-2xl font-bold">
            {{ number_format(0, 2) }}
        </div>
    </div>
    @php
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
    @endphp

    <div class="grid md:grid-cols-1 max-sm:grid-cols-1 gap-4 p-4 font-semibold">
        <table id="income-table">
            @for($day = 1; $day <= $daysInMonth; $day++)
                @php
                    $date = date("j", mktime(0, 0, 0, $month, $day, $year));
                    $dayName = date("l", mktime(0, 0, 0, $month, $day, $year));
                @endphp
                <tr>
                    <td class="border-b-2 p-1 cursor-pointer" onclick="fetchDate('{{ $year }}', '{{ $date }}', '{{ $dayName }}', '{{ $matchedMonth }}')">
                        {{ $date }} - {{ $dayName }}
                    </td>
                </tr>
            @endfor
        </table>
    </div>

    <script>
        const fetchDate = (year, date, day, month) =>{
            const url = '/income?year=' + year + '&date=' + date + '&day=' + day + '&month=' + month;
            window.location.href = url;
        }
    </script>



@endsection
