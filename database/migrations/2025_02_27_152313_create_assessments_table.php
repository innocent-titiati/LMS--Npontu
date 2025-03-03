<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_id'); // Foreign key to courses
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('type', ['quiz', 'assignment', 'exam']); // Type of assessment
            $table->integer('total_marks');
            $table->timestamps();

            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('assessments');
    }
};