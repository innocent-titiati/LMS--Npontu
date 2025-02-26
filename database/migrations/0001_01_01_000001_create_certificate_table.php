<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->unsignedBigInteger('employee_id');
            $table->string('certificate_number')->unique();
            $table->unsignedBigInteger('course_id');
            $table->string('Issued_by')->nullable();
            $table->date('issued_date');
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('certifications');
    }
};

