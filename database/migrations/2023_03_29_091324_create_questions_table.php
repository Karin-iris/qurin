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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(true);
            $table->integer('category_id');
            $table->text('topic');
            $table->integer('compitency');
            $table->text('user_name');
            $table->text('text');
            $table->text('correct_choice');
            $table->text('wrong_choice_1');
            $table->text('wrong_choice_2');
            $table->text('wrong_choice_3');
            $table->text('explanation');
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
        Schema::dropIfExists('questions');
    }
};
