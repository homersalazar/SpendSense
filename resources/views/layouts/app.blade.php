<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href={{ asset("css/styles.css") }}>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    {{-- FONT AWESOME --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- JQUERY --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>SpendSense</title>
</head>
<body>
    <div id="myNav" class="fixed w-full h-screen hidden">
        <a href="javascript:void(0)" class="absolute top-4 right-6 text-4xl text-white cursor-pointer" onclick="closeNav()">&times;</a>
        <div class="flex flex-col items-center justify-center h-full">
          <a href="#" class="text-3xl text-white py-4 font-semibold">Calendar</a>
          <a href="#" class="text-3xl text-white py-4 font-semibold">Income</a>
          <a href="#" class="text-3xl text-white py-4 font-semibold">Expense</a>
          <a href="#" class="text-3xl text-white py-4 font-semibold">Report</a>
          <a href="#" class="text-3xl text-white py-4 font-semibold">Misc</a>
        </div>
    </div>

    <div class="grid grid-cols-2 p-4 border-t-8 border-[#99b865]">
        <div class="col-start-1 text-2xl">
            <span className="font-bold text-white">SpendSense</span>
        </div>
        <div class="col-end-7">
            <span class="text-3xl cursor-pointer md:hidden" onclick="openNav()">&#9776;</span>
        </div>
    </div>
    <div class="container-fluid">
        @yield('content')
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        @if(session()->has('success'))
            $.notify("{{ session('success') }}", {
                position: "top center",
                className: "success",
            });
        @endif
    </script>

    <script src="{{ asset('js/custom.js') }}"></script>
    <script>
        const openNav = () => {
          document.getElementById("myNav").classList.remove('hidden');
        }

        const closeNav = () => {
          document.getElementById("myNav").classList.add('hidden');
        }
      </script>
</body>
</html>
