<?php
if (!defined("WHMCS"))
    die("This file cannot be accessed directly");

use Illuminate\Database\Capsule\Manager as Capsule;

add_hook('ClientAreaHeadOutput', 1, function($vars) {
    if (\WHMCS\Config\Setting::getValue('FKMBCSTATUS')) {
        return '<meta name="msapplication-TileColor" content="' . \WHMCS\Config\Setting::getValue('FKMBCCOLOR') . '">
    <meta name="theme-color" content="' . \WHMCS\Config\Setting::getValue('FKMBCCOLOR') . '">';
    }
});
