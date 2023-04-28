<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Concept') }}
        </h2>
    </x-slot>

    <div class="container">


        {{--Concept--}}

        <h1 class="display-6 mt-1">Les concept</h1>
        <ol class="list-group  mt-1 mb-3">
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">

                <div class="ms-2 me-auto">
                    <div class="fw-bold">
                        <label class="form-check-label text-light" for="flexCheckDefault">
                            Cours 1
                        </label>
                    </div>
                </div>
                <span class="badge bg-primary">Comp</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault2">

                <div class="ms-2 me-auto">
                    <div class="fw-bold"><label class="form-check-label text-light" for="flexCheckDefault2">
                            Cours 2
                        </label></div>
                </div>
                <span class="badge bg-danger">Init</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault3">

                <div class="ms-2 me-auto">
                    <div class="fw-bold"><label class="form-check-label text-light" for="flexCheckDefault3">
                            Cours 3
                        </label></div>
                </div>
                <span class="badge bg-success">Mtrs</span>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault4">

                <div class="ms-2 me-auto">
                    <div class="fw-bold"><label class="form-check-label text-light" for="flexCheckDefault4">
                            Cours 4
                        </label></div>
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
