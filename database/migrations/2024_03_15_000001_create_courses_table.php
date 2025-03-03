<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('status')->default('active'); // Options: active, completed, draft
            $table->foreignId('instructor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->unsignedBigInteger('manager_id');
            $table->integer('duration')->nullable();
            $table->timestamps();
        });
       
    }

    public function down()
    {       
        Schema::dropIfExists('courses');
    }
};