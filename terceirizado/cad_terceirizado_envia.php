<?php
session_start();
$nome = $_POST["nome"];
$senha = md5($_POST["senha"]);
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$status = $_POST["status"];
$perfil = 3;
$data=date("y/m/d");

require_once ("../Classes/Generica.class.php");

$objTer = new Generica();
$tabela = "terceirizado";
$dados = $objTer->consultaEmail($tabela,$email);

if($dados != 0){
	$_SESSION['texto_erro'] = 'Este email já existe cadastrado no sistema!';
	$_SESSION['nome'] = $nome;
	$_SESSION['email'] = $email;
	$_SESSION['telefone'] = $telefone;
	header ("Location:cad_terceirizado.php");
}else{

	$objTer = new Generica();
	$tabela = 'cliente';
	$dadosCliente = array('nome' => $nome,'senha' => $senha,'email' => $email,'telefone' => $telefone,'status' => $status,
		'perfil' => $perfil,'data' => $data
	);

	$dados = $objTer->cadastrarDados($tabela, $dadosCliente);

	if($dados == 1){
		$_SESSION['texto_sucesso'] = 'Dados adicionados com sucesso.';
		unset($_SESSION['texto_erro']);
		unset ($_SESSION['nome']);
		unset ($_SESSION['email']);
		unset ($_SESSION['senha']);
		unset ($_SESSION['telefone']);
		header ("Location:terceirizado.php");
	}else{
		$_SESSION['texto_erro'] = 'O dados não foram adicionados no sistema!';
		$_SESSION['nome'] = $nome;
		$_SESSION['email'] = $email;
		$_SESSION['telefone'] = $telefone;
		header ("Location:cad_terceirizado.php");
	}
}

?>