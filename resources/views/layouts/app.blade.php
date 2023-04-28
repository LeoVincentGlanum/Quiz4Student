<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="/bootstrap.min.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
{{--            @include('layouts.navigation')--}}
{{--            @include('layouts.navigation')--}}

            <!-- Page Heading -->
            <div class="row justify-content-center p-1" role="group" aria-label="Basic example" style="max-width: 100vw;">
                <a href="{{route('concept.index')}}" class="btn btn-outline-primary col-4 qs-little-m-1 ">Concept</a>
                <a href="{{route('dashboard')}}" class="btn btn-outline-primary col-3 active qs-little-m-1"><i
                        class="fa-solid fa-house text-light"></i></a>
                <a href="{{route('concept.index')}}" type="button" class="btn btn-outline-info col-4 qs-little-m-1">Cours</a>
            </div>
            @if (isset($header))


            @endif





            <!-- Page Content -->
            <main>
                @if(isset($slot))
                {{ $slot }}
                @else
                    @yield('content')
                @endif

            </main>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    </body>
</html>
