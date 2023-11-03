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
        Schema::create('choosetherapists', function (Blueprint $table) {
            $table->id('ChooseID');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('therapist_id');
            
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')->references('therapist_id')->on('therapists')->onDelete('cascade');

            $table->foreign('therapist_id')->references('user_id')->on('therapists')->onDelete('cascade');
            $table->string('therapist_fullname')->nullable();
            $table->string('student_fullname')->nullable();
            $table->enum('selection_status',['selected','deselected'])->default('selected');
            $table->enum('application_status',['accepted','rejected','pending'])->default('pending');
         
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choosetherapists');
    }
};
