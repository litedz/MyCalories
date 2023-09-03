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
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{asset('css/custome.css')}}">

</head>

<body>

    @livewire('navbar')

    {{ $slot }}

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @livewireScripts


    <script>
        window.addEventListener('testwal',function(e) {
            let data = e.detail[0];
            Swal.fire(data.title,'Click to hide window',data.icon)
        });
    </script>
</body>

</html>