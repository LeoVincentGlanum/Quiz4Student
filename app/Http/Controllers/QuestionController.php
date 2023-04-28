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
        $questions = Question::query()->where('concept_id','=',$concept->id)->get();

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
                    $newResponse->reponse = true;
                    $newResponse->user_id = Auth::user()->id;
                    $newResponse->dateRepondu = Carbon::now()->toDateTime();
                    $newResponse->save();

                    return view('responsesView')->with(['question_id' => $question->id , $newResponse]);

                } else {

                    $newResponse =  new ReponseUser();
                    $newResponse->question_id = $question->id;
                    $newResponse->reponse = false;
                    $newResponse->user_id = Auth::user()->id;
                    $newResponse->dateRepondu = Carbon::now()->toDateTime();
                    $newResponse->save();

                    return view('responsesView')->with(['question_id' => $question->id , $newResponse]);
                }
            }

        }

    }
}
