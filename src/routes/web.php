<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LogoutController;

// 未ログインはログイン画面へ
Route::get('/', fn() => redirect('/login'));

// 管理者ログイン画面
Route::middleware('guest')->get('/admin/login', function () {
    session(['login_role' => 'admin']); // ⭐ここを追加！
    return view('auth.adminlogin');
})->name('admin.login');

// 一般ユーザー向けページ
Route::middleware(['auth'])->get('/attendance', [AttendanceController::class, 'index'])->name('attendance');

// 管理者専用ページ
Route::middleware(['auth', 'admin'])->get('/admin/attendance/list', fn() => view('admin.daily'))->name('admin.daily');

// ログアウト（共通）
Route::post('/logout', LogoutController::class)->name('logout');
