@extends('layouts.app')

@section('content')


    <div class="container mt-5">
        <h1>Concept : {{$concept->label}}</h1>

        <div class="d-flex flex-wrap justify-content-sm-between">


        @foreach($questions as $question)
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

        @endforeach
        </div>
    </div>

@endsection
