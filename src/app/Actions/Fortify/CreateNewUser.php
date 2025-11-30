<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Auth\Events\Registered;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        // RegisterRequest の rules/messages を利用してバリデーション
        $formRequest = app(RegisterRequest::class);

        Validator::make(
            $input,
            $formRequest->rules(),
            $formRequest->messages()
        )->validate();

        return User::create([
            'name'     => $input['name'],
            'email'    => $input['email'],
            'password' => Hash::make($input['password']),
            'role'     => 0, // 一般ユーザー固定
        ]);

        // イベントを発行
        event(new Registered($user));

        return $user;
    }
}
