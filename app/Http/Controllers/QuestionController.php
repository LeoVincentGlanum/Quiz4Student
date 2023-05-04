<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Parametre;
use App\Models\Question;
use App\Models\QuestionMaitriseUser;
use App\Models\Questionnaire;
use App\Models\ReponseUser;
use App\Models\Theme;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function show($id){

        $concept = Concept::find($id);

        $collectionGlobal = collect();

        $questionMaitrise = QuestionMaitriseUser::all()->pluck('question_id');



        $questions = Question::query()->whereNotIn('id',$questionMaitrise)->where('concept_id','=',$concept->id)->get();
        $reponsesLast = collect();
        foreach ($questions as $question){
            $lastResponse = ReponseUser::query()
                ->where('user_id','=',Auth::user()->id)
                ->where('question_id','=',$question->id)
                ->orderBy('created_at','desc')
                ->first();

            if ($lastResponse !== null){

                $reponsesLast->add($lastResponse);
            }

        }


        $reponsesAllId = ReponseUser::query()->where('user_id','=',Auth::user()->id)->get()->pluck('question_id');

        $questionWithoutResponse = Question::query()->whereNotIn('id',$reponsesAllId)->where('concept_id','=',$concept->id)->get();
        // question jamais répondu

        foreach ($questionWithoutResponse as $item){
            $collectionGlobal->add($item);
        }


       // dd($questionWithoutResponse);


        $reponses =  $reponsesLast->where('is_good','=',0);

        $questionFoirees =  Question::query()->whereIn('id',$reponses->pluck('question_id'))->get();

        foreach ($questionFoirees as $item){
            $collectionGlobal->add($item);
        }



        $collectionFinal = $collectionGlobal;

        if (count($collectionGlobal) !== 0){

            $questions = $collectionFinal;
        } else {
            $questions =   $questions->shuffle();
            $questions = $questions;
        }

        // $reponsesLast : question foirée la derniere fois
       // dd($questionFoirees->get());

        /* ORDRE */

        /*
         * Mal répondu la dernière fois
         * Jamais posé
         * Question découverte (répondu qu'une fois sur les 5 derniers quizz du concept
         * Question Comprise (répondu 2 fois sur les 5)
         * Maitrise 4 fois sur les 5
         */

        $questionsBase = Question::query()->whereNotIn('id',$questions->pluck('id'))->where('concept_id','=',$concept->id)->get();

        $param = Parametre::query()->where('key','=','nbQuestions')->first();
        $param = intval($param->value);

        $arrayId = [];
        if (count($questions) < $param){
            //dd($questionsBase);
            $cpt = 0;
            foreach ($questions as $question){
                $arrayId[] =  [
                    "id" => $question->id,
                    "status" => "todo"
                ];
                $cpt++;
            }
            foreach ($questionsBase as $question){
                if ($cpt === $param){
                    break;
                }
                $arrayId[] = [
                    "id" => $question->id,
                    "status" => "todo"
                            ];
                $cpt++;
            }

        }


        $searchQuestionnaire = Questionnaire::query()
            ->where('user_id','=',Auth::user()->id)
            ->first();


        $idConcept = null;
        if ($searchQuestionnaire !== null) {
            $idConcept = (Arr::get($searchQuestionnaire->concepts_id,0));
        }

        if ($idConcept !== null){
            $searchQuestionnaire->questions_id = $arrayId;
            $searchQuestionnaire->user_id = Auth::user()->id;
            $searchQuestionnaire->save();
        } else {
            $newQuestionnaire = new Questionnaire();
            $newQuestionnaire->concepts_id = [ $concept->id ];
            $newQuestionnaire->questions_id = $arrayId;
            $newQuestionnaire->user_id = Auth::user()->id;
            $newQuestionnaire->save();
        }




      return redirect()->route('questionnaire');




      //  $questions = Question::query()->where('concept_id','=',$concept->id)->limit(1)->get();
        return view('concept.show_questions')->with(['concept' => $concept, 'questions' => $questions]);
    }

    public function reponse($id,$question){
        $question = Question::find($question);

        if ($question === null){
            return "error";
        }

        $reponses = $question->reponses;

        foreach ($reponses as $reponse){

            if ($reponse->uuid === $id){

                if ($reponse->is_good){

                    $newResponse =  new ReponseUser();
                    $newResponse->question_id = $question->id;
                    $newResponse->is_good = true;
                    $newResponse->user_id = Auth::user()->id;
                    $newResponse->date_repondu = Carbon::now()->toDateTime();
                    $newResponse->save();

                } else {

                    $newResponse =  new ReponseUser();
                    $newResponse->question_id = $question->id;
                    $newResponse->is_good = false;
                    $newResponse->user_id = Auth::user()->id;
                    $newResponse->date_repondu = Carbon::now()->toDateTime();
                    $newResponse->save();

                }

                $concept = Concept::find($question->concept_id);

                $reponsesUser = ReponseUser::query()->where('user_id','=',Auth::user()->id)->where('question_id','=',$question->id)->orderBy('id','desc')->get();

                $maitrise = $reponsesUser->take(4)->where('is_good',"=",1)->count();

                if ($maitrise == 4){
                    $newQuestionMatriseUser = new QuestionMaitriseUser();
                    $newQuestionMatriseUser->user_id = Auth::user()->id;
                    $newQuestionMatriseUser->question_id = $question->id;
                    $newQuestionMatriseUser->save();
                }



                $questionnaire = Questionnaire::query()->where('user_id','=',Auth::id())->first();
                $ArrayQuestions = $questionnaire->questions_id;

                $idQuestion = [];
                foreach ($ArrayQuestions as $questionUnique){
                    $idQuestion = Arr::get($questionUnique,'id');


                    if ($idQuestion === $question->id){
                        $arrayId[] = [
                            "id" => $idQuestion,
                            "status" => "done"
                        ];
                    } else {
                        $arrayId[] = [
                            "id" => $idQuestion,
                            "status" =>  Arr::get($questionUnique,'status')
                        ];
                    }
                }

                $questionnaire->questions_id = $arrayId;
                $questionnaire->save();

                return view('responsesView')->with(['question' => $question , 'reponseUser' => $reponse->uuid , 'concept' => $concept, 'reponsesUser' => $reponsesUser]);
            }

        }

    }

    public function responsesView(Request $request){

    }


    public function questionnaire(){

        $questionaire = Questionnaire::query()
            ->where('user_id','=',Auth::id())
            ->first();

        $concept_ids = $questionaire->concepts_id;
        foreach ($concept_ids as $concept_id){
            $concept = Concept::find($concept_id);

        }

        $questions_id = $questionaire->questions_id;
        foreach ($questions_id as $key => $item){
            if (Arr::get($item,'status') !== "todo"){
                unset($questions_id[$key]);
            }
        }

        $questions = Arr::first($questions_id);

        $conceptA =  Arr::first($questions_id);
        $idQuestion = (Arr::get($conceptA,'id'));

        $question = Question::find($idQuestion);
        $questions = Question::query()->where('id','=',$idQuestion)->get();



        return view('questionnaire.show_questions')->with(['concept' => $concept, 'questions' => $questions]);





    }

}
