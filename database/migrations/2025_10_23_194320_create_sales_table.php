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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('bill_number');
            $table->date('date');
            $table->text('narration')->nullable();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->string('type')->default('credit');
            $table->string('po_eference')->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('dn_reference')->nullable();
            $table->date('due_date')->nullable();
            // $table->string('currency')
            $table->boolean('is_vat')->default(true);
            $table->string('payment_terms')->nullable();
            $table->string('invoice_period')->nullable();
            $table->string('project_reference')->nullable();
            $table->decimal('total_product_discount')->default(0.00);
            $table->decimal('total_cash_discount')->default(0.00);
            $table->json('products');
            $table->string('file')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
