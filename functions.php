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
        $array = session()->remember('ip_info', function () {
            return Http::get('http://ip-api.com/json')->json();
        });
        return $key ? data_get($array, $key, $default) : $array;
    }
}
