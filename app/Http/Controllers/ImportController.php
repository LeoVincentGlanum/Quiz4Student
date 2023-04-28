<?php

namespace App\Http\Controllers;

use App\Models\Concept;
use App\Models\ConceptsThemes;
use App\Models\Cours;
use App\Models\CoursThemes;
use App\Models\Question;
use App\Models\Theme;
use Illuminate\Http\Request;


use Illuminate\Support\Arr;
use Spatie\SimpleExcel\SimpleExcelWriter;
use Spatie\SimpleExcel\SimpleExcelReader;

class ImportController extends Controller
{
    public function show(){
        return view("importData");
    }





    public function import(Request $request) {

        // 1. Validation du fichier uploadé. Extension ".xlsx" autorisée
        $this->validate($request, [
            'fichier' => 'bail|required|file|mimes:xlsx'
        ]);

        // 2. On déplace le fichier uploadé vers le dossier "public" pour le lire
        $fichier = $request->fichier->move(public_path(), $request->fichier->hashName());

        // 3. $reader : L'instance Spatie\SimpleExcel\SimpleExcelReader
        $reader = SimpleExcelReader::create($fichier);

        // On récupère le contenu (les lignes) du fichier
        $rows = $reader->getRows();

        $arrayLignes = $rows->toArray();

        foreach ($arrayLignes as $ligne){
            $conceptLabel = Arr::get($ligne,'Concept'); // done
            $questionLabel = Arr::get($ligne,'Question');
            $ReponseGood = Arr::get($ligne,'Reponse1');
            $Reponse2 = Arr::get($ligne,'Reponse2');
            $Reponse3 = Arr::get($ligne,'Reponse3');
            $Reponse4 = Arr::get($ligne,'Reponse4');
            $Reponse5 = Arr::get($ligne,'Reponse5');
            $feedback = Arr::get($ligne,'Feedback');
            $theme1 = Arr::get($ligne,'Theme1');  // done
            $theme2 = Arr::get($ligne,'Theme2'); // done

            $reponsesJson =
                [
                    [
                        "name" => $ReponseGood,
                        "is_good" => 1
                    ],
                    [
                        "name" => $Reponse2,
                        "is_good" => 0
                    ],
                    [
                        "name" => $Reponse3,
                        "is_good" => 0
                    ],
                    [
                        "name" => $Reponse4,
                        "is_good" => 0
                    ],
                    [
                        "name" => $Reponse5,
                        "is_good" => 0
                    ]
                ];





            $searchConcept = Concept::query()->where('label','=',$conceptLabel)->first();
            if ($searchConcept === null){
                $searchConcept = new Concept();
                $searchConcept->label = $conceptLabel;
                $searchConcept->save();
            }

            if ($theme1 !== ""){
                $themeSearch = Theme::query()->where('label','=',$theme1)->first();
                if ($themeSearch === null){
                    $themeSearch = new Theme();
                    $themeSearch->label = $theme1;
                    $themeSearch->save();
                }
                $searchThemeExitsRelation = ConceptsThemes::query()
                    ->where('theme_id','=',$themeSearch->id)
                    ->where('concept_id','=', $searchConcept->id)
                    ->first();

                if ($searchThemeExitsRelation === null){
                    $newLinkTheme = new ConceptsThemes();
                    $newLinkTheme->theme_id = $themeSearch->id;
                    $newLinkTheme->concept_id = $searchConcept->id;
                    $newLinkTheme->save();
                }
            }

            if ($theme2 !== ""){
                $themeSearch = Theme::query()->where('label','=',$theme2)->first();
                if ($themeSearch === null){
                    $themeSearch = new Theme();
                    $themeSearch->label = $theme2;
                    $themeSearch->save();
                }

                $searchThemeExitsRelation = ConceptsThemes::query()
                    ->where('theme_id','=',$themeSearch->id)
                    ->where('concept_id','=', $searchConcept->id)
                    ->first();

                if ($searchThemeExitsRelation === null) {
                    $newLinkTheme = new ConceptsThemes();
                    $newLinkTheme->theme_id = $themeSearch->id;
                    $newLinkTheme->concept_id = $searchConcept->id;
                    $newLinkTheme->save();
                }
            }

            $newQuestion = new Question();
            $newQuestion->label = $questionLabel;
            $newQuestion->concept_id = $searchConcept->id;
            $newQuestion->feedback = $feedback;
            $newQuestion->reponses = $reponsesJson;
            $newQuestion->save();

        }



        dd($arrayLignes);

        // $rows est une Illuminate\Support\LazyCollection

        // 4. On insère toutes les lignes dans la base de données


        // Si toutes les lignes sont insérées
        if ($status) {

            // 5. On supprime le fichier uploadé
            $reader->close(); // On ferme le $reader
            unlink($fichier);

            // 6. Retour vers le formulaire avec un message $msg
            return back()->withMsg("Importation réussie !");

        } else { abort(500); }
    }



    public function importCours(Request $request) {

        // 1. Validation du fichier uploadé. Extension ".xlsx" autorisée
        $this->validate($request, [
            'fichier' => 'bail|required|file|mimes:xlsx'
        ]);

        // 2. On déplace le fichier uploadé vers le dossier "public" pour le lire
        $fichier = $request->fichier->move(public_path(), $request->fichier->hashName());

        // 3. $reader : L'instance Spatie\SimpleExcel\SimpleExcelReader
        $reader = SimpleExcelReader::create($fichier);

        // On récupère le contenu (les lignes) du fichier
        $rows = $reader->getRows();

        $arrayLignes = $rows->toArray();

        foreach ($arrayLignes as $ligne){
            $themeLabel = Arr::get($ligne,'Theme');
            $coursLabel = Arr::get($ligne,'Cours');

            $searchTheme = Theme::query()->where('label','=',$themeLabel)->first();

            if ($searchTheme === null){
                $searchTheme = new Theme();
                $searchTheme->label = $themeLabel;
                $searchTheme->save();
            }

            $searchCours = Cours::query()->where('label','=',$coursLabel)->first();

            if ($searchCours === null){
                $searchCours = new Cours();
                $searchCours->label = $coursLabel;
                $searchCours->save();
            }

            $checkRelationExist = CoursThemes::query()->where('theme_id','=',$searchTheme->id)->where('cours_id','=',$searchCours->id)->first();

            if ($checkRelationExist === null){
                $checkRelationExist = new CoursThemes();
                $checkRelationExist->cours_id = $searchCours->id;
                $checkRelationExist->theme_id = $searchTheme->id;
                $checkRelationExist->save();
            }



        }



        dd($arrayLignes);

        // $rows est une Illuminate\Support\LazyCollection

        // 4. On insère toutes les lignes dans la base de données


        // Si toutes les lignes sont insérées
        if ($status) {

            // 5. On supprime le fichier uploadé
            $reader->close(); // On ferme le $reader
            unlink($fichier);

            // 6. Retour vers le formulaire avec un message $msg
            return back()->withMsg("Importation réussie !");

        } else { abort(500); }
    }


}
