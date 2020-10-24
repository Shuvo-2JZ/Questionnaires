<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;

class QuestionnaireController extends Controller
{
    // every model associates a table 
    // every instance of a model associates a row

    // Naming a model : 'Questionnaire'
    // Naming a table : 'questionnaire'


    // preventing someone who's not logged in, from accessing this controller
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('questionnaire.create');
    }

    public function store()
    {
        $data = request()->validate(
            [
                // 'title' and 'purpose' is the 'name' of the input field of the form 
                'title' => 'required',
                'purpose' => 'required'
            ]
        );

        // $questionnaire = Questionnaire::create();

        //$questionnaire = auth()->user()->questionnaires()->create($data);
        // the same thing.
        $questionnaire = request()->user()->questionnaires()->create($data);
        // the create() method can be applied on a model.
        // or a method that returns a model.
        // the questionnaires() method returns model.
        /** the create method, which accepts an array of attributes, creates a model, and inserts it into the database. */


        /** when user creates a new questionnaire, the page redirects to a page which shows the 
         * questionnaire. to show the questionnaire, we need the questionnaire id.
         * so we send the questionnaire id.
         */
        return redirect('/questionnaires/'.$questionnaire->id);
    }

    /**
     * public function show($questionnaire)
    {
        $id = Questionnaire::findOrFail($questionnaire)
        //$id = Questionnaire::find($questionnaire)

        return view('questionnaire.show', compact('id'));
    }
     */

     

    // Route model binding
    // the variable name has to be the same as '/questionnaires/{questionnaire}'
    public function show(Questionnaire $questionnaire)
    {
        // we are loading the one-to-many relationship between questions() in Qeustionnaire model and answers() in Question model
        // the questions() method in Questionnaire model
        // which returns Question model
        // so we can get Question model's method /relationship.
        // now we are grabbing answers() method through questions() method
        // later on we grabbed the responses method through answers
        $questionnaire->load('questions.answers.responses'); 
        // this is called lazy loading
        // we need to load this because this show method has to show questions with all answers
        // dd($questionnaire);
        // $questionnaire = the 'id' sent from store() method
        return view('questionnaire.show', compact('questionnaire'));
    }
}
