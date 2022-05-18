<?php 
include_once('Credentials.php');
try {
    $dbName = Credentials::dbName;
    $con = new PDO("mysql:host=localhost;dbname={$dbName}", Credentials::dbUser, Credentials::dbPass);
}catch(PDOException $e)
{
  echo $e->getMessage();                         
}
?>