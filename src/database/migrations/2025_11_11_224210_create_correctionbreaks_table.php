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
            $table->foreignId('correctioninout_id')->constrained('correctioninouts')->cascadeOnDelete();
            $table->tinyInteger('break_index');
            $table->dateTime('after_break_start');
            $table->dateTime('after_break_end');
            $table->timestamps();

            $table->unique(['correctioninout_id', 'break_index']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('correctionbreaks');
    }
}
