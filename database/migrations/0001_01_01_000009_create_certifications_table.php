<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();  // Primary key for certifications
            $table->unsignedBigInteger('employee_id');
            $table->string('certificate_number')->unique();
            $table->unsignedBigInteger('course_id');
            $table->string('issued_by')->nullable();
            $table->date('issued_date');
            $table->timestamps();

            // Reference the users table instead of a separate employees table
            $table->foreign('employee_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};


