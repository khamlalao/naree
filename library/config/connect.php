<?php
  if ($config["driver"] == "mssql") {
    $db = ADONewConnection($config["driver"]);
    $db->Connect($config["host"], $config["dbuser"], $config["dbpassword"], $config["dbname"]);
  } else { // Default $config["driver"] == "mysql" or "mysqli"
    // URL-encode password to handle special characters
    $encodedPassword = urlencode($config["dbpassword"]);
    $dsn = "{$config["driver"]}://{$config["dbuser"]}:{$encodedPassword}@{$config["host"]}/{$config["dbname"]}?persist&port={$config["port"]}";
    $db = ADONewConnection($dsn);
    if ($config["utf8"]) @$db->Execute("SET NAMES utf8");
  }
  $db->SetFetchMode(ADODB_FETCH_BOTH);
  $db->autoRollback = true; // default is false
  $db->debug = $config["debug"]; // default is false
  ADOdb_Active_Record::SetDatabaseAdapter($db);
  if (!$db) die("Connection failed");
  $ADODB_CACHE_DIR = "cache";
  
?>