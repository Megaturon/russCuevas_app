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
        Schema::table('quotes', function (Blueprint $table) {
            $table->string('size')->nullable();
            $table->string('custom_size')->nullable();
            $table->string('custom_service_type')->nullable();
            $table->string('inspiration_image')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn(['size', 'custom_size', 'custom_service_type', 'inspiration_image']);
        });
    }
};
