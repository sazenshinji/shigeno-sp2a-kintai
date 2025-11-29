<?php

namespace App\Http\Requests\Auth;

use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

class LoginRequest extends FortifyLoginRequest
{
    // authorize() は Fortify 側で true になっているので通常そのままでOK

    public function rules()
    {
        // Fortify の rules() を上書き（ここがあなたのバリデーション定義になる）
        return [
            'email'    => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        // あなたの好きなメッセージ
        return [
            'email.required'    => 'メールアドレスを入力してください',
            'email.email'       => '正しいメール形式で入力してください',
            'email.exists'      => 'ログイン情報が登録されていません',
            'password.required' => 'パスワードを入力してください',
        ];
    }
}
