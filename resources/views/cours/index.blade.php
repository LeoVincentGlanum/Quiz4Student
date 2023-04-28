<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cours') }}
        </h2>
    </x-slot>

    <div class="container">


        {{--cours--}}

        <h1 class="display-6 mt-1">Les cours</h1>
        <ol class="list-group  mt-1 mb-3">
            @php
                $courses = \App\Models\Cours::all()->take(7);
            @endphp

            @foreach($courses as $course)
                <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">
                            {{$course->label}}
                        </div>
                    </div>
                    <span class="badge bg-primary">Comp</span>
                </li>
            @endforeach
        </ol>


        <div class="d-flex justify-content-between mt-3">
            <div></div>
            <button type="button" class="btn btn-info">Réviser</button>
        </div>

        {{--SCORE--}}
            <div class="row justify-content-center p-1" role="group" aria-label="Basic example">
                <span class="badge bg-danger col-4 qs-no-width ">Initiation <span
                        class="badge qs-bg-grey ">4</span></span>
                <span class="badge bg-primary col-4 qs-no-width ">Compréhension <span class="badge qs-bg-grey ">4</span></span>
                <span class="badge bg-success col-4 qs-no-width ">Maîtrise <span
                        class="badge qs-bg-grey ">4</span></span>
            </div>
            <div class="row justify-content-center p-1" role="group" aria-label="Basic example">
                <span class="badge bg-info col-12 w-100 ">Oubli <span class="badge qs-bg-grey ">4</span></span>

            </div>
    </div>


</x-app-layout>
