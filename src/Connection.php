<?php
namespace App;

use \PDO;

class Connection {

  public static function getPDO (): PDO 
  {
    return new PDO('mysql:dbname=tutoblog;host=127.0.0.1', 'root', 'u9mYNDLGP89TVaYBlvFe', [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);

  }
}