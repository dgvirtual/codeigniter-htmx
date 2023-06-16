<?php

namespace Michalsn\CodeIgniterHtmx\View;

use CodeIgniter\View\ViewDecoratorInterface;

class ToolbarDecorator implements ViewDecoratorInterface
{
    public static function decorate(string $html): string
    {
        if (CI_DEBUG
            && (! is_cli() || ENVIRONMENT === 'testing')
            && ! service('request')->isHtmx()
            && self::str_contains($html, '</head>')
            && ! self::str_contains($html, 'id="htmxToolbarScript"')
        ) {
            $script = sprintf(
                '<script %s id="htmxToolbarScript">%s</script>',
                csp_script_nonce(),
                file_get_contents(__DIR__ . '/toolbar_decorator.js')
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

    private static function str_contains(string $haystack, string $needle): bool
    {
        return empty($needle) || strpos($haystack, $needle) !== false;
    }
}
