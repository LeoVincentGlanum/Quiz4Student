<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Concept') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center p-1" role="group" aria-label="Basic example">
            <div  class="btn btn-outline-primary col-4 qs-little-m-1 active">Concept</div>
            <a  href="{{route('dashboard')}}" class="btn btn-outline-primary col-3  qs-little-m-1"><i
                    class="fa-solid fa-house text-light"></i></a>
            <a href="{{route('concept.index')}}" type="button" class="btn btn-outline-info col-4 qs-little-m-1">Cours</a>
        </div>

        {{--Concept--}}

        <h1 class="display-6 mt-1">Les concept</h1>
        <ol class="list-group  mt-1 mb-3">
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 1</div>
                </div>
                <span class="badge bg-primary">Comp</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 2</div>
                </div>
                <span class="badge bg-danger">Init</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 3</div>
                </div>
                <span class="badge bg-success">Mtrs</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 4</div>
                </div>
                <span class="badge bg-info">Oubl</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 4</div>
                </div>
                <span class="badge bg-info">Oubl</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 4</div>
                </div>
                <span class="badge bg-info">Oubl</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 4</div>
                </div>
                <span class="badge bg-info">Oubl</span>
            </li>

        </ol>


        <div class="d-flex justify-content-between mt-3">
            <button type="button" class="btn btn-primary">Tout réviser</button>
            <button type="button" class="btn btn-info">Réviser</button>
        </div>
    </div>


</x-app-layout>
