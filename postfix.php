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
$from=$zf_msg->getFrom()->current()->getEmail();
$to=$zf_msg->getTo()->current()->getEmail();
$subject=$zf_msg->getSubject();
$body=rmTags($zf_msg->getBody());
$command='';
preg_match('/Command=([a-z]*)/',$body,$c_match);
if(count($c_match)>0){
	$command=$c_match[1];
}
if($command!==''){
}
fwrite($test,"\n".$subject.' '.$from.' '.$to.' '.date('Y-m-d H:i:s'));
fclose($test);

function rmTags($str){
	return preg_replace('/<[^<>]*>/','',$str);
}

?>
