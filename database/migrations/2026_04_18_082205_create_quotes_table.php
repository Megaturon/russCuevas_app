<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('service_type');
            $table->text('details');
            $table->text('selected_materials')->nullable();
            
            $table->decimal('price_quote', 10, 2)->nullable();
            $table->decimal('amount_paid', 10, 2)->default(0.00);
            $table->string('status')->nullable()->default('Pending'); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
