<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrectionDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('correctiondetails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('correction_id')->constrained('corrections')->cascadeOnDelete();
            $table->tinyInteger('field_id'); // 0:clock_in / 1:clock_out / 2:break_start / 3:break_end
            $table->tinyInteger('break_index')->nullable(); //休憩番号:field_id が 2,3 の場合は必須
            $table->dateTime('before_value')->nullable();
            $table->dateTime('after_value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('correctiondetails');
    }
}
