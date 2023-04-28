<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\Question;
use App\Models\Theme;
use Illuminate\Http\Request;

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

        $question = $questions[0];

        return view('concept.show_questions')->with(['concept' => $concept, 'question' => $question]);
    }
}
