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
        Schema::table('llm_usage_statistics', function (Blueprint $table) {
            $table->decimal('cost', 15, 10)->nullable()->after('total_tokens');
            $table->decimal('amount_in_usd', 10, 2)->nullable()->after('cost');
            $table->decimal('amount_in_clp', 10, 2)->nullable()->after('amount_in_usd');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('llm_usage_statistics', function (Blueprint $table) {
            $table->dropColumn(['cost', 'amount_in_usd', 'amount_in_clp']);
        });
    }
};
