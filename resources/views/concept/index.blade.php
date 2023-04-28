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
            @php
                $concepts = \App\Models\Concept::all()->take(7);
            @endphp

            @foreach($concepts as $concept)
                <a href="{{route('show.concept.questions',['id' => $concept->id])}}">
                    <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                        <input class="form-check-input" type="checkbox" value="" id="checkbox{{$concept->id}}">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">
                                <label class="form-check-label text-light" for="checkbox{{$concept->id}}">
                                    {{$concept->label}}
                                </label>
                            </div>
                        </div>
                        <span class="badge bg-primary">Comp</span>
                    </li>
                </a>
            @endforeach
        </ol>


        <div class="d-flex justify-content-between mt-3">
            <button type="button" class="btn btn-primary">Tout réviser</button>
            <button type="button" class="btn btn-info">Réviser</button>
        </div>
    </div>


</x-app-layout>
