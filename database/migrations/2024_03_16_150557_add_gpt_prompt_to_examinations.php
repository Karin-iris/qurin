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
        Schema::table('examinations', function (Blueprint $table) {
            $table->text('gpt_prompt')->after('topic')->nullable();
            $table->text('topic')->nullable()->change();
            $table->text('explanation')->after('topic');//
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('examinations', function (Blueprint $table) {
            $table->dropColumn('gpt_prompt');
            $table->dropColumn('explanation');//
        });
    }
};
