<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\QuestionRequest;
use App\Models\Concept;
use App\Models\Question;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Arr;
use Psy\Util\Str;

/**
 * Class QuestionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class QuestionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Question::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/question');
        CRUD::setEntityNameStrings('question', 'questions');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('concept');
        CRUD::column('label');
        CRUD::column('feedback');
        CRUD::column('created_at');
        CRUD::column('updated_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(QuestionRequest::class);
        CRUD::field('concept_id')->type('select')->entity('concept')->attribute('label')->model(Concept::class);
        CRUD::field('label');
        CRUD::field('feedback');
        CRUD::field('reponses')->type('repeatable')->subfields([
            [
                'name'    => 'name',
                'type'    => 'text',
                'label'   => 'Name',
            ],
            [
                'name'    => 'is_good',
                'type'    => 'checkbox',
                'label'   => 'Reponse correct',
            ],
        ]);


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store(\Illuminate\Http\Request $request)
    {
        //dd($request);
        $concept_id = $request->input('concept_id');
        $label = $request->input('label');
        $feedback = $request->input('feedback');
        $reponses = $request->input('reponses');

        $newQuestion = new Question();
        $newQuestion->concept_id = $concept_id;
        $newQuestion->label = $label;
        $newQuestion->feedback = $feedback;
        $arrayResponse = [];
        foreach ($reponses as $reponse){
            $arrayResponse[] =
                [
                    "name" => Arr::get($reponse,'name'),
                    "is_good" => Arr::get($reponse,'is_good'),
                    "uuid" => \Illuminate\Support\Str::uuid()
                ];
        }

        $newQuestion->reponses = $arrayResponse;
        $newQuestion->save();

        return redirect()->to( backpack_url('question'));

    }


}
