# Installation

Currently only manual installation is available.

- [Manual Installation](#manual-installation)

## Manual Installation

In the example below we will assume, that files from this project will be located in `app/ThirdParty/htmx` directory.

Download this project and then enable it by editing the `app/Config/Autoload.php` file and adding the `Michalsn\CodeIgniterHtmx` namespace to the `$psr4` array. You also have to add `Common.php` to the `$files` array, like in the below example:

```php
<?php

...

public $psr4 = [
    APP_NAMESPACE => APPPATH, // For custom app namespace
    'Config'      => APPPATH . 'Config',
    'Michalsn\CodeIgniterHtmx' => APPPATH . 'ThirdParty/htmx/src',
];

...

public $files = [
    APPPATH . 'ThirdParty/htmx/src/Common.php',
];
```


