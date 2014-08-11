#!/usr/bin/php
<?php
require_once 'autoload.php';
require_once 'includes/constants.php';
require_once 'includes/globals.php';


$stream=fopen('php://stdin','r');
//$stream=fopen('test.2','r');
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
$body=$zf_msg->getBody();
$lines=explode("\n",$body);
$num_lines=count($lines);
$i=0;
fwrite($test,$subject.' '.$from.' '.$to.' '.date('Y-m-d H:i:s')."\n");
$commands=array();
while($i<$num_lines&&!preg_match("/^[A-Z][a-z0-9_-]*=[a-zA-Z0-9 ][^\n]*/",$lines[$i])){
	++$i;
}
if($i<$num_lines){
	$cmd=explode('=',$lines[$i]);
	$commands[]=array($cmd[0],$cmd[1]);
	++$i;
	while($i<$num_lines&&preg_match("/^[A-Z][a-z0-9_-]*=[a-zA-Z0-9 ][^\n]*/",$lines[$i])){
		$cmd=explode('=',$lines[$i]);
		$commands[]=array($cmd[0],$cmd[1]);
		++$i;
	}
	ob_start();
	var_dump($commands);
	$cmds=ob_get_contents();
	ob_end_clean();
	fwrite($test,$cmds."\n");
	$sub_wo=getThreadSubject($subject);
	mail($from,'Re:'.$sub_wo,"Your last command was:\n".$cmds,"From:robot@gehwah.com\r\n");
} else{
	$sub_wo=getThreadSubject($subject);
	showManual($from,'Re:'.$sub_wo);
	fwrite($test,"	showing manual\n");
}

fclose($test);

function getThreadSubject($subject){
	$sub_wo=preg_replace('/^Re:/','',$subject);
	while(preg_match('/^Re:/',$sub_wo)) $sub_wo=preg_replace('/^Re:/','',$sub_wo);
	return $sub_wo;
}

function showManual($to,$subj){
	$zf_msg=new Zend\Mail\Message();
	$zf_msg->setSubject($subj);
	$zf_msg->setTo($to);
	$zf_msg->setFrom('robot@gehwah.com');
	$body='';
	$body.="Command=\n".
		"Parameter=\n".
		"\n".
		"Please fill in your values above after = to begin\n";
	$zf_msg->setBody($body);
	mail($to,$subj,$body,"From:robot@gehwah.com\r\n");
}

?>
