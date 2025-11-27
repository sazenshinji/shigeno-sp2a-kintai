<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrectionInoutsTable extends Migration
{
    public function up()
    {
        Schema::create('correctioninouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('correction_id')->constrained('corrections')->cascadeOnDelete();
            $table->date('after_work_date');
            $table->dateTime('after_clock_in')->nullable();
            $table->dateTime('after_clock_out')->nullable();
            $table->timestamps();

            // ★ 1対1制約
            $table->unique('correction_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('correctioninouts');
    }
}
