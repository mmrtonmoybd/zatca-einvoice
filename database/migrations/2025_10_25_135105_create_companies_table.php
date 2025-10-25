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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('arabic_name');
            $table->string('address');
            $table->string('arabic_address');
            $table->string('vat_number');
            $table->string('arabic_vat_number');
            $table->string('cr_no');
            $table->string('arabic_cr_no');
            
            // Bank Details 
            $table->string('bank_name')->nullable();
            $table->string('arabic_bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('arabic_bank_account_number')->nullable();
            $table->string('iban')->nullable();
            $table->string('arabic_iban')->nullable();
            $table->string('bank_swift_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
