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
            $table->decimal('amount_paid', 10, 2)->default(0)->after('price_quote');
            $table->decimal('deposit_percentage', 5, 2)->default(50.00)->after('amount_paid');
            $table->string('payment_type')->nullable()->after('deposit_percentage'); // 'deposit' or 'full'
            $table->timestamp('paid_at')->nullable()->after('payment_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->dropColumn(['amount_paid', 'deposit_percentage', 'payment_type', 'paid_at']);
        });
    }
};
