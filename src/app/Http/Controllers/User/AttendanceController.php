<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Breaktime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    /**
     * 勤怠登録画面（ホーム画面）
     */
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)
            ->where('work_date', $today->toDateString())
            ->first();

        $status = $attendance->status ?? Attendance::STATUS_OFF;

        return view('user.attendance', [
            'user'       => $user,
            'attendance' => $attendance,
            'status'     => $status,
            'today'      => $today,
        ]);
    }

    /**
     * 出勤打刻
     */
    public function clockIn(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $now = now()->seconds(0); // 秒を 00 に切り捨て

        // すでに今日の勤怠があれば取得
        $attendance = Attendance::where('user_id', $user->id)
            ->where('work_date', $today->toDateString())
            ->first();

        if ($attendance && $attendance->status !== Attendance::STATUS_OFF) {
            return redirect()
                ->route('attendance')
                ->with('error', '本日はすでに出勤済みです。');
        }

        if (!$attendance) {
            $attendance = new Attendance();
            $attendance->user_id   = $user->id;
            $attendance->work_date = $today->toDateString();
        }

        $attendance->clock_in = $now;
        $attendance->status   = Attendance::STATUS_WORKING;
        $attendance->save();

        return redirect()
            ->route('attendance')
            ->with('success', '出勤を打刻しました。');
    }

    /**
     * 退勤打刻
     * - 「勤務中」のときのみ退勤可能
     * - 一度退勤したら、その日は再度「勤務中」には戻れない
     */
    public function clockOut(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $now = now()->seconds(0); // 秒を 00 に切り捨て

        $attendance = Attendance::where('user_id', $user->id)
            ->where('work_date', $today->toDateString())
            ->first();

        if (!$attendance || $attendance->status !== Attendance::STATUS_WORKING) {
            return redirect()
                ->route('attendance')
                ->with('error', '退勤できる状態ではありません。');
        }

        $attendance->clock_out = $now;
        $attendance->status    = Attendance::STATUS_DONE;
        $attendance->save();

        return redirect()
            ->route('attendance')
            ->with('success', '退勤を打刻しました。お疲れ様でした。');
    }

    /**
     * 休憩入り打刻
     * - 「勤務中」のときのみ休憩入り可能
     * - 休憩は何回でも可能（breaktimes に追加）
     */
    public function breakIn(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $now = now()->seconds(0); // 秒を 00 に切り捨て

        $attendance = Attendance::where('user_id', $user->id)
            ->where('work_date', $today->toDateString())
            ->first();

        if (!$attendance || $attendance->status !== Attendance::STATUS_WORKING) {
            return redirect()
                ->route('attendance')
                ->with('error', '休憩入りできる状態ではありません。');
        }

        // break_index 採番
        $lastIndex = Breaktime::where('attendance_id', $attendance->id)->max('break_index');
        $nextIndex = $lastIndex ? $lastIndex + 1 : 1;

        Breaktime::create([
            'attendance_id' => $attendance->id,
            'break_index'   => $nextIndex,
            'break_start'   => $now,
            'break_end'     => null,
        ]);

        $attendance->status = Attendance::STATUS_BREAK;
        $attendance->save();

        return redirect()->route('attendance')->with('success', '休憩入りを打刻しました。');
    }

    /**
     * 休憩戻り打刻
     * - 「休憩中」のときのみ休憩戻り可能
     * - 未終了の最新休憩 break_out を埋める
     */
    public function breakOut(Request $request)
    {
        $user = Auth::user();
        $today = Carbon::today();
        $now = now()->seconds(0); // 秒を 00 に切り捨て

        $attendance = Attendance::where('user_id', $user->id)
            ->where('work_date', $today->toDateString())
            ->first();

        if (!$attendance || $attendance->status !== Attendance::STATUS_BREAK) {
            return redirect()->route('attendance')
                ->with('error', '休憩戻りできる状態ではありません。');
        }

        $break = Breaktime::where('attendance_id', $attendance->id)
            ->whereNull('break_end')
            ->orderByDesc('break_index')
            ->first();

        if (!$break) {
            return redirect()->route('attendance')
                ->with('error', '未終了の休憩が見つかりませんでした。');
        }

        $break->break_end = $now;
        $break->save();

        $attendance->status = Attendance::STATUS_WORKING;
        $attendance->save();

        return redirect()->route('attendance')->with('success', '休憩戻りを打刻しました。');
    }
}
