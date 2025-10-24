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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->foreignId('unit_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('arabic_name')->nullable();
            $table->string('code')->unique();
            $table->string('description')->nullable();
            $table->decimal('sale_price', 15, 2)->nullable();
            $table->decimal('pruchase_price', 15, 2)->nullable();
            $table->boolean('is_taxable')->default(false);
            $table->decimal('tax_rate', 10, 2)->nullable();
            $table->decimal('minimum_stock_level', 15, 2)->nullable();
            $table->decimal('maximum_stock_level', 15, 2)->nullable();
            $table->decimal('mrp', 15, 2)->nullable();
            $table->boolean('is_multi_unit')->default(false);
            $table->json('multi_units')->nullable();
            $table->text('remarks')->nullable();
            $table->text('element_used')->nullable();
            $table->string('hsnCode')->nullable();
            $table->decimal('avg_quantity', 15, 2)->nullable();
            $table->boolean('low_stock_alert')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
