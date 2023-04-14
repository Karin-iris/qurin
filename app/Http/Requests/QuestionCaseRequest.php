<?php

namespace App\Http\Requests;

use App\Models\QuestionCase;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class QuestionCaseRequest extends FormRequest
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
            'user_id' => ['integer'],
            'is_request' => ['boolean'],
        ];
    }
}
