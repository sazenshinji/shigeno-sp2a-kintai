<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // 勤怠ステータス定数
    public const STATUS_OFF     = 0; // 勤務外
    public const STATUS_WORKING = 1; // 勤務中
    public const STATUS_BREAK   = 2; // 休憩中
    public const STATUS_DONE    = 3; // 退勤済

    public const STATUS_LABELS = [
        self::STATUS_OFF     => '勤務外',
        self::STATUS_WORKING => '勤務中',
        self::STATUS_BREAK   => '休憩中',
        self::STATUS_DONE    => '退勤済',
    ];

    protected $fillable = [
        'user_id',
        'work_date',
        'clock_in',
        'clock_out',
        'status',
    ];

    protected $dates = [
        'work_date',
        'clock_in',
        'clock_out',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 休憩を別テーブルで管理する場合の関連（breaktimes テーブルがある前提）
    public function breaktimes()
    {
        return $this->hasMany(Breaktime::class);
    }

    // ラベル取得用アクセサ（blade から $attendance->status_label で参照可能）
    public function getStatusLabelAttribute(): string
    {
        return self::STATUS_LABELS[$this->status] ?? '不明';
    }
}
