<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('status')->default('Pending')->after('notes');
        });

        Schema::table('quotes', function (Blueprint $table) {
            $table->decimal('price_quote', 10, 2)->nullable()->after('selected_materials');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('status');
        });

        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn('price_quote');
        });
    }
};
