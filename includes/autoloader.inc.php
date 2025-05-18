<?php

spl_autoload_register('class_autoloader');

function class_autoloader($class_name) {
    $base_dir = __DIR__ . '/../classes/';

    $file = $base_dir . str_replace('\\', '/', $class_name) . '.class.php';

    if (file_exists($file)) {
        require $file;
    }
}