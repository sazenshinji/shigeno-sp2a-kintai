<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CorrectionsTableSeeder extends Seeder
{
    public function run()
    {
        $param = [
            'operate_user_id' => 1,    // 大谷 翔平
            'target_user_id' => 1,     // 大谷 翔平
            'attendance_id' => 2,      // 11月5日(水)
            'type' => 1,               // 種別: 1=修正
            'reason' => '間違い修正',   // 申請理由
            'status' => 0,             // 0:申請中
            'after_work_date'  => '2025-11-5',
            'after_clock_in'   => Carbon::create(2025, 11, 5, 7, 30, 0),
            'after_clock_out'  => Carbon::create(2025, 11, 5, 16, 45, 0),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('corrections')->insert($param);
        $param = [
            'operate_user_id' => 1,        // 大谷 翔平
            'target_user_id' => 1,         // 大谷 翔平
            'attendance_id' => null,       // 未登録
            'type' => 0,                   // 種別: 0=新規追加
            'reason' => '後日入力',         // 申請理由
            'status' => 0,                 // 0:申請中
            'after_work_date'  => '2025-11-8',
            'after_clock_in'   => Carbon::create(2025, 11, 8, 10, 30, 0),
            'after_clock_out'  => Carbon::create(2025, 11, 8, 17, 45, 0),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('corrections')->insert($param);
        $param = [
            'operate_user_id' => 1,    // 大谷 翔平
            'target_user_id' => 1,     // 大谷 翔平
            'attendance_id' => 31,     // 12月1日(月)
            'type' => 2,               // 種別: 2=削除
            'reason' => '入力ミス',     // 申請理由
            'status' => 0,             // 0:申請中
            'after_work_date'  => '2025-12-1',
            'after_clock_in'   => null,
            'after_clock_out'  => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('corrections')->insert($param);
        $param = [
           'operate_user_id' => 5,            // (代)長嶋 茂雄
            'target_user_id' => 1,             // 大谷 翔平
            'attendance_id' => 35,             // 12月2日(火)
            'type' => 1,                       // 種別: 1=修正
            'reason' => '修正(代：長嶋茂雄)',   // 申請理由
            'status' => 1,                     // 1:承認済
            'after_work_date'  => '2025-12-2',
            'after_clock_in'   => Carbon::create(2025, 12, 2, 7, 0, 0),
            'after_clock_out'  => Carbon::create(2025, 12, 2, 21, 0, 0),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('corrections')->insert($param);
    }
}
