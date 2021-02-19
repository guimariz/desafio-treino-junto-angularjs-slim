<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use App\DAO\MySQL\TreinoJunto\ClientsDAO;
use App\Models\MySQL\TreinoJunto\ClientModel;
use Slim\Container;

final class ClientsController {
  public function getClients(Request $request, Response $response, array $args): Response {
    $clientsDAO = new ClientsDAO();
    $clients = $clientsDAO->getAllClients();
    $response = $response->withJson($clients);

    return $response;
  }
  public function insertClient(Request $request, Response $response, array $args): Response {
    $data = $request->getParsedBody();
    
    $clientsDAO = new ClientsDAO();
    $client = new ClientModel();
    $client->setName($data['name'])
      ->setCep($data['cep'])
      ->setBairro($data['bairro'])
      ->setCidade($data['cidade'])
      ->setEstado($data['estado'])
      ->setLogradouro($data['logradouro'])
      ->setNumero($data['numero'])
      ->setCpf($data['cpf']);
    $clientsDAO->insertClient($client);

    $response = $response->withJson([
      'message' => 'Cliente inserido com sucesso!'
    ]);
    
    return $response;
  }
  public function updateClient(Request $request, Response $response, array $args): Response  {
    $data = $request->getParsedBody();

    $clientsDAO = new ClientsDAO();
    $client = new ClientModel();
    $client->setName($data['name'])
      ->setCep($data['cep'])
      ->setBairro($data['bairro'])
      ->setCidade($data['cidade'])
      ->setEstado($data['estado'])
      ->setLogradouro($data['logradouro'])
      ->setNumero($data['numero'])
      ->setCpf($data['cpf'])
      ->setId($data['id']);
    $clientsDAO->updateClient($client);

    $response = $response->withJson([
        'message' => 'Cliente alterado com sucesso!'
    ]);

    return $response;
  }
  public function deleteClient(Request $request, Response $response, array $args): Response  {
    $queryParams = $request->getQueryParams();

    $clientsDAO = new ClientsDAO();
    $id = (int)$queryParams['id'];
    $clientsDAO->deleteClient($id);

    $response = $response->withJson([
        'message' => 'Cliente excluído com sucesso!'
    ]);

    return $response;
  }
}