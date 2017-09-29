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

            $table->unsignedTinyInteger('code');
            $table->string('first_session');
            $table->string('second_session');
            $table->string('third_session');
            $table->enum('exam_time', [1,2,3,4]);
            $table->date('exam_date');
            $table->unsignedTinyInteger('remainingCap');
            $table->unsignedTinyInteger('boysCount');
            $table->unsignedTinyInteger('girlsCount');
            $table->enum('allowedGender', [0,1,null]);
            $table->boolean('status15');
            $table->boolean('status17');
            $table->string('place');
            $table->unsignedInteger('fromYear');
            $table->unsignedInteger('toYear');
            $table->string('field');

            $table->timestamps();

            $table->unique(['course_id', 'code']);
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
