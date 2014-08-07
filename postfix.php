#!/usr/bin/php
<?php
require_once 'autoload.php';
require_once 'includes/constants.php';
require_once 'includes/globals.php';


$stream=fopen('php://stdin','r');
//$stream=fopen('test.f','r');
fgets($stream);//drop the first line
$raw_email='';
while(!feof($stream)){
	$raw_email.=fgets($stream);
}
fclose($stream);

$zf_msg=Zend\Mail\Message::fromString($raw_email);

$test=fopen('/tmp/postfixtest','a');
ob_start();
var_dump($zf_msg->getFrom());
$from=ob_get_contents();
ob_end_clean();
fwrite($test,$from);
fclose($test);

?>
