<?php
date_default_timezone_set('America/Sao_Paulo');

include "../excel/excel.php";

final class Download{

	function gerar($arquivo){
		$dados = file('../arquivo/'.$arquivo);
		
		$i = 0;
		$dados_formatados = [];
		foreach($dados as $int => $val):
			$remove_espaco = preg_replace('/( )+/', ";", $val); 
			$valor = explode(";", $remove_espaco);
		
			$retorno = preg_replace( "/\r|\n/", "", $valor);
		
			$dados_formatados = array_merge($dados_formatados, $retorno);
		endforeach;
		
		// echo '<pre>';
		// print_r($dados_formatados);
		// exit();
		
		$ativo = false;
		$count = 0;
		$linha = 0;
		$cabecalho = true;
		$array = [];
		foreach($dados_formatados as $r):
			if(($r == 'D:' && $cabecalho == true) || $r == '1:' || $r == '2:' || $r == '3:' || $r == '4:' || $r == '5:' || $r == '6:' || $r == '7:' || $r == '8:'):
				$ativo = true;
			endif;
			if($ativo == true):
				$remover_barra = str_replace('|', "", $r); 
				$array[$linha][$count] = $remover_barra;
				$count++;
			endif;
			if($count == 25):
				$cabecalho = false;
				$ativo = false;
				$count = 0;
				$linha++;
			endif;
		endforeach;
		
		$Excel = new Excel;
		$Excel->gerar('dados.xlsx', $array);

		header('Location: ../index.php');
	}
}

if(isset($_FILES['arquivo']) && !empty($_FILES['arquivo'])):

	$uploaddir = '../arquivo/';
	$uploadfile = $uploaddir . basename($_FILES['arquivo']['name']);

	$nome = "dados.txt";

	$uploaddir = $uploaddir.$nome;
	
	if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $uploaddir)) {
		$Download = new Download;
		$Download->gerar($nome);
	} else {
		exit();
	}

endif;
?>