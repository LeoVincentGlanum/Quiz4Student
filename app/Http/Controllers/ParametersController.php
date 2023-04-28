<?php

namespace App\Http\Controllers;

use App\Models\Parametre;
use Illuminate\Http\Request;

class ParametersController extends Controller
{
    public function showParameters(){
        $checkParameter = Parametre::query()->where('key','=','nbQuestions')->first();

        if ($checkParameter === null){
            $checkParameter = "";
        } else {
            $checkParameter = $checkParameter->value;
        }

        return view('parameters')->with(['checkParameter' => $checkParameter]);
    }

    public function changeNbQuestions(Request $request){
        $nbQuestions = $request->input('nbQuestions');

        if ($nbQuestions === null){
            return redirect()->back()->with(['error' => "Error"]);
        }

        $checkParameter = Parametre::query()->where('key','=','nbQuestions')->first();

        if ($checkParameter === null){
            $checkParameter = new Parametre();
            $checkParameter->key = 'nbQuestions';
            $checkParameter->value = $nbQuestions;
            $checkParameter->save();
        }else {
            $checkParameter->value = $nbQuestions;
            $checkParameter->save();
        }

        return redirect()->back();
    }
}
