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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointment_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 
            $table->enum('status',['accepted','rejected','pending'])->default('pending');
            $table->string('time')->nullable();
            $table->string('student_email')->nullable();
            $table->string('appointment_date')->nullable();
            $table->string('location')->nullable();
            $table->string('onlinelink')->nullable();
            $table->LongText('issue')->nullable();
            $table->LongText('rejectionreason')->nullable();
            $table->unsignedBigInteger('Therapists_id'); 
            $table->foreign('Therapists_id')->references('user_id')->on('therapists')->onDelete('cascade'); 
            $table->timestamps();
        });
    }
   
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
// php artisan migrate