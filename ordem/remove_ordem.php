<?php 
	require_once("../valida_session/valida_session.php");
	require_once ("../Classes/Generica.class.php");

	$codigo = $_GET['cod'];
	$objOrd = new Generica();
	$tabela = "ordem";
	$dados = $objOrd->removeDados($tabela,$codigo);

	if($dados == 0){
		$_SESSION['texto_erro'] = 'Os dados da ordem se serviço não foram excluidos do sistema!';
		header ("Location:ordem.php");
	}else{
		$_SESSION['texto_sucesso'] = 'Os dados da ordem se serviço foram excluidos do sistema.';
		header ("Location:ordem.php");
	}

?>