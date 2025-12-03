<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeforeBreaksTable extends Migration
{
    public function up()
    {
        Schema::create('before_breaks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('before_correction_id')->constrained('before_corrections')->cascadeOnDelete();
            $table->tinyInteger('break_index');
            $table->dateTime('before_break_start');
            $table->dateTime('before_break_end')->nullable();
            $table->timestamps();

            $table->unique(['before_correction_id', 'break_index']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('before_breaks');
    }
}
