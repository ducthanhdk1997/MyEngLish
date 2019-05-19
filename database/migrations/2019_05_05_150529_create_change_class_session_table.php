<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChangeClassSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('change_class_session', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reason');
            $table->unsignedInteger('class_session_id')->nullable()->unique();
            $table->date('start_date');
            $table->unsignedInteger('shift_id')->nullable();
            $table->unsignedInteger('classroom_id')->nullable();
            $table->boolean('state');
            $table->unsignedInteger('user_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onUpdae('cascade')
                ->onDelete('set null');

            $table->foreign('class_session_id')
                ->references('id')
                ->on('class_session')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->foreign('shift_id')
                ->references('id')
                ->on('shifts')
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
        Schema::dropIfExists('change_class_session');
    }
}
