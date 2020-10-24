<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    // Using route model binding
    // '/surveys/{questionnaire}-{slug}'
    public function show(\App\Models\Questionnaire $questionnaire, $slug)
    {
        // we are loading the one-to-many relationship between questions() in Qeustionnaire model and answers() in Question model
        // the questions() method in Questionnaire model
        // which returns Question model
        // so we can get Question model's method /relationship.
        // now we are grabbing answers() method through questions() method
        $questionnaire->load('questions.answers');
        // this is called lazy loading
        // we need to load this because this show method has to show questions with 
        // all answers

        return view('survey.show', compact('questionnaire'));
    }

    public function store(\App\Models\Questionnaire $questionnaire)
    {
        //dd(request()->all());

        $data = request()->validate
        (
            [
                'responses.*.answer_id' => 'required',
                'responses.*.question_id' => 'required',
                'survey.name' => 'required',
                'survey.email' => 'required|email'
            ]
        );

        $survey = $questionnaire->surveys()->create($data['survey']);
        $survey->responses()->createMany($data['responses']); 

        return "Thank you! ";
    }
}
