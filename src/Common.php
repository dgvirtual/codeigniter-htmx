<?php

use CodeIgniter\Config\Services;
use CodeIgniter\Config\View;

if (!function_exists('view_fragment')) {
    /**
     * Grabs the current RendererInterface-compatible class
     * and tells it to render the specified view fragments.
     * Simply provides a convenience method that can be used
     * in Controllers, libraries, and routed closures.
     *
     * NOTE: Does not provide any escaping of the data, so that must
     * all be handled manually by the developer.
     *
     * @param array $options Options for saveData or third-party extensions.
     * @param string|array $fragments // downgrade to php 7.4
     */
    function view_fragment(string $name, $fragments, array $data = [], array $options = []): string
    {
        $renderer = Services::renderer();

        /** @var View $config */
        $config   = config(View::class);
        $saveData = $config->saveData;

        if (array_key_exists('saveData', $options)) {
            $saveData = (bool) $options['saveData'];
            unset($options['saveData']);
        }

        $options['fragments'] = is_string($fragments)
            ? array_map('trim', explode(',', $fragments))
            : $fragments;

        return $renderer->setData($data, 'raw')->render($name, $options, $saveData);
    }
}

if (!function_exists('str_contains')) {
    /**
     * Replacement for a corresponding PHP8 function
     * Checks if $needle is found in $haystack and returns a
     * boolean value (true/false) whether or not the $needle was found.
     *
     * @param string $haystack the string to search in
     * @param string $needle what we are looking for
     */
    function str_contains(string $haystack, string $needle): bool
    {
        return empty($needle) || strpos($haystack, $needle) !== false;
    }
}
