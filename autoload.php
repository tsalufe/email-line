<?php

require_once 'includes/constants.php';

require_once 'Zend/Loader/StandardAutoloader.php';
$loader=new Zend\Loader\StandardAutoloader(array('autoregister_zf'=>true));
$loader->registerNamespaces(array(
		'EmailLine\User'=>'src/EmailLine/User',
		'EmailLine\Test'=>'src/EmailLine/Test',
	));
$loader->register();
