<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;

class LogoutController
{
    public function __invoke()
    {
        $role = Auth::check() ? Auth::user()->role : null;

        Auth::logout();

        session()->invalidate();  // セッション破棄
        session()->regenerateToken(); // CSRFトークン再生成
        session()->forget('login_role'); // 🔥 これが超重要！！

        return $role === 1
            ? redirect('/admin/login')
            : redirect('/login');
    }
}