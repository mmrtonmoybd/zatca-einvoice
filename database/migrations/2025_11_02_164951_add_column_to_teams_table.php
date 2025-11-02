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
        Schema::table('teams', function (Blueprint $table) {
            $table->boolean('is_with_header')->default(false)->after('is_active');
            $table->string('header_bannar')->nullable()->after('is_with_header');
            $table->string('footer_bannar')->nullable()->after('header_bannar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    
    }
};
