<?php
/* Defines the autoload function */
spl_autoload_register(function($class) {
    $tab    = explode('\\', $class);
    $path   = implode('/', $tab) . '.class.php';
    $path   = $_SERVER['DOCUMENT_ROOT'] . "/jos/" . $path;
    if(file_exists($path))
    {
        include_once($path);
        return true;
    }
    throw new \Exception('Cannot load : ' . $class);
});
?>