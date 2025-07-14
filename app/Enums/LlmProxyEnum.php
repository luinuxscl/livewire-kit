<?php

namespace App\Enums;

enum LlmProxyEnum: string
{
    case OPENROUTER = 'openrouter';
    case TOGETHER = 'together';
    case REPLICATE = 'replicate';
    case HUGGINGFACE = 'huggingface';
    case ANYSCALE = 'anyscale';
    case FIREWORKS = 'fireworks';

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
            $options[$case->value] = $case->label();
        }
        return $options;
    }

    /**
     * Get the display label for the proxy.
     */
    public function label(): string
    {
        return match ($this) {
            self::OPENROUTER => 'OpenRouter',
            self::TOGETHER => 'Together AI',
            self::REPLICATE => 'Replicate',
            self::HUGGINGFACE => 'Hugging Face',
            self::ANYSCALE => 'Anyscale',
            self::FIREWORKS => 'Fireworks AI',
        };
    }

    /**
     * Get the website URL for the proxy.
     */
    public function websiteUrl(): string
    {
        return match ($this) {
            self::OPENROUTER => 'https://openrouter.ai',
            self::TOGETHER => 'https://together.ai',
            self::REPLICATE => 'https://replicate.com',
            self::HUGGINGFACE => 'https://huggingface.co',
            self::ANYSCALE => 'https://anyscale.com',
            self::FIREWORKS => 'https://fireworks.ai',
        };
    }

    /**
     * Get the supported task types for this proxy.
     */
    public function supportedTaskTypes(): array
    {
        return match ($this) {
            self::OPENROUTER => ['text'],
            self::TOGETHER => ['text', 'image'],
            self::REPLICATE => ['text', 'image', 'audio', 'video'],
            self::HUGGINGFACE => ['text', 'image', 'audio', 'embedding'],
            self::ANYSCALE => ['text'],
            self::FIREWORKS => ['text'],
        };
    }
}