<?php

require_once 'includes/constants.php';

require_once 'Zend/Loader/StandardAutoloader.php';
$loader=new Zend\Loader\StandardAutoloader(array('autoregister_zf'=>true));

$loader->register();
