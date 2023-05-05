<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Cours') }}
        </h2>
    </x-slot>

    <div class="container container d-flex flex-column justify-content-between full-height-screen">

        <div>

            {{--cours--}}
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Recherche 🔍" onkeyup="search(this)"
                       id="inputDefault"
                       style="border-color: #f2f4f9;border-width: 1px;background-color: #fff3!important;border-radius: 10px;color: white;font-size: 18px;">
            </div>
            <h1 class="display-6 mt-1">Les cours</h1>
            <ol class="list-group  mt-1 mb-3 listOfData" style="max-height: 504px;overflow: auto;">
                @php
                    $courses = \App\Models\Cours::all()->take(7);
                     $nbInit =0;
                    $nbComp =0;
                    $nbMaitre =0;
                    $nbOubli =0;
                @endphp

                @foreach($courses as $item)

                    @php
                        //GET TOUT LES CONCEPTS PAR RAPPORT AU THEME DU COURS

                        $themeCours = \App\Models\CoursThemes::where('cours_id', $item->id)->get();
                        $conceptsTheme = \App\Models\ConceptsThemes::whereIn('theme_id', $themeCours->pluck('theme_id'))->get();
                        $concepts = \App\Models\Concept::whereIn('id', $conceptsTheme->pluck('concept_id'))->get();
                        $nbInitCours=0;
                        $nbMaitriseCours=0;
                        $nbCompCours=0;
                        $nbConcept=0;
                        $nbOublie=0;
                        $nbAllQuestion=0;
                    @endphp

                    @foreach($concepts as $concept)

                        @php
                            $flag=false;
                            $questions = \App\Models\Question::where('concept_id', $concept->id)->get();
                            $nbQuestion = \App\Models\Question::where('concept_id', $concept->id)->count();
                            $nbMaitriseQuest = \App\Models\QuestionMaitriseUser::whereIn('question_id', $questions->pluck('id'))->where('user_id',Auth::user()->id)->count();
                            $isgoodForAll=true;
                            $isOneFalse=false;
                        @endphp

                        @foreach($questions as $question)
                            @php
                                $rep=\App\Models\ReponseUser::where('question_id', $question->id)->where('user_id',Auth::user()->id)->where('is_good','1')->orderBy('created_at','desc')->first() @endphp

                            @if($rep)
                                @if((\Carbon\Carbon::createFromDate($rep->date_repondu)->addDays(30) > \Carbon\Carbon::now())==false)
                                    @php $nbOublie++; @endphp
                                @endif
                                @php


                                    $nbCount=\App\Models\ReponseUser::where('question_id', $question->id)->where('user_id',Auth::user()->id)->where('is_good','1')->count();
                                    if($nbCount==0){
                                        $isgoodForAll =false;
                                        $isOneFalse=true;
                                    }

                                @endphp
                            @else
                                @php $isOneFalse=true; @endphp
                            @endif
                            @php $nbAllQuestion++; @endphp

                        @endforeach
                        @php
                            if($nbMaitriseQuest >= $nbQuestion){
                                $nbMaitriseCours++;
                                $flag=true;
                            }
                            if(!$isOneFalse && $isgoodForAll){
                                $nbCompCours++;
                                $flag=true;
                            }
                            if(!$flag){
                                $nbInitCours++;
                            }
                            $nbConcept++;

                        @endphp
                    @endforeach
                    @php
                        $isMaitrise = ($nbMaitriseQuest*100)/$nbConcept;
                        $isInit = ($nbInitCours*100)/$nbConcept;
                        $isComp = ($nbCompCours*100)/$nbConcept;
                        $isOublie = ($nbOublie*100)/$nbAllQuestion;
                        $state="";

                        if($isMaitrise>=70){
                            $state="Maitrise";
                        }
                        if($isComp>=50){
                            $state="Compréhension";
                        }
                        if($isOublie>=50){
                            $state="Oublie";
                        }
                        if($state==""){
                            $state="Initiation";
                        }
                    @endphp


                    <a href="{{route('coursReponse',['cours' => $item->id])}}">
                    <li class="list-group-item d-flex justify-content-between align-items-start qs-bck-ground w-100">
                        <div class="ms-2 me-auto">
                            <div class="fw-bold">{{$item->label}}</div>
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
                    </a>
                @endforeach
            </ol>

        </div>


        <div>
            <div class="d-flex justify-content-between mt-3">
                <div></div>
                <a href="{{route('coursReponse',['cours' => \App\Models\Cours::all()->random()->id])}}">
                <button type="button" class="btn btn-info" style="border-radius: 10px;color: white;">Réviser</button>
                </a>
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
                <span class="badge bg-info col-12 w-100 ">Oubli <span
                        class="badge qs-bg-grey ">{{$nbOubli}}</span></span>

            </div>
        </div>

    </div>


</x-app-layout>

<script>

    function search(e) {
        console.log(e)
        console.log(e.value)
        let allChild = document.querySelectorAll('.listOfData > *')

        allChild.forEach(elem=>{
            if(!elem.querySelector('div div').innerText.toLowerCase().includes(e.value.toLowerCase())){
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
