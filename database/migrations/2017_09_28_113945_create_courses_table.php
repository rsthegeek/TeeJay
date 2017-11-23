<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('code');
            $table->string('title');
            $table->unsignedTinyInteger('practical_unit_count')->default(0);
            $table->unsignedTinyInteger('theoretical_unit_count')->default(0);

            $table->timestamps();

            $table->unique(['code', 'practical_unit_count', 'theoretical_unit_count']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
