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
        Schema::create('therapists', function (Blueprint $table) {
            $table->id('therapist_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->string('Full_name')->nullable();
            // $table->string('onlinelink')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('Location')->nullable();
            $table->string('profile_img')->nullable();
            $table->string('bachelors')->nullable();
            $table->string('specialization')->nullable();
            $table->enum('status',['approved','rejected','pending'])->default('pending');
            $table->LongText('bio')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('therapists');
    }
};
