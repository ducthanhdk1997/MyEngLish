<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_session', function (Blueprint $table) {
            $table->increments('id');
            $table->date('start_date');
            $table->string('state');
            $table->unsignedInteger('shift_id')->nullable();
            $table->unsignedInteger('class_id')->nullable();
            $table->unsignedInteger('classroom_id')->nullable();
            $table->unsignedInteger('schedule_id')->nullable();
            $table->timestamps();

            $table->foreign('schedule_id')
                ->references('id')
                ->on('schedule_class')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('shift_id')
                ->references('id')
                ->on('shifts')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('class_id')
                ->references('id')
                ->on('classes')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('classroom_id')
                ->references('id')
                ->on('classrooms')
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
        Schema::dropIfExists('class_session');
    }
}
