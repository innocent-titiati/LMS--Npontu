<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseModuleTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('course_module', function (Blueprint $table) {
            // Assuming courses table has a primary key "course_id" (unsignedBigInteger)
            $table->unsignedBigInteger('course_id');
            // And modules table has a primary key "module_id" (unsignedBigInteger)
            $table->unsignedBigInteger('module_id');

            // Set composite primary key
            $table->primary(['course_id', 'module_id']);

            // Foreign key constraints
            $table->foreign('course_id')
                  ->references('course_id')
                  ->on('courses')
                  ->onDelete('cascade');

            $table->foreign('module_id')
                  ->references('module_id')
                  ->on('modules')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('course_module');
    }
}



