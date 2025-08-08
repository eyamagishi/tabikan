<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileDeletionRequest extends FormRequest
{
    /**
     * ユーザーがこのリクエストを実行する権限があるかどうかを判定します。
     * 
     * @return bool ユーザーが認可されている場合は true、そうでない場合は false
     */
    public function authorize(): bool
    {
        return $this->user() !== null;
    }

    /**
     * リクエストに適用するバリデーションルールを返します。
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'current_password'],
        ];
    }

    /**
     * バリデーション属性名を定義します（省略可能）。
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'password' => '現在のパスワード',
        ];
    }

    /**
     * カスタムエラーメッセージを定義します（省略可能）。
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'password.current_password' => 'パスワードが正しくありません。',
        ];
    }
}
