<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->text('case_text')->after('topic')->nullable();
            $table->boolean('is_case')->after('case_text')->nullable();
            $table->boolean('is_default')->after('is_default')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn('case_text');
            $table->dropColumn('is_case');
            $table->dropColumn('is_default');
        });
    }
};
