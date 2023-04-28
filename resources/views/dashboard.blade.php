<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center p-1" role="group" aria-label="Basic example">
            <a href="{{route('concept.index')}}" class="btn btn-outline-primary col-4 qs-little-m-1 ">Concept</a>
            <div class="btn btn-outline-primary col-3 active qs-little-m-1"><i
                    class="fa-solid fa-house text-light"></i></div>
            <a href="{{route('concept.index')}}" type="button"
               class="btn btn-outline-info col-4 qs-little-m-1">Cours</a>
        </div>

        {{--Concept--}}
        <h1 class="display-6 mt-1">Listes de vos concept</h1>
        <ol class="list-group list-group-numbered mt-1 mb-3">
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Concept 1</div>
                </div>
                <span class="badge bg-primary">Comp</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Concept 2</div>
                </div>
                <span class="badge bg-danger">Init</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Concept 3</div>
                </div>
                <span class="badge bg-success">Mtrs</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Concept 4</div>
                </div>
                <span class="badge bg-info">Oubl</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Concept 4</div>
                </div>
                <span class="badge bg-info">Oubl</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Concept 4</div>
                </div>
                <span class="badge bg-info">Oubl</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Concept 4</div>
                </div>
                <span class="badge bg-info">Oubl</span>
            </li>
        </ol>

        <hr>

        {{--Cours--}}
        <h1 class="display-6 mt-1">Listes de vos cours</h1>
        <ol class="list-group list-group-numbered mt-1 mb-1">
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 1</div>
                </div>
                <span class="badge bg-primary">Comp</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 2</div>
                </div>
                <span class="badge bg-danger">Init</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 3</div>
                </div>
                <span class="badge bg-success">Mtrs</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 4</div>
                </div>
                <span class="badge bg-info">Oubl</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 4</div>
                </div>
                <span class="badge bg-info">Oubl</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 4</div>
                </div>
                <span class="badge bg-info">Oubl</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <div class="ms-2 me-auto">
                    <div class="fw-bold">Cours 4</div>
                </div>
                <span class="badge bg-info">Oubl</span>
            </li>
        </ol>

        {{--BTN--}}

        <div class="d-flex justify-content-between mt-3 mb-2">
            <div></div>
            {{--            <button type="button" class="btn qs-btn-reviser">Tout réviser</button>--}}
            <button type="button" class="btn btn-info">Réviser</button>
        </div>

        {{--SCORE--}}
        <div class="row justify-content-center p-1" role="group" aria-label="Basic example">
            <span class="badge bg-danger col-4 qs-no-width ">Initiation <span class="badge qs-bg-grey ">4</span></span>
            <span class="badge bg-primary col-4 qs-no-width ">Compréhension <span class="badge qs-bg-grey ">4</span></span>
            <span class="badge bg-success col-4 qs-no-width ">Maîtrise <span class="badge qs-bg-grey ">4</span></span>
        </div>
        <div class="row justify-content-center p-1" role="group" aria-label="Basic example">
            <span class="badge bg-info col-12 w-100 ">Oubli <span class="badge qs-bg-grey ">4</span></span>

        </div>
    </div>


</x-app-layout>
