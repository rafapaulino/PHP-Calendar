<?php

namespace Calendar\Traits;

trait ResolvesLocale
{
    /**
     * Resolve current locale based on setlocale()
     * with safe fallback for Intl components
     */
    protected function resolveLocale(): string
    {
        $locale = setlocale(LC_TIME, 0);

        if (!$locale || $locale === 'C') {
            return 'en_US';
        }

        // Remove encoding and variants (.UTF-8, @euro, etc)
        $locale = preg_replace('/[\.@].*/', '', $locale);

        return $locale ?: 'en_US';
    }
}