<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('twoFA_code')->nullable();//new column added
            $table->boolean('twoFA_enabled')->default(true);
            $table->boolean('twoFA_verified')->default(false);
            $table->string('phone')->unique()->nullable();
            $table->enum('role',['student','therapist','admin'])->default('student');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
