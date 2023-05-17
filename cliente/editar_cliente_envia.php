<?php
require_once("../valida_session/valida_session.php");
require_once ("../Classes/Generica.class.php");

$objCli = new Generica();

$codigo = $_POST["cod"];
$status = $_POST["status"];
$data=date("y/m/d");

$tabela = 'cliente';
$dados = $objCli->queryEditar($tabela,$codigo,$status,$data);

if ($dados == 1){
	$_SESSION['texto_sucesso'] = 'Os dados do cliente foram alterados no sistema.';
	header ("Location:cliente.php");
}else{
	$_SESSION['texto_erro'] = 'Os dados do cliente não foram alterados no sistema!';
	header ("Location:cliente.php");
}

		
?>