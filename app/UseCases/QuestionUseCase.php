<?php

namespace App\UseCases;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;

class QuestionUseCase extends UseCase{

    public Question $question;

    function __construct()
    {
        $this->question = new Question();
    }

    function saveQuestion(QuestionRequest $request)
    {
        $this->question->fill($request->all())->save();
    }

    function updateCategory(QuestionRequest $request, int $id)
    {
        $this->question->find($id)->fill([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'secondary_id' => $request->input('category_id')
        ])->save();
    }
}
