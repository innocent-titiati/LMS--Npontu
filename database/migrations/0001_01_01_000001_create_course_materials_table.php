<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('course_materials', function (Blueprint $table) {
           
             // Link to a specific course
            $table->foreignId('course_id')
                    ->constrained('courses')
                    ->onDelete('cascade');

       // Optionally link to a specific module (nullable if some materials are for the whole course)
            $table->foreignId('module_id')
                    ->nullable()
                    ->constrained('modules')
                    ->onDelete('cascade');

       // Basic info about the material
            $table->string('material_type'); // pdf, video, slide
            $table->string('file_path');
            $table->unsignedBigInteger('uploaded_by');
            $table->enum('status', ['pending', 'approved'])->default('pending');
            $table->timestamps();
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            $table->foreign('uploaded_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_materials');
    }
};

