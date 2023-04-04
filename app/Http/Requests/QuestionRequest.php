<?php

namespace App\Http\Requests;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'topic' => ['string', 'max:255'],
            'text' => ['string'],
            'correct_choice' => ['string'],
            'wrong_choice_1' => ['string'],
            'wrong_choice_2' => ['string'],
            'wrong_choice_3' => ['string'],
            'user_id' => ['integer'],
        ];
    }
}
