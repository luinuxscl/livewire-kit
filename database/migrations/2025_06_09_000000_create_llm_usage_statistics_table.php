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
        Schema::create('llm_usage_statistics', function (Blueprint $table) {
            $table->id();
            $table->morphs('usable'); // Creates usable_id and usable_type
            $table->enum('provider', LlmProviderEnum::values());
            $table->string('model');
            $table->enum('proxy', LlmProxyEnum::values())->nullable();
            $table->enum('task_type', LlmTaskTypeEnum::values())->default(LlmTaskTypeEnum::TEXT->value);
            $table->unsignedInteger('prompt_tokens')->default(0);
            $table->unsignedInteger('completion_tokens')->default(0);
            $table->unsignedInteger('total_tokens')->default(0);
            $table->decimal('cost', 15, 10)->default(0);
            $table->decimal('amount_in_usd', 10, 2)->default(0);
            $table->decimal('amount_in_clp', 10, 2)->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();

            // Índices
            $table->index(['provider', 'model', 'proxy']);
            $table->index(['provider', 'task_type']);
            $table->index(['proxy']);
            $table->index('task_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('llm_usage_statistics');
    }
};