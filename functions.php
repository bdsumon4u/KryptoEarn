<?php

use Illuminate\Support\Facades\Http;

if (!function_exists('admin_url')) {
    function admin_url(string $prefix = 'admin'): string
    {
        return implode('.', [
            $prefix, parse_url(config('app.url'), PHP_URL_HOST),
        ]);
    }
}

if (!function_exists('ip_info')) {
    function ip_info(string $key = null, string $default = '')
    {
        $array = Http::get('http://ip-api.com/json')->json();
        return $key ? data_get($array, $key, $default) : $array;
    }
}

if (!function_exists('setting')) {
    function setting(string $group, string $name, $default = null) {
        $setting = collect(config('settings.settings', []))
            ->first(function ($setting) use ($group) {
                return $setting::group() === $group;
            });

        return resolve($setting)->$name ?: $default;
    }
}
