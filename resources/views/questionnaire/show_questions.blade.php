@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <h1 class="m-2" style="display: flex;align-items: center;justify-content: space-between;">
            <span>Concept : {{$concept->label}}</span>
            <a href="{{route('dashboard')}}" ><i class="fa-solid fa-xmark fa-lg"></i></a>
        </h1>

        <div class="d-flex flex-wrap justify-content-sm-between">


             @forelse($questions as $question)
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Question </h5>
                        <p class="card-text">{{$question->label}}</p>
                    </div>
                    <ul class="list-group list-group-flush">

                        @php $array = Illuminate\Support\Arr::shuffle($question->reponses) @endphp

                        @foreach($array as $reponse)
                            @if($loop->last)
                                <a href="{{route('new.response',['id' => $reponse->uuid, 'question' => $question->id])}}">
                                    <li class="list-group-item" >{{$reponse->name}}</li>
                                </a>

                            @else
                                <a href="{{route('new.response',['id' => $reponse->uuid, 'question' => $question->id])}}">
                                    <li class="list-group-item" style="border-bottom: 1px solid #8c8c8c6e;">{{$reponse->name}}</li>
                                </a>

                            @endif
                        @endforeach
                    </ul>
                </div>
                @empty
                    Vous avez fini votre questionnaire !

            @endforelse

        </div>
    </div>

@endsection
