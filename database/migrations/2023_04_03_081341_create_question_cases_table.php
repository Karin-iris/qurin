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
        Schema::create('question_cases', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(true);
            $table->text('topic');
            $table->text('text');
            $table->boolean('is_request')->default('0');
            $table->boolean('is_remand')->default('0');
            $table->boolean('is_approve')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_cases');
    }
};
