@extends('layouts.app')

@section('content')
    <div class="grid grid-rows-5 grid-cols-1 text-center border-b-2 border-[#adb071] pb-2">
        <div class="font-bold text-lg">
            <span class="font-bold">{{ $displayDate }}</span>
        </div>
        <div class="text-4xl font-bold">{{ $day }}</div>
        <div class="text-xl text-[#99b26c] font-bold pt-2">Expense</div>
        <div class="text-2xl text-red-600 pt-2 font-bold">
            {{ number_format($total, 2) }}
        </div>
    </div>
    <div class="grid grid-rows-1 grid-cols-2 p-2 font-bold">
        <div>{{ $item }} item(s)</div>
        <div class="text-right">DELETE</div>
    </div>
    <div class="grid grid-rows-1 grid-cols-1 p-2 font-bold mb-11">
        <table>
            @foreach($table as $tables)
                <tr class="border-b-2 border-[#adb071]">
                    <td>{{ ucwords($tables->details) }}</td>
                    <td class="text-right text-red-600">{{  number_format($tables->amount,2) }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="bg-[#99b865] fixed bottom-0 w-full max-w-screen-full mx-auto h-20 font-bold p-1 mt-11 md:flex justify-center items-center">
        <label class="md:hidden">New:</label>
        <form id="expenseForm">
            @csrf
            <div class="flex flex-row gap-2">
                <div class="flex-auto">
                    <input type="text" name="details" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--sc)]" placeholder="Details" required>
                </div>
                <div class="flex-auto">
                    <input type="number" name="amount" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--sc)]" placeholder="Amount" required>
                </div>
                <div class="flex-auto">
                    <input type="hidden" name="input_date" value="{{ $dateInput }}">
                    <button type="submit" id="save" class="bg-[var(--pc)] hover:bg-[var(--pc)] text-white font-bold py-2 px-4 rounded focus:outline-none focus:ring-2 focus:ring-[var(--pc)]">Save</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        $(document).ready(function () {
            $("#expenseForm").submit(function (event) {
                event.preventDefault(); // Prevent the default form submission

                $.ajax({
                    url: "{{ route('expense.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        // Handle the success response here
                        window.location.reload();
                    },
                    error: function (error) {
                        console.log(error);
                        // Handle the error response here
                    }
                });
            });
        });
    </script>
@endsection