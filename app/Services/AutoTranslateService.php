<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AutoTranslateService
{
    public const SUPPORTED_LOCALES = ['en', 'ar', 'fr'];

    public function translateFields(array $fields, ?string $sourceLocale = null): array
    {
        $sourceLocale = $this->normalizeLocale($sourceLocale ?? app()->getLocale());
        $translations = [];

        foreach (self::SUPPORTED_LOCALES as $locale) {
            $translations[$locale] = [];

            foreach ($fields as $field => $value) {
                if ($this->isEmpty($value)) {
                    continue;
                }

                $text = (string) $value;
                $translations[$locale][$field] = $locale === $sourceLocale
                    ? $text
                    : $this->translateText($text, $sourceLocale, $locale);
            }
        }

        return array_filter($translations, fn(array $data) => $data !== []);
    }

    private function translateText(string $text, string $sourceLocale, string $targetLocale): string
    {
        try {
            $response = Http::timeout(8)
                ->retry(1, 200)
                ->get('https://translate.googleapis.com/translate_a/single', [
                    'client' => 'gtx',
                    'sl' => $sourceLocale,
                    'tl' => $targetLocale,
                    'dt' => 't',
                    'q' => $text,
                ]);

            if (!$response->successful()) {
                return $text;
            }

            $body = $response->json();

            if (!is_array($body) || !isset($body[0]) || !is_array($body[0])) {
                return $text;
            }

            $translated = collect($body[0])
                ->filter(fn($part) => is_array($part) && isset($part[0]))
                ->pluck(0)
                ->implode('');

            return trim($translated) !== '' ? $translated : $text;
        } catch (\Throwable $e) {
            Log::warning('Auto translation failed', [
                'source' => $sourceLocale,
                'target' => $targetLocale,
                'message' => $e->getMessage(),
            ]);

            return $text;
        }
    }

    private function normalizeLocale(string $locale): string
    {
        $locale = strtolower(str_replace('_', '-', $locale));
        $locale = explode('-', $locale)[0] ?? 'en';

        return in_array($locale, self::SUPPORTED_LOCALES, true) ? $locale : 'en';
    }

    private function isEmpty(mixed $value): bool
    {
        return $value === null || trim((string) $value) === '';
    }
}
