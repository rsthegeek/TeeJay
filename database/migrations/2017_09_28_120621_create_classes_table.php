<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('course_id');
            $table->unsignedInteger('teacher_id');
            $table->string('code', 6);
            $table->unsignedTinyInteger('first_session_day')->nullable();
            $table->unsignedInteger('first_session_id')->nullable();
            $table->unsignedTinyInteger('second_session_day')->nullable();
            $table->unsignedInteger('second_session_id')->nullable();
            $table->unsignedTinyInteger('third_session_day')->nullable();
            $table->unsignedInteger('third_session_id')->nullable();
            $table->enum('exam_time', [1,2,3,4])->nullable();
            $table->date('exam_date')->nullable();
            $table->unsignedInteger('remainingCap');
            $table->unsignedInteger('boysCount');
            $table->unsignedInteger('girlsCount');
            $table->boolean('allowedGender')->nullable();
            $table->boolean('status15');
            $table->boolean('status17');
            $table->unsignedInteger('venue_id');
            $table->unsignedInteger('fromYear');
            $table->unsignedInteger('toYear');
            $table->string('field')->nullable();
            $table->timestamps();

            $table->unique(['course_id', 'code', 'teacher_id']);

            $table->foreign('course_id')
                ->references('id')->on('courses')
                ->onDelete('cascade');

            $table->foreign('teacher_id')
                ->references('id')->on('teachers')
                ->onDelete('cascade');

            $table->foreign('venue_id')
                ->references('id')->on('venues')
                ->onDelete('cascade');

            $table->foreign('first_session_id')
                ->references('id')->on('sessions')
                ->onDelete('cascade');

            $table->foreign('second_session_id')
                ->references('id')->on('sessions')
                ->onDelete('cascade');

            $table->foreign('third_session_id')
                ->references('id')->on('sessions')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
