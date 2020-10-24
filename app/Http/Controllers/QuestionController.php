<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionnaire;
use App\Models\Question;

class QuestionController extends Controller
{
    // Route model binding
    // the variable name has to be the same as '/questionnaires/{questionnaire}/questions/create'
    public function create(Questionnaire $questionnaire)
    {
        return view('question.create', compact('questionnaire'));
    }

    public function store(Questionnaire $questionnaire)
    {
        //dd(request()->all());

        $data = request()->validate([
                'question.question' => 'required',
                'answers.*.answer' => 'required'
        ]);

        //dd($data);

        /** the create method, which accepts an array of attributes, creates a model, and inserts it into the database. */

        $question = $questionnaire->questions()->create($data['question']);
        // $question now is a Question model
        // because questions() returns hasMany(Question::class)
        // Question class has answers() method
        // answers() returns hasMany(Answer::class)
        // $question can access answers() method in Question class
		
		// $questionnaire->questions()
		// this relationship means:
		// the Questions of Questionnaire table's id = n
		// we are getting the Question table's data
		// where Question table's foreign key questionnaire_id = Questionnaire table's id
		
		// we have to fill the table with data 
		// then we can use the relationship

        $question->answers()->createMany($data['answers']);

        // for every one question, we are entering multiple answers
        // thus create() and createMany()

        // we need to migrate this because we did not create question and answers table  when we created the model
        
        return redirect('/questionnaires/'.$questionnaire->id);
    }

    // Route model binding
    // the variable name has to be the same as '/questionnaires/{questionnaire}/questions/create'
    public function destroy(Questionnaire $questionnaire, \App\Models\Question $question)
    {
        $question->answers()->delete();
        $question->delete();

        return redirect($questionnaire->path());
    }

    // Without route model binding
    //  public function destroy($questionnaire,$question)
    // {
    //     $questionToBeDeleted = Question::findOrFail($question);
    //     //dd($questionToBeDeleted->answers);
    //     $questionToBeDeleted->answers()->delete();
    //     $questionToBeDeleted->delete();
        
    //     // $id = new Questionnaire;
    //     // return redirect($id->path())
    //     // this will not work
	
    //     return redirect()->back();
    // }
    
}
