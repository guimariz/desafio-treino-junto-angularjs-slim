<?php 

namespace App\DAO\MySQL\TreinoJunto;

use App\Models\MySQL\TreinoJunto\ClientModel;

class ClientsDAO extends Connection {
  public function __construct() {
    parent::__construct();
  }

  public function getAllClients(): array {
    $clients = $this->pdo
      ->query('
      SELECT * FROM tbl_client;
      ')
      ->fetchAll(\PDO::FETCH_ASSOC);
    return $clients;
  }
  
  public function insertClient(ClientModel $client): void {
    $statement = $this->pdo
      ->prepare("
      INSERT INTO tbl_client 
        (name, cep, bairro, cidade, estado, logradouro, numero, cpf) VALUES 
        (:name, :cep, :bairro, :cidade, :estado, :logradouro, :numero, :cpf);
      ");
      $statement->execute([
        'name' => $client->getName(),
        'cep' => $client->getCep(),
        'bairro' => $client->getBairro(),
        'cidade' => $client->getCidade(),
        'estado' => $client->getEstado(),
        'logradouro' => $client->getLogradouro(),
        'numero' => $client->getNumero(),
        'cpf' => $client->getCpf(),
      ]);
  }

  public function updateClient(ClientModel $client): void
  {
      $statement = $this->pdo
          ->prepare("
          UPDATE tbl_client 
          SET name = :name, cep = :cep, bairro = :bairro, cidade = :cidade, estado = :estado, logradouro = :logradouro, numero = :numero, cpf = :cpf 
          WHERE id = :id
          ");
      $statement->execute([
        'name' => $client->getName(),
        'cep' => $client->getCep(),
        'bairro' => $client->getBairro(),
        'cidade' => $client->getCidade(),
        'estado' => $client->getEstado(),
        'logradouro' => $client->getLogradouro(),
        'numero' => $client->getNumero(),
        'cpf' => $client->getCpf(),
        'id' => $client->getId()
      ]);
  }

  public function deleteClient(int $id): void
  {
      $statement = $this->pdo
          ->prepare("
          DELETE FROM tbl_client WHERE id = :id;
          ");
      $statement->execute([
          'id' => $id
      ]);
  }

}