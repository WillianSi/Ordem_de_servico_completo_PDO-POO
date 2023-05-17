<?php 
	require_once("../valida_session/valida_session.php");
	require_once ("../Classes/Generica.class.php");

	$codigo = $_GET['cod'];
	$objSer = new Generica();
	$tabela = "servico";
	$dados = $objSer->removeDados($tabela,$codigo);

	if($dados == 0){
		$_SESSION['texto_erro'] = 'Os dados do serviço não foram excluidos do sistema!';
		header ("Location:servico.php");
	}else{
		$_SESSION['texto_sucesso'] = 'Os dados do serviço foram excluidos do sistema.';
		header ("Location:servico.php");
	}

?>