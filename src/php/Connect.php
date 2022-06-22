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
      return new \PDO("mysql:host=localhost;dbname={$dbName};charset=utf8", Credentials::dbUser, Credentials::dbPass, array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    } catch (\PDOException $e) {

      return $e->getMessage();
    }
  }
}
