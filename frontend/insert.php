<?php

//insert.php

include('database_connection.php');

$formData = json_decode(file_get_contents("php://input"));

$error = '';
$message = '';
$validationError = '';
$client_name = '';
$client_cep = '';
$client_bairro = '';
$client_cidade = '';
$client_estado = '';
$client_logradouro = '';
$client_numero = '';
$client_cpf = '';

if($formData->action == 'fetch_single_data') {
	$query = "SELECT * FROM tbl_client WHERE id='".$formData->id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row) {
		$output['client_name'] = $row['client_name'];
		$output['client_cpf'] = $row['client_cpf'];
		$output['client_cep'] = $row['client_cep'];
		$output['client_bairro'] = $row['client_bairro'];
		$output['client_cidade'] = $row['client_cidade'];
		$output['client_estado'] = $row['client_estado'];
		$output['client_logradouro'] = $row['client_logradouro'];
		$output['client_cpf'] = $row['client_cpf'];
	}
} elseif($formData->action == "Delete") {
	$query = "
	DELETE FROM tbl_client WHERE id='".$formData->id."'
	";
	$statement = $connect->prepare($query);
	if($statement->execute())	{
		$output['message'] = 'Cliente removido';
	}
} else {

	if(!is_numeric($formData->client_cpf)) {
		$validationError = 'Informe apenas números no CPF';
	} else if(!is_numeric($formData->client_cep)) {
		$validationError = 'Informe apenas números no CEP';
	} else {

		
		if(empty($error))	{
		if($formData->action == 'Insert') {
			$querySelect = "
			SELECT * FROM tbl_client WHERE cpf = {$formData->client_cpf}
			";
			
			$data = array(
				':name'		=>	$formData->client_name,
				':cep'		=>	$formData->client_cep,
				':bairro'		=>	$formData->client_bairro,
				':cidade'		=>	$formData->client_cidade,
				':estado'		=>	$formData->client_estado,
				':logradouro'		=>	$formData->client_logradouro,
				':numero'		=>	$formData->client_numero,
				':cpf'		=>	$formData->client_cpf
			);
			
			$statement = $connect->prepare($querySelect);
			$statement->execute($data);
			$result = $statement->fetchAll();
			if (count($result) > 0 ) {
				$validationError = 'CPF já inserido';
			} else {
				$query = "
				INSERT INTO tbl_client 
				(name, cep, bairro, cidade, estado, logradouro, numero, cpf) VALUES 
				(:name, :cep, :bairro, :cidade, :estado, :logradouro, :numero, :cpf)
				";
				$statement = $connect->prepare($query);
				if($statement->execute($data)) {
					$message = 'Cliente inserido';
				}
			}
		}
		if($formData->action == 'Edit')	{
			$data = array(
				':name'		=>	$formData->client_name,
				':cep'		=>	$formData->client_cep,
				':bairro'		=>	$formData->client_bairro,
				':cidade'		=>	$formData->client_cidade,
				':estado'		=>	$formData->client_estado,
				':logradouro'		=>	$formData->client_logradouro,
				':numero'		=>	$formData->client_numero,
				':cpf'		=>	$formData->client_cpf,
				':id'			=>	$formData->id
			);
			$query = "
			UPDATE tbl_client 
			SET name = :name, cep = :cep, bairro = :bairro, cidade = :cidade, estado = :estado, logradouro = :logradouro, numero = :numero, cpf = :cpf 
			WHERE id = :id
			";
			
			$statement = $connect->prepare($query);
			if($statement->execute($data)) {
				$message = 'Cliente editado';
			}
		}
	}	else {
		$validationError = implode(", ", $error);
	}
}

	$output = array(
		'error'		=>	$validationError,
		'message'	=>	$message
	);

}

echo json_encode($output);

?>