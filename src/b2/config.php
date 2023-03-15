<?php
$db_host = 'localhost';
$db_name = 'twig';
$db_port = 3306;
$db_user = 'root';
$db_pass = 'Dat422002';

try {
  $db = new PDO("mysql:host=$db_host;dbname=$db_name;port:$db_port", $db_user, $db_pass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}
