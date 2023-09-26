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
        Schema::create('experts', function (Blueprint $table) {
            $table->id('exp_id');
          
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); 

            $table->unsignedBigInteger('rules_id');
            $table->foreign('rules_id')->references('Rule_id')->on('rules')->onDelete('cascade');  

            $table->unsignedBigInteger('recommend_id'); 
            $table->foreign('recommend_id')->references('Recommendations_id')->on('recommendations')->onDelete('cascade'); 

            $table->string('LSAS_score')->nullable();
            $table->string('fear_level')->nullable();
            $table->string('avoidance_level')->nullable();
            $table->string('socialanxiety_level')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experts');
    }
};
