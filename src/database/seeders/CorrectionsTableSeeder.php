<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CorrectionsTableSeeder extends Seeder
{
    public function run()
    {
        $param = [
            'operate_user_id' => 1,         // 大谷 翔平
            'target_user_id' => 1,          // 大谷 翔平
            'attendance_id' => 2,           // 11月5日(水)
            'type' => 1,                    // 種別: 1=修正
            'reason' => '入力間違いのため',  // 申請理由
            'status' => 0,                  // 0:申請中
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('corrections')->insert($param);
        $param = [
            'operate_user_id' => 1,                  // 大谷 翔平
            'target_user_id' => 1,                   // 大谷 翔平
            'attendance_id' => null,                 // 未登録
            'type' => 0,                             // 種別: 0=新規追加
            'reason' => '上司命令により休日出勤のため', // 申請理由
            'status' => 0,                           // 0:申請中
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
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('corrections')->insert($param);
        $param = [
            'operate_user_id' => 6,            // (代)鈴木 花子
            'target_user_id' => 1,             // 大谷 翔平
            'attendance_id' => 35,             // 12月2日(火)
            'type' => 1,                       // 種別: 1=修正
            'reason' => '修正(代：鈴木花子)',   // 申請理由
            'status' => 1,                     // 1:承認済
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('corrections')->insert($param);
    }
}
