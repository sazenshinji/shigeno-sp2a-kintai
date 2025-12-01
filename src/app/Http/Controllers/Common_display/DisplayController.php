<?php

namespace App\Http\Controllers\Common_display;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DisplayController extends Controller
{
    /**
     * 月次勤怠一覧（ユーザー・管理者 共通）
     */
    public function monthly(Request $request)
    {
        $user = Auth::user();
        $month = $request->query('month');
        $current = $month ? Carbon::parse($month) : Carbon::now();

        $start = $current->copy()->startOfMonth();
        $end   = $current->copy()->endOfMonth();
        $today = Carbon::today();

        // 月の勤怠を work_date をキーにコレクション化
        $attendanceMap = Attendance::with('breaktimes')
            ->where('user_id', $user->id)
            ->whereBetween('work_date', [$start, $end])
            ->get()
            ->keyBy(function ($item) {
                return Carbon::parse($item->work_date)->format('Y-m-d');
            });

        //月初〜月末まで全日生成
        $dates = [];
        $date = $start->copy();
        while ($date <= $end) {
            $key = $date->format('Y-m-d');
            $dates[] = [
                'date' => $date->copy(),
                'attendance' => $attendanceMap[$key] ?? null,
            ];
            $date->addDay();
        }

        return view('common_display.monthly', [
            'dates'      => $dates,
            'current'    => $current,
            'prevMonth'  => $current->copy()->subMonth()->format('Y-m'),
            'nextMonth'  => $current->copy()->addMonth()->format('Y-m'),
            'today'      => $today,
        ]);
    }
}
