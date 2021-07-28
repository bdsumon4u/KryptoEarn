<?php

use Illuminate\Support\Facades\Cache;
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
    function ip_info(string $key, string $default = '') {
        $array = cache()->remember('ip_info', 5 * 60, function () {
            return Http::get('http://ip-api.com/json')->json();
        });
        return $key ? data_get($array, $key, $default) : $array;
    }
}

if (!function_exists('select_timezone')) {
    function select_timezone($selected = null): string
    {
        if (!$selected) {
            $selected = ip_info('timezone', 'Asia/Dhaka');
        }
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
        if (!$selected) {
            $selected = ip_info('country', 'Bangladesh');
        }
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

if (!function_exists('last_week_user_transactions')) {
    function last_week_user_transactions(\App\Models\User $user) {
        return Cache::remember('user-'.$user->id.':last_week:transactions', 5, function () use ($user) {
            return $user->transactions()->with('wallet')->where('created_at', '>', now()->subWeek())->latest()->get();
        });
    }
}

if (!function_exists('fill_weekly')) {
    function fill_weekly($records)
    {
        $data = array_fill(now()->subWeek()->day + 1, 7, 0);
        foreach ($data as $day => $count) {
            if (now()->get('day') < 7 && $day > ($prevLastDay = now()->subWeek()->lastOfMonth()->day)) {
                unset($data[$day]);
                $day -= $prevLastDay;
                $data[$day] = 0;
            }
            if ($day === now()->get('day')) {
                $data['Today'] = data_get($records, $day, 0);
                unset($data[$day]);
            } else {
                $data[$day] = data_get($records, $day, 0);
            }
        }

        return $data;
    }
}

if (!function_exists('fill_monthly')) {
    function fill_monthly($records)
    {
        return collect(array_fill(now()->firstOfMonth()->day, now()->lastOfMonth()->day, 0))
            ->mapWithKeys(function ($val, $key) use ($records) {
                return [$key => data_get($records, $key, 0)];
            })
            ->toArray();
    }
}

if (!function_exists('fill_yearly')) {
    function fill_yearly($records)
    {
        $firstOfYear = now()->firstOfYear();
        return collect(array_fill(0, 12, 0))
            ->mapWithKeys(function ($val, $key) use ($firstOfYear, $records) {
                $mon = $firstOfYear->copy()->addMonths($key)->shortMonthName;
                return [$mon => data_get($records, $mon, 0)];
            })
            ->toArray();
    }
}
