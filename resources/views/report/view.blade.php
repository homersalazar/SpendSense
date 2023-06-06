@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-1 grid-rows-2 text-center">
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
                <div>{{ number_format($output,2) }}</div>
            @else
                <div class="text-red-600">{{ number_format($output,2) }}</div>
            @endif
        </div>
    </div>
    <table class="min-w-full border-b-2 border-[#adb071] mt-5">
        <thead>
            <tr>
                <th class="px-4 py-2"></th>
                <th class="px-4 py-2">Income</th>
                <th class="px-4 py-2">Expense</th>
                <th class="px-4 py-2">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dailyTotals as $day => $dailyTotal)
                @php
                    $date = date("j", mktime(0, 0, 0, $month, $day, $year));
                    $totals = $dailyTotal['incomeDaily'] - $dailyTotal['expenseDaily'];
                @endphp
                <tr>
                    <td class="border-t border-gray-300 text-center">{{ $date }}</td>
                    <td class="border-t border-gray-300 text-center">
                        @if ($dailyTotal['incomeDaily'] !== null && $dailyTotal['incomeDaily'] != 0)
                            {{ number_format($dailyTotal['incomeDaily'], 2) }}
                        @endif
                    </td>
                    <td class="border-t border-gray-300 text-center text-red-600">
                        @if ($dailyTotal['expenseDaily'] !== null && $dailyTotal['expenseDaily'] != 0)
                            {{ number_format($dailyTotal['expenseDaily'], 2) }}
                        @endif
                    </td>
                    <td class="border-t border-gray-300 text-center">
                        @if ($totals !== null && $totals != 0)
                            @if ($dailyTotal['incomeDaily'] >= $dailyTotal['expenseDaily'])
                                <div>{{ number_format($totals, 2) }}</div>
                            @else
                                <div class="text-red-600">{{ number_format($totals, 2) }}</div>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
