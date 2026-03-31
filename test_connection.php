<?php
// Test file to check PHP and database connection
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "PHP Version: " . phpversion() . "<br>\n";
echo "Server: " . $_SERVER['SERVER_SOFTWARE'] . "<br>\n";

// Check if mysqli extension is loaded
echo "<br>MySQLi Extension: " . (extension_loaded('mysqli') ? 'LOADED' : 'NOT LOADED') . "<br>\n";

// Test database connection
require_once __DIR__ . "/library/config/config.php";

echo "<br>Database Config:<br>\n";
echo "Host: " . $config["host"] . "<br>\n";
echo "Database: " . $config["dbname"] . "<br>\n";
echo "User: " . $config["dbuser"] . "<br>\n";
echo "Port: " . $config["port"] . "<br>\n";

echo "<br>Attempting connection...<br>\n";

// Use procedural style instead of OOP
$link = @mysqli_connect(
    $config["host"], 
    $config["dbuser"], 
    $config["dbpassword"], 
    $config["dbname"],
    $config["port"]
);

if (!$link) {
    echo "<br><span style='color:red'>Database Connection FAILED!</span><br>\n";
    echo "Error Code: " . mysqli_connect_errno() . "<br>\n";
    echo "Error Message: " . mysqli_connect_error() . "<br>\n";
} else {
    echo "<br><span style='color:green'>Database Connection SUCCESS!</span><br>\n";
    mysqli_close($link);
}

echo "<br>Test completed.<br>\n";
?>
