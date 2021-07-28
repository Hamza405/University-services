<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudyProgram extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('study_program', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->string('year1');
            $table->string('year2');
            $table->string('year3');
            $table->string('year4');
            $table->string('year5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('study_program');
    }
}
