<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('content');
            $table->string('a');
            $table->string('b');
            $table->string('c');
            $table->string('d');
            $table->float('point');
            $table->string('answer');
            $table->string('image');
            $table->unsignedInteger('exercise_id')->nullable();
            $table->timestamps();

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
        Schema::dropIfExists('question');
    }
}
