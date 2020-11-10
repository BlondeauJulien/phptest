<?php
namespace App;

use \Exception;

/* use \PDO; */

class PaginatedQuery {

  private $query;
  private $queryCount;
  private $classMapping;
  private $pdo;
  private $perPage;

  public function __contruct(
    string $query,
    string $queryCount,
    string $classMapping,
    ?\PDO $pdo = null,
    int $perPage = 12
  )
  {

    $this->query = $query;
    $this->queryCount = $queryCount;
    $this->classMapping = $classMapping;
    $this->pdo = $pdo ?: Connection::getPDO();
    dd($pdo);
    $this->perPage = $perPage;

  }

  public function getItems(): array 
  {
    $currentPage = URL::getPositiveInt('page', 1);
    dd($this->pdo);
    $count = (int)$this->pdo;
/*     ->query($this->queryCount)
    ->fetch(PDO::FETCH_NUM)[0]; */
    
    $pages = ceil($count / $this->perPage);
    if($currentPage > $pages) {
      throw new Exception('Cette page n\'existe pas');
    }
    $offset = $this->perPage * ($currentPage - 1);
    return $this->pdo->query($this->query . " LIMIT $this->perPage OFFSET $offset")
      ->fetchAll(\PDO::FETCH_CLASS,$this->classMapping);
  }

}