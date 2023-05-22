@extends('layouts.app')

@section('content')
    <div class="grid grid-rows-4 grid-cols-1 text-center border-b-2 border-[#adb071] pb-2">
        <div class="font-bold text-lg">
            <span class="font-bold">{{ $month }}</span> {{ $date }}, {{ $year }}
        </div>
        <div class="text-4xl font-bold">{{ $day }}</div>
        <div class="text-xl text-[#99b26c] font-bold pt-2">Income</div>
        <div class="text-2xl pt-2 font-bold">
            {{ number_format(0, 2) }}
        </div>
    </div>
    <div class="grid grid-rows-1 grid-cols-2 p-2 font-bold">
        <div>2 item(s)</div>
        <div class="text-right">DELETE</div>
    </div>
    <div class="grid grid-rows-1 grid-cols-2 p-2 font-bold">
        <div>Income A</div>
        <div class="text-right">Amount</div>
    </div>
    <div class="bg-[#99b865] fixed bottom-0 w-full max-w-screen-xl mx-auto h-14 font-bold p-1">
        <form action="">
            <label for="">New:</label>
            <div class="grid grid-rows-2 grid-cols-1 max-sm:grid-cols-3">
                <div>
                    <input type="text" name="" id="" class="max-sm:w-36">
                </div>
                <div>
                    <input type="text" name="" id="" class="max-sm:w-36">
                </div>
                <div class="col-span-2 flex justify-end">
                    <button type="submit" class="bg-[#adb071] text-white px-4 py-2 rounded-md">Submit</button>
                </div>
            </div>
        </form>
    </div>

@endsection
