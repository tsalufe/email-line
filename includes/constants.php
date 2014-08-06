<?php
require_once 'local.ignore';

define('BASEDIR',realpath(dirname(__FILE__).'/..'));

define('DB_SERVER','localhost');
define('DB_USER','email-line');
define('DB_PASSWORD',HIDDEN_PASSWORD);
define('DB_NAME','emailline');

if(!isset($EMAILLINE_PDO)) $EMAILLINE_PDO=new PDO('mysql:host=localhost;dbname='.DB_NAME,DB_USER,DB_PASSWORD);
