<?php

if (!function_exists('admin_url')) {
    function admin_url(string $prefix = 'admin'): string
    {
        return implode('.', [
            $prefix, parse_url(config('app.url'), PHP_URL_HOST),
        ]);
    }
}
