<?php
spl_autoload_register(function($class){
    $class = str_replace('\\', '/', $class);
    $classFile = str_replace('docup', 'docup/src', dirname(__DIR__) . '/' . $class . '.php');
    if (file_exists($classFile)) {
        require $classFile;
    }
});