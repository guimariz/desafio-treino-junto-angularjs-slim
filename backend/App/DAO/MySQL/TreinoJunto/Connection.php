<?php

namespace App\DAO\MySQL\TreinoJunto;

abstract class Connection {
  /**
   * @var \PDO
   */
  protected $pdo;

  public function __construct() {
    $host = getenv('TREINO_JUNTO_MYSQL_HOST');
    $port = getenv('TREINO_JUNTO_MYSQL_PORT');
    $user = getenv('TREINO_JUNTO_MYSQL_USER');
    $pass = getenv('TREINO_JUNTO_MYSQL_PASSWORD');
    $dbname= getenv('TREINO_JUNTO_MYSQL_DBNAME');
    
    $dsn = "mysql:host={$host};dbname={$dbname};port={$port}";

    $this->pdo = new \PDO($dsn, $user, $pass);
    $this->pdo->setAttribute(
      \PDO::ATTR_ERRMODE, 
      \PDO::ERRMODE_EXCEPTION 
    );
  }
}
