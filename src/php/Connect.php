<?php

namespace App;

include ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

use App\Credentials;

class Connect
{

  public static function ConnectDB()
  {
    try {
      $dbName = Credentials::dbName;
      return new \PDO("mysql:host=localhost;dbname={$dbName}", Credentials::dbUser, Credentials::dbPass);
    } catch (\PDOException $e) {

      return $e->getMessage();
    }
  }
}
