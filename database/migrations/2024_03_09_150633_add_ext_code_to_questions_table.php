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
        Schema::table('questions', function (Blueprint $table) {
            $table->string('ext_code_1',128)->after('quiz_id')->nullable();
            $table->string('ext_code_2',128)->after('ext_code_1')->nullable();
            $table->string('ext_code_3',128)->after('ext_code_2')->nullable();//
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn('ext_code_1');//
            $table->dropColumn('ext_code_2');//
            $table->dropColumn('ext_code_3');//
        });
    }
};
