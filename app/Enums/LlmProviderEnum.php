<?php

namespace App\Enums;

enum LlmProviderEnum: string
{
    case OPENAI = 'OpenAI';
    case ANTHROPIC = 'Anthropic';
    case GOOGLE = 'Google';
    case META = 'Meta';
    case STABILITY = 'Stability';
    case MIDJOURNEY = 'Midjourney';
    case MISTRAL = 'Mistral';
    case COHERE = 'Cohere';
    case PERPLEXITY = 'Perplexity';
    case GROQ = 'Groq';
    case XAI = 'xAI';
    case DEEPSEEK = 'DeepSeek';

    /**
     * Get all enum values.
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Get all enum names and values as an associative array.
     */
    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[$case->value] = $case->value;
        }
        return $options;
    }

    /**
     * Get the display label for the provider.
     */
    public function label(): string
    {
        return match ($this) {
            self::OPENAI => 'OpenAI',
            self::ANTHROPIC => 'Anthropic',
            self::GOOGLE => 'Google',
            self::META => 'Meta',
            self::STABILITY => 'Stability AI',
            self::MIDJOURNEY => 'Midjourney',
            self::MISTRAL => 'Mistral AI',
            self::COHERE => 'Cohere',
            self::PERPLEXITY => 'Perplexity',
            self::GROQ => 'Groq',
            self::XAI => 'xAI',
            self::DEEPSEEK => 'DeepSeek',
        };
    }

    /**
     * Get the primary task types this provider is known for.
     */
    public function primaryTaskTypes(): array
    {
        return match ($this) {
            self::OPENAI => ['text', 'image', 'audio'],
            self::ANTHROPIC => ['text'],
            self::GOOGLE => ['text', 'image'],
            self::META => ['text'],
            self::STABILITY => ['image'],
            self::MIDJOURNEY => ['image'],
            self::MISTRAL => ['text'],
            self::COHERE => ['text', 'embedding'],
            self::PERPLEXITY => ['text'],
            self::GROQ => ['text'],
            self::XAI => ['text'],
            self::DEEPSEEK => ['text'],
        };
    }

    /**
     * Get the website URL for the provider.
     */
    public function websiteUrl(): string
    {
        return match ($this) {
            self::OPENAI => 'https://openai.com',
            self::ANTHROPIC => 'https://anthropic.com',
            self::GOOGLE => 'https://cloud.google.com/ai',
            self::META => 'https://llama.meta.com',
            self::STABILITY => 'https://stability.ai',
            self::MIDJOURNEY => 'https://midjourney.com',
            self::MISTRAL => 'https://mistral.ai',
            self::COHERE => 'https://cohere.com',
            self::PERPLEXITY => 'https://perplexity.ai',
            self::GROQ => 'https://groq.com',
            self::XAI => 'https://x.ai',
            self::DEEPSEEK => 'https://deepseek.com',
        };
    }
}