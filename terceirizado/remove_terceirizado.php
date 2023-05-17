<?php 
	require_once("../valida_session/valida_session.php");
	require_once ("../Classes/Generica.class.php");

	$codigo = $_GET['cod'];
	$objTer = new Generica();
	$tabela = "terceirizado";
	$dados = $objTer->removeDados($tabela,$codigo);

	if($dados == 0){
		$_SESSION['texto_erro'] = 'Os dados do terceirizado não foram excluidos do sistema!';
		header ("Location:terceirizado.php");
	}else{
		$_SESSION['texto_sucesso'] = 'Os dados do terceirizado foram excluidos do sistema.';
		header ("Location:terceirizado.php");
	}

?>