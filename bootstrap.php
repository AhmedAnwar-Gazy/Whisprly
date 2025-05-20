<?php
use core\Container;
use core\Database;
use core\App ;

$container = new Container();

$container->bind('core\Database', function(){
    $config = require "config.php";
    dd($config['database']);
    return new Database($config['database']);
    
});

App::setContainer($container);