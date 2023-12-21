<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionCaseQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    public function rules(): array
    {
        return [

        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
}
