<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->text('payload'); // Session data
            $table->integer('last_activity')->index(); // Last activity timestamp
            $table->unsignedBigInteger('user_id')->nullable(); // User ID column
            $table->string('ip_address')->nullable(); // IP Address column
            $table->string('user_agent')->nullable(); // User Agent column
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}