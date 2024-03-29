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
        Schema::create('answer_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('result_id');
            $table->integer('question_id')->nullable();
            $table->text('text');
            $table->integer('order');
            $table->timestamps();
        }); //
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_questions');//
    }
};
