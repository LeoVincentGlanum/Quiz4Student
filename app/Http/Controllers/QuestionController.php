<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Question;
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
        $questions = Question::query()->where('concept_id','=',$concept->id)->limit(1)->get();


        $questions = Question::query()->where('concept_id','=',$concept->id)->get();
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

        // $reponsesLast : question foirée la derniere fois

        $reponsesAllId = ReponseUser::all()->pluck('question_id');

        $questionWithoutResponse = Question::query()->whereIn('id',$reponsesAllId)->where('concept_id','=',$concept->id)->get();
        // question jamais répondu


        dd($questionWithoutResponse);


        $reponsesQuestions = ReponseUser::query()->where('is_good','=',0)->pluck('question_id')->unique();




        dd($reponsesQuestions);

        /* ORDRE */
        /*
         * Mal répondu la dernière fois
         * Jamais posé
         * Question découverte (répondu qu'une fois sur les 5 derniers quizz du concept
         * Question Comprise (répondu 2 fois sur les 5)
         * Maitrise 4 fois sur les 5
         */

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



                return view('responsesView')->with(['question' => $question , 'reponseUser' => $reponse->uuid , 'concept' => $concept, 'reponsesUser' => $reponsesUser]);
            }

        }

    }

    public function responsesView(Request $request){

    }
}
