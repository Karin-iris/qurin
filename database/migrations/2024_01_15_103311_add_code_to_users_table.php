<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('code')->nullable()->after('email');
        });
        $rows = DB::table('users')->select('id', 'email')->get();
        foreach ($rows as $row) {
            DB::table('users')
                ->where('id', $row->id)
                ->update(['code' => $row->email]);
        }
        Schema::table('users', function (Blueprint $table) {
            $table->unique('code');
            $table->dropUnique('users_email_unique');
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->string('code')->nullable()->after('email');
        });
        $rows = DB::table('admins')->select('id', 'email')->get();
        foreach ($rows as $row) {
            DB::table('admins')
                ->where('id', $row->id)
                ->update(['code' => $row->email]);
        }
        Schema::table('admins', function (Blueprint $table) {
            $table->unique('code');
            $table->dropUnique('admins_email_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('code');//
        });
        Schema::table('admins', function (Blueprint $table) {
            $table->dropColumn('code');//
        });
    }
};
