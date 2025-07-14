<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\LlmProviderEnum;
use App\Enums\LlmProxyEnum;
use App\Enums\LlmTaskTypeEnum;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('llm_usage_statistics', function (Blueprint $table) {
            // Cambiar provider a enum
            $table->enum('provider', LlmProviderEnum::values())->change();
            
            // Agregar nuevos campos
            $table->enum('proxy', LlmProxyEnum::values())->nullable()->after('model');
            $table->enum('task_type', LlmTaskTypeEnum::values())
                  ->default(LlmTaskTypeEnum::TEXT->value)->after('proxy');
            $table->json('metadata')->nullable()->after('amount_in_clp');
            
            // Índices
            $table->index(['provider', 'model', 'proxy']);
            $table->index(['provider', 'task_type']);
            $table->index(['proxy']);
            $table->index('task_type');
        });
    }

    public function down(): void
    {
        Schema::table('llm_usage_statistics', function (Blueprint $table) {
            $table->dropColumn(['proxy', 'task_type', 'metadata']);
        });
    }
};