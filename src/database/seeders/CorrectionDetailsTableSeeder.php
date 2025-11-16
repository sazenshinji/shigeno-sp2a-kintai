<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class CorrectionDetailsTableSeeder extends Seeder
{
    public function run()
    {
        //----2025年11月5日(水) 大谷 翔平 【修正】----
        $param = [
            'correction_id' => 1,                                   // FK
            'field_id' => 0,                                        // 0:clock_in
            'break_index' => null,                                  // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 11, 5, 7, 30, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);
        $param = [
            'correction_id' => 1,                                   // FK
            'field_id' => 1,                                        // 1:clock_out
            'break_index' => null,                                  // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 11, 5, 16, 45, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);
        $param = [
            'correction_id' => 1,                                   // FK
            'field_id' => 2,                                        // 2:break_start
            'break_index' => 1,                                     // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 11, 5, 12, 30, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);
        $param = [
            'correction_id' => 1,                                   // FK
            'field_id' => 3,                                        // 3:break_end
            'break_index' => 1,                                     // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 11, 5, 13, 15, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);
        $param = [
            'correction_id' => 1,                                   // FK
            'field_id' => 2,                                        // 2:break_start
            'break_index' => 2,                                     // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 11, 5, 15, 15, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);
        $param = [
            'correction_id' => 1,                                   // FK
            'field_id' => 3,                                        // 3:break_end
            'break_index' => 2,                                     // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 11, 5, 15, 45, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);

        //----2025年11月8日(土) 大谷 翔平 【追加】----
        $param = [
            'correction_id' => 2,                                   // FK
            'field_id' => 0,                                        // 0:clock_in
            'break_index' => null,                                  // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 11, 8, 10, 30, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);
        $param = [
            'correction_id' => 2,                                   // FK
            'field_id' => 1,                                        // 1:clock_out
            'break_index' => null,                                  // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 11, 8, 17, 45, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);
        $param = [
            'correction_id' => 2,                                   // FK
            'field_id' => 2,                                        // 2:break_start
            'break_index' => 1,                                     // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 11, 8, 12, 15, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);
        $param = [
            'correction_id' => 2,                                   // FK
            'field_id' => 3,                                        // 3:break_end
            'break_index' => 1,                                     // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 11, 8, 12, 45, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);

        //----2025年12月1日(月) 大谷 翔平 【削除】----
        //　　削除の場合、correctiondetailsテーブルの登録はない。

        //----2025年12月2日(火) 大谷 翔平 【代理修正】----
        $param = [
            'correction_id' => 4,                                   // FK
            'field_id' => 0,                                        // 0:clock_in
            'break_index' => null,                                  // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 12, 2, 7, 0, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);
        $param = [
            'correction_id' => 4,                                   // FK
            'field_id' => 1,                                        // 1:clock_out
            'break_index' => null,                                  // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 12, 2, 21, 0, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);
        $param = [
            'correction_id' => 4,                                   // FK
            'field_id' => 2,                                        // 2:break_start
            'break_index' => 1,                                     // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 12, 2, 12, 15, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);
        $param = [
            'correction_id' => 4,                                   // FK
            'field_id' => 3,                                        // 3:break_end
            'break_index' => 1,                                     // 休憩番号
            'before_value' => null,                                 // 変更前-日時
            'after_value' => Carbon::create(2025, 12, 2, 13, 15, 0), // 変更後-日時
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('correctiondetails')->insert($param);
    }
}
