<?php

if (!function_exists('vite_asset')) {
    function vite_asset($entry): string
    {
        $manifestPath = public_path('build/manifest.json');

        if (!file_exists($manifestPath)) {
            return '';
        }

        $manifest = json_decode(file_get_contents($manifestPath), true);

        if (!isset($manifest[$entry])) {
            return '';
        }

        return '/build/' . $manifest[$entry]['file'];
    }
}
