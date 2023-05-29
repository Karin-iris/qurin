<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategorySecondaryRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'code' => ['required','regex:/^[0-9]{2}$/'
                ,Rule::unique('secondary_categories')
                    ->ignore($this->code)
                    ->where('primary_id', $this->primary_id)],
            'order' => 'required|integer',
        ];
    }
}
