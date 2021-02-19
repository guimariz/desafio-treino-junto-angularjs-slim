<?php

namespace App\Models\MySQL\TreinoJunto;

final class ClientModel {

  /**
   * @var int
   */
  private $id;

  /**
   * @var string
   */
  private $name;

  /**
   * @var string
   */
  private $cep;

  /**
   * @var string
   */
  private $bairro;

  /**
   * @var string
   */
  private $cidade;

  /**
   * @var string
   */
  private $estado;

  /**
   * @var string
   */
  private $logradouro;
  
  /**
   * @var string
   */
  private $numero;
  
  /**
   * @var string
   */
  private $cpf;

  /**
   * @return int
   */
  public function getId(): int {
    return $this->id;
  }
  
  public function setId(int $id): ClientModel {
    $this->id = $id;
    return $this;
  }
  
   /**
   * @return string
   */
  public function getName(): string {
    return $this->name;
  }
  /**
   * @param string
   * @return ClientModel
   */
  public function setName(string $name): ClientModel {
    $this->name = $name;
    return $this;
  }

  /**
   * @return string
   */
  public function getCep(): string {
    return $this->cep;
  }
  /**
   * @param string
   * @return ClientModel
   */
  public function setCep(string $cep): ClientModel {
    $this->cep = $cep;
    return $this;
  }

  /**
   * @return string
   */
  public function getBairro(): string {
    return $this->bairro;
  }
  /**
   * @param string
   * @return ClientModel
   */
  public function setBairro(string $bairro): ClientModel {
    $this->bairro = $bairro;
    return $this;
  }

  /**
   * @return string
   */
  public function getCidade(): string {
    return $this->cidade;

  }
  /**
   * @param string
   * @return ClientModel
   */
  public function setCidade(string $cidade): ClientModel {
    $this->cidade = $cidade;
    return $this;
  }

  /**
   * @return string
   */
  public function getEstado(): string {
    return $this->estado;
  }
  /**
   * @param string
   * @return ClientModel
   */
  public function setEstado(string $estado): ClientModel {
    $this->estado = $estado;
    return $this;
  }

  /**
   * @return string
   */
  public function getLogradouro(): string {
    return $this->logradouro;
  }
  /**
   * @param string
   * @return ClientModel
   */
  public function setLogradouro(string $logradouro): ClientModel {
    $this->logradouro = $logradouro;
    return $this;
  }

  /**
   * @return string
   */
  public function getNumero(): string {
    return $this->numero;
  }
  /**
   * @param string
   * @return ClientModel
   */
  public function setNumero(string $numero): ClientModel {
    $this->numero = $numero;
    return $this;
  }

  /**
   * @return string
   */
  public function getCpf(): string {
    return $this->cpf;
  }
  /**
   * @param string
   * @return ClientModel
   */
  public function setCpf(string $cpf): ClientModel {
    $this->cpf = $cpf;
    return $this;
  }

}