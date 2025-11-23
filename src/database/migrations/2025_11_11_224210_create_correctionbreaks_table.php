<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrectionBreaksTable extends Migration
{
    public function up()
    {
        Schema::create('correctionbreaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('correction_id')->constrained('corrections')->cascadeOnDelete();
            $table->tinyInteger('break_index');
            $table->dateTime('after_break_start');
            $table->dateTime('after_break_end');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('correctionbreaks');
    }
}
