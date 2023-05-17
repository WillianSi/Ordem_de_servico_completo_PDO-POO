<?php
session_start();
$cod_cliente = $_POST["cod_cliente"];
$cod_servico = $_POST["cod_servico"];
$cod_terceirizado = $_POST["cod_terceirizado"];
$data_servico = $_POST["data_servico"];
$status = 1;
$data=date("y/m/d");

require_once ("../Classes/Generica.class.php");

$objOrd = new Generica();
$tabela = 'ordem';
$dadosCliente = array('cod_cliente' => $cod_cliente,'cod_servico' => $cod_servico,'cod_terceirizado' => $cod_terceirizado,
	'data_servico' => $data_servico,'status' => $status,'data' => $data);

$dados = $objOrd->cadastrarDados($tabela, $dadosCliente);

if($dados == 1){
	$_SESSION['texto_sucesso'] = 'Ordem de serviço aberta com sucesso.';
	unset($_SESSION['texto_erro']);
	header ("Location:resumo_ordem.php");
}else{
	$_SESSION['texto_erro'] = 'O dados não foram adicionados no sistema!';
	header ("Location:cad_ordem.php");
}
?>