<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Question;
use App\Models\QuestionMaitriseUser;
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



        $collectionFinal = $collectionGlobal->take(1);

        if (count($collectionGlobal) !== 0){

            $questions = $collectionFinal;
        } else {
            $questions =   $questions->shuffle();
            $questions = $questions->take(1);
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

                return view('responsesView')->with(['question' => $question , 'reponseUser' => $reponse->uuid , 'concept' => $concept, 'reponsesUser' => $reponsesUser]);
            }

        }

    }

    public function responsesView(Request $request){

    }
}
