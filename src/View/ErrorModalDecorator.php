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
            && self::str_contains($html, '</body>')
            && ! self::str_contains($html, 'id="htmxErrorModalScript"')
        ) {
            $script = <<<'EOM'
                <script id="htmxErrorModalScript">
                    document.addEventListener("htmx:responseError", function (event) {
                        const xhr = event.detail.xhr;

                        event.stopPropagation();

                        // Create modal
                        const htmxErrorModal = document.createElement('div');
                        htmxErrorModal.id = 'htmxErrorModal'
                        // Set title
                        const htmxErrorModalTitle = document.createElement('h2');
                        const htmxErrorModalTitleContent = document.createTextNode('Error: ' + xhr.status);
                        htmxErrorModalTitle.appendChild(htmxErrorModalTitleContent);

                        // Set close buton
                        const htmxErrorModalCloseButton = document.createElement('button');
                        const htmxErrorModalCloseButtonContent = document.createTextNode('X');
                        htmxErrorModalCloseButton.appendChild(htmxErrorModalCloseButtonContent);
                        htmxErrorModalCloseButton.id = 'htmxErrorModalCloseButton';

                        // Set error content
                        const htmxErrorModalContent = document.createElement('textarea');
                        htmxErrorModalContent.innerHTML = xhr.response;

                        // Set styles
                        htmxErrorModal.setAttribute('style', 'position: absolute; max-width: 90%; left: 50%; transform: translateX(-50%); z-index: 99999; background: #fbe0e0; padding: 20px; border-radius: 5px; font-family: sans-serif; top: 50px;');
                        htmxErrorModalTitle.setAttribute('style', 'display: inline-block;')
                        htmxErrorModalCloseButton.setAttribute('style', 'border: 1px solid; padding: 5px 8px 3px 8px; display: inline-block; float: right;');
                        htmxErrorModalContent.setAttribute('style', 'border: 1px solid #ccc; width: 80vw; height: 80vh');

                        // Append content to modal
                        htmxErrorModal.appendChild(htmxErrorModalTitle);
                        htmxErrorModal.appendChild(htmxErrorModalCloseButton);
                        htmxErrorModal.appendChild(htmxErrorModalContent);

                        // Add modal to DOM
                        document.body.appendChild(htmxErrorModal);

                        // Handle close button
                        htmxErrorModalCloseButton.onclick = function remove() {
                            htmxErrorModal.parentElement.removeChild(htmxErrorModal);
                        }
                    });
                </script>
                EOM;

            $html = preg_replace(
                '/<\/body>/',
                $script . '</body>',
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
