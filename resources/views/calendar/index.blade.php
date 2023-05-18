@extends('layouts.app')

@section('content')
    <div class="grid grid-cols-3 justify-center justify-items-center p-4 border-b-2 border-[#adb071]">
        <div class="cursor-pointer minus">
            <i class="fa-solid fa-angle-left text-5xl md:text-6xl"></i>
        </div>
        <div class="text-4xl font-semibold md:text-6xl num_year"></div>
        <input type="hidden" class="yearInput" name="yearInput">

        <div class="cursor-pointer plus">
            <i class="fa-solid fa-angle-right text-5xl md:text-6xl"></i>
        </div>
        <div class="pt-4 col-span-3">
            <p class="text-xl text-[##99b26c] font-bold">Income</p>
        </div>
        <div class="col-span-3">
            <p class="text-2xl font-bold p-2">
                {{ number_format(0,2) }}
            </p>
        </div>
    </div>
    @php
        $currentMonth = date('n');
        $monthNames = array(
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        );
    @endphp
    <div class="grid md:grid-cols-4 max-sm:grid-cols-2 gap-4 p-4">
        @for ($i = 1; $i <= $currentMonth; $i++)
            <a href="/view?year=inputYear&month={{ $i }}" class="month-link">
                <div class="bg-[var(--card)] rounded-lg p-4">
                    <div class="font-bold text-2xl text-center font-bold mb-2">
                        {{ $monthNames[$i] }}
                    </div>
                    <div class="text-gray-700 text-center">
                        <!-- Additional content within the text-gray-700 div -->
                    </div>
                </div>
            </a>
        @endfor
    </div>

    <script>
        const minus = document.querySelector(".minus");
        const plus = document.querySelector(".plus");
        const num = document.querySelector(".num_year");
        const yearInput = document.querySelector(".yearInput");

        let currentYear = new Date().getFullYear();
        num.innerText = currentYear;
        yearInput.value = currentYear;

        plus.addEventListener("click", () => {
            currentYear++;
            num.innerText = currentYear;
            yearInput.value = currentYear;
        });

        minus.addEventListener("click", () => {
            currentYear--;
            num.innerText = currentYear;
            yearInput.value = currentYear;
        });

        yearInput.addEventListener("input", () => {
            currentYear = parseInt(yearInput.value);
            num.innerText = currentYear;
        });

        const monthLinks = document.querySelectorAll('.month-link');

        monthLinks.forEach((link) => {
            link.addEventListener('click', (e) => {
                e.preventDefault();
                const urls = link.href.replace('inputYear', currentYear);
                window.location.href = urls;
                const url = link.getAttribute('href');

                fetch(url)
                    .then(response => {
                        // Handle the response as needed
                    })
                    .catch(error => {
                        // Handle errors
                    });
            });
        });
    </script>


@endsection
