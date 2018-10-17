<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassExercisesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_exercises', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('class_id')->nullable();
            $table->unsignedInteger('exercise_id')->nullable();
            $table->date('deadline');
            $table->timestamps();

            $table->foreign('class_id')
                ->references('id')
                ->on('class')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('exercise_id')
                ->references('id')
                ->on('exercises')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_exercises');
    }
}
