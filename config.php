<?php

/**
 * Database config
 */

$host       = "localhost";
$username   = "uun8ytxyy7jc8";
$password   = "act688688";
$dbname     = "dba4pndfrv44dy";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );
/* Attempt to connect to MySQL database */
try{
    $pdo_connection = new PDO($dsn, $username, $password, $options);
  } catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
  }
?>