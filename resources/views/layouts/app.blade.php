<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" href="/img/licorne.png" />
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link href="/bootstrap.min.css" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
</head>
<body class="font-sans antialiased">
<div class="min-h-screen">
    {{--            @include('layouts.navigation')--}}
    {{--            @include('layouts.navigation')--}}

    <!-- Page Heading -->


    {{-- <div class="row justify-content-center p-1" role="group" aria-label="Basic example" style="max-width: 100vw; margin: auto">
        <a href="{{route('concept.index')}}" class="btn btn-outline-primary col-4 qs-little-m-1 {{ in_array(request()->route()->getName(),["concept.index","show.concept.questions"]) ? 'active' : '' }}">Concept</a>
        <a href="{{route('dashboard')}}" class="btn btn-outline-primary col-3 qs-little-m-1 {{ request()->route()->getName()=="dashboard" ? 'active' : '' }}"><i
                class="fa-solid fa-house text-light"></i></a>
        <a href="{{route('cours.index')}}" type="button" class="btn btn-outline-info col-4 qs-little-m-1 {{ request()->route()->getName()=="cours.index" ? 'active' : '' }}">Cours</a>
    </div> --}}


    <ul class="nav nav-tabs d-flex justify-content-center p-1" role="tablist">
        <li class="nav-item">
            <a class="nav-link {{ in_array(request()->route()->getName(),["concept.index","show.concept.questions"])|| strpos(url()->full(), '?concept=1') !== false ? 'active' : '' }}"
               href="{{route('concept.index')}}">Concept</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->route()->getName()=="dashboard" ? 'active' : '' }}"
               href="{{route('dashboard')}}"><i class="fa-solid fa-house "></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->route()->getName()=="cours.index" || strpos(url()->full(), '?concept=0') !== false ? 'active' : '' }}"
               href="{{route('cours.index')}}">Cours</a>
        </li>

    </ul>
    <div>
        <form method="POST" action="{{ route('logout') }}" style="height: 0px">
            @csrf
            <button type="submit">
                <svg style="    position: absolute;
                            top: 1.5vh;
                            left: 88vw;
                            height: auto;
                            /* font-size: 56px; */
                            width: 27px;" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                     class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                          d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z"/>
                    <path fill-rule="evenodd"
                          d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                </svg>
            </button>
        </form>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
</body>
</html>
