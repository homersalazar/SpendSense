@extends('layouts.app')

@section('content')
    <div class="grid grid-rows-5 grid-cols-1 text-center border-b-2 border-[#adb071] pb-2">
        <div>
            <span class="font-semibold text-xl max-sm:text-lg">{{ $displayDate }}</span>
        </div>
        <div class="text-4xl font-bold">{{ $day }}</div>
        <div class="text-xl text-[#99b26c] font-bold pt-2">Income</div>
        <div class="text-2xl pt-2 font-bold">
            {{ number_format($total, 2) }}
        </div>
    </div>
    <div class="grid p-2 font-bold">
        <div>{{ $item }} item(s)</div>
    </div>
    <div class="grid p-2 font-bold mb-11">
        <table>
            @foreach($table as $tables)
                <tr class="border-b-2 border-[#adb071]">
                    <td>{{ ucwords($tables->details) }}</td>
                    <td class="text-right pr-4">{{ number_format($tables->amount, 2) }}</td>
                    <td class="text-right">
                        <form id="deleteForm" data-id="{{ $tables->id }}">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <div class="bg-[#99b865] fixed bottom-0 w-full max-w-screen-full mx-auto h-20 font-bold p-1 mt-11 md:flex justify-center items-center">
        <label class="md:hidden">New:</label>
        <form id="incomeForm">
            @csrf
            <div class="flex flex-row gap-2">
                <div class="flex-auto">
                    <input type="text" name="details" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--sc)]" placeholder="Details" required>
                </div>
                <div class="flex-auto">
                    <input type="text" pattern="[0-9]+([.,][0-9]+)?" name="amount" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-[var(--sc)]" placeholder="Amount">
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
            $("#incomeForm").submit(function (event) {
                event.preventDefault();

                $.ajax({
                    url: "{{ route('income.store') }}",
                    type: "POST",
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function (data) {
                        console.log(data);
                        window.location.reload();
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });

            $("#deleteForm").submit(function (event) {
                event.preventDefault();
                var form = $(this);
                var id = form.data("id");

                $.ajax({
                    url: `/income/${id}`,
                    type: "POST",
                    data: { _method: "DELETE", _token: "{{ csrf_token() }}" },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        window.location.reload();
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
