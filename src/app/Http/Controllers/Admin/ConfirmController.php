<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;

class ConfirmController extends Controller
{
    /**
     * 管理者用：日次勤怠一覧（とりあえずビュー表示のみ）
     */
    public function daily(Request $request)
    {
        // ここに後で集計処理などを書いていく想定
        return view('admin.daily');
    }
}
