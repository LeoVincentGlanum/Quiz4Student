@extends('layouts.app')

@section('content')


    <div class="container mt-5">
        <h1>Concept : {{$concept->label}}</h1>

        <div class="d-flex flex-wrap justify-content-sm-between">


        @foreach($questions as $question)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Question </h5>
                    <p class="card-text">{{$question->label}}</p>
                </div>
                <ul class="list-group list-group-flush">

                    @php $array = Illuminate\Support\Arr::shuffle($question->reponses) @endphp

                    @foreach($array as $reponse)
                        <li class="list-group-item">{{$reponse->name}}</li>
                    @endforeach
                </ul>
            </div>

        @endforeach
        </div>
    </div>

@endsection
