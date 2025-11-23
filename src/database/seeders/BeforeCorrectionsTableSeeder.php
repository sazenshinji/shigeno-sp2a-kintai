<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BeforeCorrectionsTableSeeder extends Seeder
{
    public function run()
    {
        //----2025年11月5日(水)----
        //　承認待ちのためレコードはない。

        //----2025年11月8日(土)----
        //　承認待ちのためレコードはない。

        //----2025年12月1日(月)----
        //　承認待ちのためレコードはない。

        
        //----2025年12月2日(火)----
        $param = [
            'correction_id'    => 4,
            'before_work_date'  => '2025-12-2',
            'before_clock_in'   => Carbon::create(2025, 12, 2, 9, 0, 0),
            'before_clock_out'  => Carbon::create(2025, 12, 2, 18, 0, 0),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('beforecorrections')->insert($param);
    }
}
