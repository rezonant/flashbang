<?php

require_once dirname(__FILE__).'/vendor/autoload.php';
$autoloader = new \Gleez\Loader\Autoloader();
$autoloader->setNamespaces('Flashbang', dirname(__FILE__).'/src/Flashbang');
$autoloader->register();