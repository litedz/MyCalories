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

<body x-data="compo" :class="darkMode && 'dark'" id="$id('text-input')">
    {{-- Button Enable dark Mode --}}
    <div class="mode flex flex-row gap-5 text-white bg-indigo-400 rounded-2xl p-4 w-auto fixed top-2 right-0">
        <button type="button">
            <span class="fa fa-moon bg-slate-400 fa  p-2 rounded-full" @click="toggleMode"></span>
        </button>
    </div>
    {{-- navbar --}}
    <div>
    <livewire:navbar />

</div>
    <div class="dark:bg-gray-800 py-4" >
        
        {{ $slot }}
    </div>
    
    @livewireScripts

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('compo', () => ({
                darkMode: false,
                loadingPage:false;
                toggleMode() {
                    this.darkMode = !this.darkMode;
                },
            }))
        });
        window.addEventListener('testwal', function(e) {
            let data = e.detail[0];
            Swal.fire(data.title, 'Click to hide window', data.icon)
        });
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>






</body>

</html>
