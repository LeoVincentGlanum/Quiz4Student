@extends('layouts.app')


@section('content')


    <div class="container">
        <h1>Concept : {{$concept->label}}</h1>

        <div class="d-flex flex-wrap justify-content-sm-between">

                <div class="card mt-2">
                    <div class="card-body">
                        <h5 class="card-title">Question </h5>
                        <p class="card-text">{{$question->label}}</p>
                    </div>
                    <ul class="list-group list-group-flush">

                        @php $array = Illuminate\Support\Arr::shuffle($question->reponses) @endphp
                        @php $is_win = 0; @endphp
                        @foreach($array as $key => $reponse)
                            @if(array_key_last($array) === $key)
                                    <li @if($reponse->uuid === $reponseUser && $reponse->is_good == 0) class="list-group-item active" @elseif($reponse->uuid === $reponseUser && $reponse->is_good == 1)  @php $is_win = 1;@endphp class="list-group-item bg-success"  @else class="list-group-item"  @endif  >{{$reponse->name}}</li>
                            @else

                                    <li  @if($reponse->uuid === $reponseUser && $reponse->is_good == 0) class="list-group-item active" @elseif($reponse->uuid === $reponseUser && $reponse->is_good == 1)   @php $is_win = 1;@endphp class="list-group-item bg-success" @else class="list-group-item"  @endif  style="border-bottom: 1px solid #8c8c8c6e;">{{$reponse->name}}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>





        </div>

        <div  class="mt-3">

            @if($is_win === 1)
                GG ! Bonne réponse !
            @else
                Perdu ! Mauvaise réponse
                <br>
                la bonne réponse était :
                <br>
                @foreach($question->reponses as $reponse)
                    @if($reponse->is_good == 1)
                        <ul class="list-group list-group-flush">
                         <li class="list-group-item bg-success">{{$reponse->name}} </li>
                        </ul>

                    @endif
                @endforeach
            @endif
        </div>

        <div class="mt-2">
            Vous avez répondu {{$reponsesUser->count()}} fois à la question
            <br>
            Au seins des 4 dernieres réponses vous avez eu {{$reponsesUser->take(4)->where('is_good',"=",1)->count() }} réponse juste.
        </div>

        <div class="flex justify-content-center mt-2">
         <button class="btn btn-primary">Question suivante</button>
        </div>

    </div>

@endsection