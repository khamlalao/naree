<?php

ini_set("display_errors", "1");
error_reporting(E_ALL);
// Suppress deprecation warnings from old ADOdb library
error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING);
date_default_timezone_set("Asia/Bangkok");
ini_set("date.timezone", "Asia/Bangkok");

// config database

$config["driver"] = "mysqli";

$config["dbname"] = "dbnaree"; 

$config["host"] = "127.0.0.1"; 

$config["port"] = "3308";

$config["dbuser"] = "root";  

$config["dbpassword"] = ""; 

//$config["mysql"] = 5;

$config["utf8"] = true;

$config["debug"] = false; // default is false

// config site

$config["website"] = "https://www.naree.co";

$config["basesite"] = "https://www.naree.co/";

// config tinycme upload path

$config["tinymceadmpath"] = "https://www.naree.co/uploads/tinymce/";

$config["tinymcewebpath"] = "uploads/tinymce/";

$config["imagesadmpath"] = "https://www.naree.co/images/";

$config["imageswebpath"] = "images/";

$config["encodingprogram"] = "utf-8";

$config["encodingdb"] = "utf-8";

// config logs

$config["log_size"] = 10240; // size of logs record

$config["log_time"] = "-3 month"; // time in strtotime format eg. "-3 month"

?>

