<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\LoginResponse;

use App\Http\Requests\Auth\LoginRequest as CustomLoginRequest;
use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

class FortifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        // ログイン後の遷移制御
        $this->app->singleton(LoginResponseContract::class, LoginResponse::class);

        // Fortify の LoginRequest を自作 LoginRequest に差し替え
        $this->app->bind(FortifyLoginRequest::class, CustomLoginRequest::class);

    }

    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);

        // ログイン画面（URLに応じて role をセット）
        Fortify::loginView(function () {
            if (request()->is('admin/login')) {
                // 管理者ログイン画面から来た
                session(['login_role' => 'admin']);
                return view('auth.adminlogin');
            }

            // 一般ログイン画面
            session(['login_role' => 'user']);
            return view('auth.login');
        });

        // 一般会員登録画面
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // ログイン試行制限（429対策：開発中は緩くする）
        RateLimiter::for('login', function (Request $request) {
            // 開発中はかなり緩く（または Limit::none() でもOK）
            return Limit::perMinute(100)->by($request->email . $request->ip());
        });

        // 認証処理 分岐
        Fortify::authenticateUsing(function (Request $request) {
            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return null;
            }

            $loginRole = session('login_role');

            if (!$loginRole) {
                return null;
            }

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
