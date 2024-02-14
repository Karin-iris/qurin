<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRegisterRequest extends FormRequest
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
        if (isset($request->mode) && $request->mode === "update") {
            return [
                'name' => [
                    'string',
                    'required',
                    'max:255',
                    Rule::unique('users')->ignore($request->id, 'id'),
                    'unique:admins',
                ],
                'email' => [
                    'email',
                    'required', // 必須
                    // 重複チェック。Rule::unique('テーブル名')->ignore(主キー, '主キーのカラム名')
                    Rule::unique('users')->ignore($request->id, 'id')
                ],
                'icon' => 'nullable|image|mimes:jpeg,jpg',
                'password' => ['string', 'max:255'],
            ];
        }

        if (isset($request->mode) && $request->mode === "create") {
            // 登録画面のバリデーション
            return [
                // ユーザー名
                'name' => ['string', 'required', 'max:255', 'unique:users'],
                // メールアドレス
                'email' => [
                    'email',
                    'required', // 必須
                    'unique:users',
                ],
                'icon' => 'nullable|image|mimes:jpeg,jpg',
                'password' => ['string', 'max:255'],
            ];
        }

        if (isset($request->mode) && $request->mode === "user_invite") {
            return [
                'email' => [
                    'email',
                    'required',
                    'unique:users',
                    'unique:admins',
                ],
            ];
        }
        if (isset($request->mode) && $request->mode == "change_password") {
            return [
                'password' => ['string', 'max:255', 'confirmed']
            ];
        }
        if (isset($request->mode) && $request->mode == "admin_invite") {
            return [
                'email' => [
                    'email',
                    'required',
                    'unique:users',
                    'unique:admins',
                ],
            ];
        }

        return [
            'name' => ['string','required', 'max:255',Rule::unique('admins')->ignore($request->id, 'id'),],
            // メールアドレス
            'email'     => [
                'email',
                'required', // 必須
                Rule::unique('admins')->ignore($request->id, 'id'),
            ]
        ];
    }
}
