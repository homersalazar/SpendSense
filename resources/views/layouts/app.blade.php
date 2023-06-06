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
    <div id="myNav" class="fixed w-full h-screen hidden z-10">
        <a href="javascript:void(0)" class="absolute top-4 right-6 text-4xl text-white cursor-pointer" onclick="closeNav()">&times;</a>
        <div class="flex flex-col items-center justify-center h-full">
          <a href="/income" class="text-3xl text-white py-4 font-semibold">Income</a>
          <a href="/expense" class="text-3xl text-white py-4 font-semibold">Expense</a>
          <a href="/report" class="text-3xl text-white py-4 font-semibold">Report</a>
          <a href="/logout" class="text-3xl text-white py-4 font-semibold">Logout</a>
        </div>
    </div>
    <div class="grid grid-cols-1 p-4 sticky top-0">
        <div class="col-start-1 text-3xl max-sm:text-2xl">
            <span class="font-bold">SpendSense</span>
        </div>
        <div class="col-span-4 text-center text-2xl max-sm:hidden">
            <a href="/income" class="text-xl px-5 font-bold">Income</a>
            <a href="/expense" class="text-xl px-5 font-bold">Expense</a>
            <a href="/report" class="text-xl px-5 font-bold">Report</a>
            <a href="/logout" class="text-xl px-5 font-bold">Logout</a>
        </div>
        <div class="col-end-7">
            <span class="text-3xl cursor-pointer md:hidden" onclick="openNav()"><i class="fas fa-hamburger"></i></span>
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
