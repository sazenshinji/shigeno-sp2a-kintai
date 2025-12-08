<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\AttendanceController as UserAttendanceController;
use App\Http\Controllers\Admin\ConfirmController as AdminConfirmController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Common_display\DisplayController;

// 未ログインはログイン画面へ
Route::get('/', fn() => redirect('/login'));

// 管理者ログイン画面
Route::middleware('guest')->get('/admin/login', function () {
    session(['login_role' => 'admin']);
    return view('auth.adminlogin');
})->name('admin.login');


// ==============================
// ログイン必須 共通
// ==============================
Route::middleware(['auth'])->group(function () {

    // =========================
    // 一般ユーザー専用（verified）
    // =========================
    Route::middleware(['verified'])
        ->prefix('attendance')
        ->group(function () {

            Route::get('/', [UserAttendanceController::class, 'index'])->name('attendance');

            Route::post('/clock-in', [UserAttendanceController::class, 'clockIn'])->name('attendance.clockIn');
            Route::post('/clock-out', [UserAttendanceController::class, 'clockOut'])->name('attendance.clockOut');
            Route::post('/break-in', [UserAttendanceController::class, 'breakIn'])->name('attendance.breakIn');
            Route::post('/break-out', [UserAttendanceController::class, 'breakOut'])->name('attendance.breakOut');

            Route::get('/list', [DisplayController::class, 'monthly'])->name('attendance.list');
            Route::get('/detail/{date}', [DisplayController::class, 'detail'])->name('attendance.detail');

            Route::post('/detail/update', [DisplayController::class, 'update'])->name('attendance.detail.update');
            Route::post('/detail/delete', [DisplayController::class, 'delete'])->name('attendance.detail.delete');
        });


    // =========================
    // ユーザー・管理者 共通
    // =========================
    Route::get('/stamp_correction_request/list', [DisplayController::class, 'requestList'])
        ->name('request.list');

    Route::get('/stamp_correction_request/approve/{id}', [DisplayController::class, 'requestDetail'])
        ->name('request.detail');


    // =========================
    // 管理者専用
    // =========================
    Route::middleware(['admin'])
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::get('/attendance/list', [AdminConfirmController::class, 'daily'])
                ->name('daily');

            Route::get('/staff/list', [AdminConfirmController::class, 'staffList'])
                ->name('staff.list');

            // スタッフの月次勤怠一覧（管理者用）
            Route::get('/attendance/staff/{id}', [DisplayController::class, 'adminMonthly'])
                ->name('attendance.staff');

            Route::get('/attendance/staff/{id}/csv', [DisplayController::class, 'adminMonthlyCsv'])
                ->name('attendance.staff.csv');

            Route::get('/attendance/{user}/{date}', [DisplayController::class, 'adminDetail'])
                ->name('attendance.detail');

            Route::post(
                '/attendance/{user}/{date}/update',
                [DisplayController::class, 'adminImmediateUpdate']
            )->name('attendance.immediateUpdate');

            Route::post(
                '/stamp_correction_request/approve/{id}',
                [DisplayController::class, 'approve']
            )->name('request.approve');
        });
});


// ==============================
// ログアウト（共通）
// ==============================
Route::post('/logout', LogoutController::class)->name('logout');
