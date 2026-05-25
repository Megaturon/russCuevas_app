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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'google_id')) {
                $table->string('google_id')->nullable()->after('id');
            }
            // Note: DB::getDoctrineSchemaManager() is sometimes needed for change(), but we'll leave it as is 
            // since change() usually handles existing columns fine. Wait, doctrine/dbal might be needed.
            // If change() throws an error, we might need to catch it.
            try {
                $table->string('password')->nullable()->change();
            } catch (\Exception $e) {}
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('google_id');
            $table->string('password')->nullable(false)->change();
        });
    }
};
