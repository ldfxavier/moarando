<?php
require_once 'PHPExcel.php';
final class Excel {
	
	public static function gerar($nome, $lista){

		$objPHPExcel = new PHPExcel();
		$objPHPExcel->getProperties()->setCreator("Lucas Xavier")
			->setTitle($nome)
			->setCategory("Relatório");

		$objPHPExcel->getActiveSheet()->setTitle('Relatório');
		$objPHPExcel->setActiveSheetIndex(0);

		$alfabeto = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ','BA','BB','BC','BD','BE','BF','BG','BH','BI','BJ','BK','BL','BM','BN','BO','BP','BQ','BR','BS','BT','BU','BV','BW','BX','BY','BZ','CA','CB','CC','CD','CE','CF','CG','CH','CI','CJ','CK','CL','CM','CN','CO','CP','CQ','CR','CS','CT','CU','CV','CW','CX','CY','CZ','DA','DB','DC','DD','DE','DF','DG','DH','DI','DJ','DK','DL','DM','DN','DO','DP','DQ','DR','DS','DT','DU','DV','DW','DX','DY','DZ','EA','EB','EC','ED','EE','EF','EG','EH','EI','EJ','EK','EL','EM','EN','EO','EP','EQ','ER','ES','ET','EU','EV','EW','EX','EY','EZ','FA','FB','FC','FD','FE','FF','FG','FH','FI','FJ','FK','FL','FM','FN','FO','FP','FQ','FR','FS','FT','FU','FV','FW','FX','FY','FZ','GA','GB','GC','GD','GE','GF','GG','GH','GI','GJ','GK','GL','GM','GN','GO','GP','GQ','GR','GS','GT','GU','GV','GW','GX','GY','GZ'];

		$linha_numero = 0;

		foreach($lista as $indice => $linha):

			foreach($linha as $val):

				$letra = $alfabeto[$linha_numero];
				$numero = $indice+1;

				$coluna_linha = $letra.$numero;

				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($coluna_linha, $val);

				if($numero == 1):
					$objPHPExcel->getActiveSheet()->getStyle($coluna_linha)->getFill()->applyFromArray([
						'type' => PHPExcel_Style_Fill::FILL_SOLID,
						'color' => ['rgb' => 'CCCCCC']
					]);
				endif;

				$objPHPExcel->getActiveSheet()->getStyle($coluna_linha)->applyFromArray([
					'borders' => [
						'allborders' => [
							'style' => PHPExcel_Style_Border::BORDER_THIN
						]
					]
				]);

				$objPHPExcel->getActiveSheet()->getColumnDimension($letra)->setAutoSize(true);

				$linha_numero++;

			endforeach;

			$linha_numero = 0;

		endforeach;

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$nome.'"');
		header('Cache-Control: max-age=0');
		header('Cache-Control: max-age=1');
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
		header ('Cache-Control: cache, must-revalidate');
		header ('Pragma: public');

		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$objWriter->save('php://output');
	}
}