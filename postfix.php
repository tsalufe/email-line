#!/usr/bin/php
<?php
$file = fopen("/tmp/postfixtest", "a");
fwrite($file, "Script successfully ran at ".date("Y-m-d H:i:s")."\n");
fclose($file);
?>
