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

        return view('concept.show_questions')->with(['concept' => $concept, 'questions' => $questions]);
    }
}
