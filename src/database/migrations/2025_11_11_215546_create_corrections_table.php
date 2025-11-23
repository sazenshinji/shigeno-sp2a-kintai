<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrectionsTable extends Migration
{
    public function up()
    {
        Schema::create('corrections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operate_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('target_user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('attendance_id')->nullable()->constrained('attendances')->nullOnDelete();
            // 修正対象の勤怠レコード（新規追加の場合は NULL）
            $table->tinyInteger('type')->default(1);    // 種別: 0=新規追加, 1=修正, 2=削除
            $table->text('reason');                     // 申請理由
            $table->tinyInteger('status')->default(0);  // 0:申請中 / 1:承認済
            $table->date('after_work_date');
            $table->dateTime('after_clock_in')->nullable();
            $table->dateTime('after_clock_out')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('corrections');
    }
}
