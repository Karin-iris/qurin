<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
            ,Rule::unique('categories')
                ->where('secondary_id', $this->secondary_id)],
            'order' => 'required|integer',
        ];
    }
}
