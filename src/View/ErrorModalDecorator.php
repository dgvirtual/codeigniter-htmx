<?php

namespace Michalsn\CodeIgniterHtmx\View;

use CodeIgniter\View\ViewDecoratorInterface;

class ErrorModalDecorator implements ViewDecoratorInterface
{
    public static function decorate(string $html): string
    {

        if (
            CI_DEBUG
            && (! is_cli() || ENVIRONMENT === 'testing')
            && ! service('request')->isHtmx()

            && self::str_contains($html, '</head>')
            && ! self::str_contains($html, 'id="htmxErrorModalScript"')
        ) {
            $script = sprintf(
                '<script %s id="htmxErrorModalScript">%s</script>',
                csp_script_nonce(),
                file_get_contents(__DIR__ . '/error_modal_decorator.js')
            );

            $html = preg_replace(
                '/<\/head>/',
                $script . '</head>',
                $html,
                1
            );
        }

        return $html;
    }

    // fallback for php 7.4
    //strangely enough, defining this inside the above function would trigger an error
    /**
     * See https://www.php.net/manual/en/function.str-contains.php#126277
     */

    private static function str_contains(string $haystack, string $needle): bool
    {
        return empty($needle) || strpos($haystack, $needle) !== false;
    }
}
