<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Concept') }}
        </h2>
    </x-slot>

    <div class="container ">
        <form method="post" action="{{route("multiConcept")}}"
              class="d-flex flex-column justify-content-between full-height-screen">
            @csrf
            <div>

                {{--Concept--}}
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Recherche 🔍" onkeyup="search(this)"
                           id="inputDefault"
                           style="border-color: #f2f4f9;border-width: 1px;background-color: #fff3!important;border-radius: 10px;color: white;font-size: 18px;">
                </div>
                <h1 class="display-6 mt-1">Les concept</h1>

                <ol class="list-group  mt-1 listOfData" style="max-height: 504px;overflow: auto;">
                    @php
                        $concepts = \App\Models\Concept::all();
                        $nbInit =0;
                        $nbComp =0;
                        $nbMaitre =0;
                        $nbOubli =0;
                    @endphp

                    @foreach($concepts as $concept)
                        @php
                            $questions = \App\Models\Question::where('concept_id', $concept->id)->get();
                            $nbQuestion = \App\Models\Question::where('concept_id', $concept->id)->count();
                            $nbMaitriseQuest = \App\Models\QuestionMaitriseUser::whereIn('question_id', $questions->pluck('id'))->where('user_id',Auth::user()->id)->count();
                            $isgoodForAll=true;
                            $isOneFalse=false;
                            $nbOublie=0;
                        @endphp



                        @foreach($questions as $question)
                            @foreach(\App\Models\ReponseUser::where('question_id', $question->id)->where('user_id',Auth::user()->id)->where('is_good','1')->get() as $rep)
                                @if((\Carbon\Carbon::createFromDate($rep->date_repondu)->addDays(30) > \Carbon\Carbon::now())==false)
                                    @php $nbOublie++; @endphp
                                @endif
                            @endforeach
                            @php


                                $nbCount=\App\Models\ReponseUser::where('question_id', $question->id)->where('user_id',Auth::user()->id)->where('is_good','1')->count();
                                if($nbCount==0){
                                    $isgoodForAll =false;
                                    $isOneFalse=true;
                                }

                            @endphp
                        @endforeach
                        @php
                            $state="";

                            if(!$isOneFalse && $isgoodForAll){
                                $state="Compréhension";
                            }
                            if($nbMaitriseQuest >= $nbQuestion){
                                $state="Maitrise";
                            }
                            if(($nbOublie*100)/$nbQuestion){
                                $state="Oublie";
                            }
                            if($state==""){
                                $state="Initiation";

                            }
                        @endphp
                        <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground">
                            <input class="form-check-input" name="idConcepts[]" type="checkbox" value="{{$concept->id}}"
                                   id="checkbox{{$concept->id}}">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">
                                    <label class="form-check-label text-light" for="checkbox{{$concept->id}}">
                                        {{$concept->label}}
                                    </label>
                                </div>
                            </div>
                            @php
                                if($state=="Initiation"){
                                    $nbInit++;
                            @endphp
                            <span class="badge bg-danger">Init</span>
                            @php
                                }
                                elseif ($state=="Compréhension"){
                                    $nbComp++;
                            @endphp
                            <span class="badge bg-primary">Comp</span>
                            @php
                                }
                                elseif ($state=="Oublie"){
                                    $nbOubli++;
                            @endphp
                            <span class="badge bg-info">Oubl</span>
                            @php
                                }
                                else{
                                    $nbMaitre++;
                            @endphp
                            <span class="badge bg-success">Mtrs</span>
                            @php
                                }
                            @endphp
                        </li>
                    @endforeach
                </ol>


            </div>

            <div>
                <div class="d-flex justify-content-between ">

                    <button name="coucou" value="coucou" type="submit" class="btn btn-primary">Tout réviser</button>
                    <button type="submit" class="btn btn-info">Réviser</button>
                </div>
                {{--SCORE--}}

                <div class="row justify-content-center p-1" role="group" aria-label="Basic example">
                <span class="badge bg-danger col-4 qs-no-width ">Initiation <span
                        class="badge qs-bg-grey ">{{$nbInit}}</span></span>
                    <span class="badge bg-primary col-4 qs-no-width ">Compréhension <span
                            class="badge qs-bg-grey ">{{$nbComp}}</span></span>
                    <span class="badge bg-success col-4 qs-no-width ">Maîtrise <span
                            class="badge qs-bg-grey ">{{$nbMaitre}}</span></span>
                </div>
                <div class="row justify-content-center p-1" role="group" aria-label="Basic example">
                    <span class="badge bg-info col-12 w-100 ">Oubli <span class="badge qs-bg-grey ">{{$nbOubli}}</span></span>

                </div>
            </div>
        </form>


    </div>


</x-app-layout>


<script>

    function search(e) {
        console.log(e)
        console.log(e.value)
        let allChild = document.querySelectorAll('.listOfData > *')

        allChild.forEach(elem=>{
            if(!elem.querySelector('label').innerText.toLowerCase().includes(e.value.toLowerCase())){
                elem.classList.add('d-none')
                elem.classList.remove('d-flex')
            }
            else{
                elem.classList.remove('d-none')
                elem.classList.add('d-flex')
            }
        })
    }
</script>
