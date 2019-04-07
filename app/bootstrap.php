<?php
    //Load Config
    require_once 'config/config.php';

    //Autoload Core Libraries - Any new libraries added to this directory will be automatically loaded.
    spl_autoload_register(function($className) {
        require_once 'libraries/' . $className . '.php';
    });