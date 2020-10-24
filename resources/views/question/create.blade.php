@extends('layouts.app')
{{-- inherits the 'layouts.app' --}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create New Questionnaire</div>
                    <div class="card-body">
                    <form action="/questionnaires/{{$questionnaire->id}}/questions" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="question">Question</label>
                                {{-- field name array syntax --}}
                                {{-- array name form input --}}
                                <input name="question[question]" type="text" class="form-control" id="question" aria-describedby="questionHelp" 
                                placeholder="Enter question" value="{{old('question.question')}}">
                                <small id="questionHelp" class="form-text text-muted">Ask simple questions</small>
                                @error('question.question')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <fieldset>
                                    <legend>Choices</legend>
                                    
                                    <small id="choicesHelp" class="form-text text-muted">Give choices that give the most insight into your question</small>
                                    
                                    <div class="form-group">
                                        <label for="answer1">Choice 1</label>
                                        {{-- field name array syntax --}}
                                        {{-- here 'answers' is our parent. 'answers[n]' is our first child.
                                        'answers[1][answer]' is our child's property--}}
                                        <input name="answers[][answer]" type="text" class="form-control" id="answer1" aria-describedby="choiceHelp" 
                                        placeholder="Enter choice 1" value="{{old('answers.0.answer')}}">
                                        {{-- 
                                            Person 1:
                                            <label>First name</label>
                                            <input name="people[1][first_name]">

                                            <label>Last name</label>
                                            <input name="people[1][last_name]">

                                            <label>Email</label>
                                            <input name="people[1][email]">

                                            Person 2:
                                            <label>First name</label>
                                            <input name="people[2][first_name]">

                                            <label>Last name</label>
                                            <input name="people[2][last_name]">

                                            <label>Email</label>
                                            <input name="people[2][email]">

                                            We are getting :
                                            people = [
                                                [
                                                    'first_name' => 'Jim',
                                                    'last_name' => 'Barber',
                                                    'email' => 'jim@barber.com
                                                ],
                                                [
                                                    'first_name' => 'Amira',
                                                    'last_name' => 'Sayegh',
                                                    'email' => 'amira@sayegh.com
                                                ]
                                            ]
                                            --}}
                                        @error('answers.0.answer')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="answer2">Choice 2</label>
                                        <input name="answers[][answer]" type="text" class="form-control" id="answer2" aria-describedby="choiceHelp" 
                                        placeholder="Enter choice 2" value="{{old('answers.1.answer')}}">
                                        
                                        @error('answers.1.answer')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror                                      
                                    </div>

                                    <div class="form-group">
                                        <label for="answer3">Choice 3</label>
                                        <input name="answers[][answer]" type="text" class="form-control" id="answer3" aria-describedby="choiceHelp" 
                                        placeholder="Enter choice 3" value="{{old('answers.2.answer')}}">
                                        
                                        @error('answers.2.answer')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror                                      
                                    </div>
                                </fieldset>
                            </div>
                            <button type="submit" class="btn btn-primary">Add question</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
