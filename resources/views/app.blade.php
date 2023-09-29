<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Calories</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{ asset('css/custome.css') }}">

    @livewireStyles
</head>

<body>
    <div x-data="compo" :class="">
        {{-- navbar --}}
        <div>
            <livewire:navbar class="dark:bg-gray-800 py-4" />
        </div>
        {{-- Core App  --}}
        <div class="dark:bg-gray-800">
            {{ $slot }}
        </div>
    </div>




    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.8.1/flowbite.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('compo', () => ({
                loadingPage: false,
            }))
        });
        window.addEventListener('testwal', function(e) {
            let data = e.detail[0];
            Swal.fire(data.title, 'Click to hide window', data.icon)
        });
        //  Button Enable dark Mode 
        window.addEventListener('dark-mode', function(e) {
            let body = document.body;
            body.className.includes('dark') ? body.classList.remove('dark') : body.classList.add('dark');
        });
    </script>
    @livewireScripts
</body>

</html>
