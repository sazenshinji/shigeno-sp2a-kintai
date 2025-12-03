<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfterBreaksTable extends Migration
{
    public function up()
    {
        Schema::create('after_breaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('after_correction_id')->constrained('after_corrections')->cascadeOnDelete();
            $table->tinyInteger('break_index');
            $table->dateTime('after_break_start');
            $table->dateTime('after_break_end');
            $table->timestamps();

            $table->unique(['after_correction_id', 'break_index']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('after_breaks');
    }
}
