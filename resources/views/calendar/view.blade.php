@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-3 max-sm:grid-rows-4 justify-center justify-items-center border-b-2 border-[#adb071]">
        <div class="col-span-3">
            <p class="text-lg font-bold p-2">
                {{ $year }}
            </p>
        </div>
        <div class="cursor-pointer minus">
            <i class="fa-solid fa-angle-left text-5xl md:text-6xl"></i>
        </div>
        <div class="text-4xl font-semibold md:text-6xl month">{{ $month }}</div>
        <div class="cursor-pointer plus">
            <i class="fa-solid fa-angle-right text-5xl md:text-6xl"></i>
        </div>
        <div class="pt-2 col-span-3">
            <p class="text-xl text-[##99b26c] font-bold">Income</p>
        </div>
        <div class="col-span-3">
            <p class="text-2xl font-bold">
                {{ number_format(0,2) }}
            </p>
        </div>
    </div>
    <script>
        const minus = document.querySelector(".minus");
        const plus = document.querySelector(".plus");
        const monthElement = document.querySelector(".month");

        let currentMonth = {{ $month }}; // Get the current month value from the server-side variable

        minus.addEventListener("click", () => {
            currentMonth--;
            updateMonth();
        });

        plus.addEventListener("click", () => {
            currentMonth++;
            updateMonth();
        });

        function updateMonth() {
            // Update the displayed month
            monthElement.innerText = currentMonth;

            // Perform additional actions or update the UI as needed
            // You can make an AJAX request or update other elements based on the new month value
        }
    </script>
@endsection
