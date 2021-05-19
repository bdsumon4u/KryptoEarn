<?php

if (!function_exists('admin_url')) {
    function admin_url(string $prefix = 'admin'): string
    {
        return implode('.', [
            $prefix, parse_url(config('app.url'), PHP_URL_HOST),
        ]);
    }
}

if (!function_exists('select_timezone')) {
    function select_timezone($selected = null): string
    {
        return collect(timezone_identifiers_list())
            ->map(function ($row) use ($selected) {
                return '<option value="'.$row.'" ' . ($row === $selected ? 'selected' : '') . '>'.$row.'</option>';
            })
            ->implode("\n");
    }
}

if (!function_exists('select_country')) {
    function select_country($selected = null): string
    {
        return collect(config('country'))
            ->map(function ($row) use ($selected) {
                return '<option value="'.$row.'" ' . ($row === $selected ? 'selected' : '') . '>'.$row.'</option>';
            })
            ->implode("\n");
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
