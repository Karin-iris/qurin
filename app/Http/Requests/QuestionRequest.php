<?php

namespace App\Http\Requests;

use App\Models\Question;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            'correct_choice' => str_replace(array("\r\n", "\r", "\n"), '',$this['correct_choice']),
            'wrong_choice_1' => str_replace(array("\r\n", "\r", "\n"), '', $this['wrong_choice_1']),
            'wrong_choice_2' => str_replace(array("\r\n", "\r", "\n"), '', $this['wrong_choice_2']),
            'wrong_choice_3' => str_replace(array("\r\n", "\r", "\n"), '', $this['wrong_choice_3']),
        ]);
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['integer'],
            'text' => ['string'],
            'compitency' => ['string'],
            'user_name' => ['string'],
            'correct_choice' => ['string'],
            'wrong_choice_1' => ['string'],
            'wrong_choice_2' => ['string'],
            'wrong_choice_3' => ['string'],
            'is_request' => ['boolean'],
            'is_approve' => ['boolean'],
            'user_id' => ['integer'],
        ];
    }
}
