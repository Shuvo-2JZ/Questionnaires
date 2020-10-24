@extends('layouts.app')
{{-- inherits the 'layouts.app' --}}

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ $questionnaire->title }}</h1>
                <form action="/surveys/{{ $questionnaire->id }}-{{ Str::slug($questionnaire->title) }}" method="POST">
                    @csrf
                    {{-- $key is the first iteration value 0. key 0 is assigned to first
                    $question --}}
                    @foreach ($questionnaire->questions as $key => $question)
                        <div class="card mt-4">
                            <div class="card-header"><strong>{{ $key + 1 }}</strong> {{ $question->question }}</div>
                            <div class="card-body">
                                @error('responses.' . $key . '.answer_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                                <ul class="list-group">
                                    @foreach ($question->answers as $answer)
                                        <label for="answer{{ $answer->id }}">
                                            <li class="list-group-item">
                                                <input type="radio" name="responses[{{ $key }}][answer_id]"
                                                    id="answer{{ $answer->id }}" class="mr-2" value="{{ $answer->id }}"
                                                    {{ old('responses.' . $key . '.answer_id') == $answer->id ? 'checked' : ' ' }}>
                                                {{--
                                                responses = [
                                                ["answer_id" => "1", "question_id" => "1"],
                                                ["answer_id" => "2", "question_id" => "1"]
                                                ]
                                                --}}
                                                {{-- "answer_id" and "question_id" is getting
                                                the element in the "value" --}}
                                                {{ $answer->answer }}

                                                <input type="hidden" name="responses[{{ $key }}][question_id]"
                                                    value="{{ $question->id }}">
                                            </li>
                                        </label>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                    <div class="card">
                        <div class="card-header">Your Information</div>
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input name="survey[name]" type="text" class="form-control" id="name" aria-describedby="nameHelp" placeholder="Enter your name">
                                <small id="nameHelp" class="form-text text-muted">Enter Name</small>
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input name="survey[email]" type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter your email">
                                <small id="emailHelp" class="form-text text-muted">Enter email</small>
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div>
                        <button class="btn btn-dark mt-2" type="submit">Complete Survey</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
