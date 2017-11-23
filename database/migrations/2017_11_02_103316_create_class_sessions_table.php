<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClassSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('class_sessions', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedInteger('class_id');
        //     $table->unsignedInteger('session_id');
        //     $table->timestamps();

        //     $table->forigen('class_id')->references('id')->on('classes')
        //         ->onDelete('CASCADE');

        //     $table->forigen('session_id')->references('id')->on('sessions')
        //         ->onDelete('RESTRICT');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('class_sessions');
    }
}
