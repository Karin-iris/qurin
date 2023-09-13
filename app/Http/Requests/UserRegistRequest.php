<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserRegistRequest extends FormRequest
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
        if (isset($request->id)) {
            return [
                'name' => [
                    'string',
                    'required',
                    'max:255',
                    Rule::unique('users')->ignore($request->id, 'id')
                ],
                'email'     => [
                    'email',
                    'required', // 必須
                    // 重複チェック。Rule::unique('テーブル名')->ignore(主キー, '主キーのカラム名')
                    Rule::unique('users')->ignore($request->id, 'id'),
                ],
                'password' => ['string', 'max:255'],
            ];
        } else {
            // 登録画面のバリデーション
            return [
                // ユーザー名
                'name' => ['string','required', 'max:255','unique:users'],
                // メールアドレス
                'email'     => [
                    'email',
                    'required', // 必須
                    'unique:users',
                ],
                'password' => ['string', 'max:255'],
            ];
        }
    }
}
