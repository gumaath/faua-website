<?php 
try {
    $con = new PDO("mysql:host=localhost;dbname=faua_website", "admin", "merdas123");
    echo "Deu certo!";
}catch(PDOException $e)
{
  echo $e->getMessage();                         
}
?>