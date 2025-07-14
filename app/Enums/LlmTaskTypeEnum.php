<?php

namespace App\Enums;

enum LlmTaskTypeEnum: string
{
    case TEXT = 'text';
    case IMAGE = 'image';
    case AUDIO = 'audio';
    case VIDEO = 'video';
    case EMBEDDING = 'embedding';
    case MODERATION = 'moderation';
    case FINE_TUNING = 'fine_tuning';

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
     * Get the display label for the task type.
     */
    public function label(): string
    {
        return match ($this) {
            self::TEXT => 'Generación de Texto',
            self::IMAGE => 'Generación de Imágenes',
            self::AUDIO => 'Generación de Audio',
            self::VIDEO => 'Generación de Video',
            self::EMBEDDING => 'Embeddings',
            self::MODERATION => 'Moderación de Contenido',
            self::FINE_TUNING => 'Fine-tuning',
        };
    }

    /**
     * Get the icon for the task type.
     */
    public function icon(): string
    {
        return match ($this) {
            self::TEXT => 'fa-solid fa-text',
            self::IMAGE => 'fa-solid fa-image',
            self::AUDIO => 'fa-solid fa-volume-high',
            self::VIDEO => 'fa-solid fa-video',
            self::EMBEDDING => 'fa-solid fa-vector-square',
            self::MODERATION => 'fa-solid fa-shield-check',
            self::FINE_TUNING => 'fa-solid fa-sliders',
        };
    }

    /**
     * Get the typical units for measuring this task type.
     */
    public function units(): string
    {
        return match ($this) {
            self::TEXT => 'tokens',
            self::IMAGE => 'images',
            self::AUDIO => 'seconds',
            self::VIDEO => 'seconds',
            self::EMBEDDING => 'tokens',
            self::MODERATION => 'requests',
            self::FINE_TUNING => 'tokens',
        };
    }

    /**
     * Check if this task type uses token-based pricing.
     */
    public function usesTokens(): bool
    {
        return in_array($this, [self::TEXT, self::EMBEDDING, self::MODERATION, self::FINE_TUNING]);
    }
}