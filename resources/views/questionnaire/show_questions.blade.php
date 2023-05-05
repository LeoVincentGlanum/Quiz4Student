@extends('layouts.app')

@section('content')

    <div class="container mt-4">
        <h1 class="m-2" style="display: flex;align-items: center;justify-content: space-between;">

            <div> Concept :
            @foreach(explode(',',$concept->label) as $item)
                <span style="width: auto;" class="badge bg-secondary">{{$item}}</span>
            @endforeach
            </div>

            <a href="{{route('dashboard')}}" ><i class="fa-solid fa-xmark fa-lg"></i></a>
        </h1>

             @forelse($questions as $question)

                <div class="d-flex flex-wrap justify-content-sm-between">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Question </h5>
                            <p class="card-text">{{$question->label}}</p>
                        </div>
                        <ul class="list-group list-group-flush">

                            @php $array = Illuminate\Support\Arr::shuffle($question->reponses) @endphp

                            @foreach($array as $reponse)
                                @if($loop->last)
                                    <a href="{{route('new.response',['id' => $reponse->uuid, 'question' => $question->id,'concept'=>request()->get('concept')])}}">
                                        <li class="list-group-item" >{{$reponse->name}}</li>
                                    </a>

                                @else
                                    <a href="{{route('new.response',['id' => $reponse->uuid, 'question' => $question->id,'concept'=>request()->get('concept')])}}">
                                        <li class="list-group-item" style="border-bottom: 1px solid #8c8c8c6e;">{{$reponse->name}}</li>
                                    </a>

                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                @empty



                    @php $themeCours = \App\Models\Questionnaire::where('user_id', \Illuminate\Support\Facades\Auth::id())->first();

                        $cpt=0;

                        foreach ($themeCours->questions_id as $key => $value) {

                            $lastResp= \App\Models\ReponseUser::where('question_id', $value['id'])->where('user_id',\Illuminate\Support\Facades\Auth::id())->orderBy('date_repondu','DESC')->first();
                            if($lastResp->is_good){
                                $cpt++;
                            }
                        }
                    @endphp
                    <div class="d-flex justify-content-center mt-4">
                        <div class="card  mb-3 " style="max-width: 20rem;">
                            <div class="card-header">Vous avez fini votre questionnaire !</div>
                            <div class="card-body">

                            <h1>Vous avez {{$cpt}} bonnes réponses sur {{count($themeCours->questions_id)}} questions.</h1>
                            <div class="d-flex justify-content-center">
                            <a href="{{route('dashboard')}}" class="btn btn-success mt-3">Revenir à l'accueil</a>
                            </div>
                        </div>
                    </div>
            @endforelse


    </div>

@endsection
