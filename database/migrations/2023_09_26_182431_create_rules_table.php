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
        Schema::create('rules', function (Blueprint $table) {
            $table->id('Rule_id');
            $table->string('score_range')->nullable();
            $table->enum('socialanxiety_level',['none','mild','moderate','marked','severe','very_severe'])->default('none');
            $table->timestamps();
        });
    }

    // 0-29 You do not suffer from social
    // anxiety
    // 30-49 Mild social anxiety
    // 50-64 Moderate social anxiety
    // 65-79 Marked social anxiety
    // 80-94 Severe social anxiety
    //  95   Very severe social anxiety




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rules');
    }
};
