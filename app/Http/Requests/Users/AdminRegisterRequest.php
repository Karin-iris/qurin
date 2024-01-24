<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(Request $request): array
    {
        if (isset($request->mode) && $request->mode == "update") {
            return [
                'name' => [
                    'string',
                    'required',
                    'max:255',
                    'unique:users',
                    Rule::unique('admins')->ignore($request->id, 'id'),
                ],
                'email'     => [
                    'email',
                    'required', // 必須
                    Rule::unique('admins')->ignore($request->id, 'id'),
                ],
                'code'     => [
                    'required', // 必須
                    Rule::unique('admins')->ignore($request->id, 'id'),
                ]
            ];
        } elseif (isset($request->mode) && $request->mode == "create") {
            // 登録画面のバリデーション
            return [
                // ユーザー名
                'name' => ['string','required', 'max:255','unique'],
                // メールアドレス
                'email'     => [
                    'email',
                    'required', // 必須
                    'unique',
                ],
                'code'     => [
                    'required', // 必須
                    'unique',
                ],
                'icon' => 'nullable|image|mimes:jpeg,jpg',
                'password' => ['string', 'max:255'],
            ];
        } elseif (isset($request->mode) && $request->mode == "admin_invite") {
            return [
                'email'     => [
                    'email',
                    'required',
                    'unique',
                ],
            ];
        }else{
            return [
                'name' => ['string','required', 'max:255','unique:admins'],
                // メールアドレス
                'email'     => [
                    'email',
                    'required', // 必須
                    'unique',
                ],
                'password' => ['string', 'max:255'],
            ];
        }
    }
}
