<?php
// Suppress PHP 8 deprecation warnings for legacy ADOdb library
// Change to E_ALL for full debugging
error_reporting(E_ALL & ~E_DEPRECATED);
ini_set("display_errors", "0");

define("DIR",str_replace("\\", "/", dirname(__FILE__))."/../../");
?>