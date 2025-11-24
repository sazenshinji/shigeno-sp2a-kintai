<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\LoginResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use App\Models\User;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
    }

    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        // Fortifyによるログイン画面
        Fortify::loginView(function () {
            // login_roleはWebルート側で設定するため、ここでは不要に
            return view('auth.login');
        });

        // 会員登録画面（一般のみ）
        Fortify::registerView(function () {
            return view('auth.register');
        });

        Fortify::authenticateUsing(function ($request) {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return null;
            }

            $loginRole = session('login_role');

            if ($loginRole === 'admin') {
                return $user->role === 1 ? $user : null;
            }

            if ($loginRole === 'user') {
                return $user->role === 0 ? $user : null;
            }

            return null;
        });
    }
}
