<?php

/** Error reporting */
require_once('cnx/conexion.php');
conectar();
error_reporting(E_ALL);


$hoy=date("d-m-Y H:i:s");
date_default_timezone_set('Europe/London');

/** Include PHPExcel */
require_once 'includes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Yitec")
							 ->setLastModifiedBy("Yitec")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Etiquetas para contrato")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

//pongo la columna como autoajustable
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);


//verifico si lleva proteina para etiqueta ciclon
$result=mysql_query("select c.nombre from tbl_analisis a, tbl_categoriasanalisis c where a.id_contrato='".$_REQUEST['contrato']."' and a.id_muestra='".$_REQUEST['numero']."' and c.id=a.id_analisis");
$encontrado=0;
$analisis="Proteína Cruda";
while($row=mysql_fetch_assoc($result)){
 	
 
	if(utf8_encode($row['nombre'])==$analisis){
		$encontrado=1;
	}
}//end while


$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getCell('A1')->setValue("Código=".$_REQUEST['codigo']."\nAnálisis");
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setName('Arial');
$objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize(20);
$objPHPExcel->getActiveSheet()->getCell('A2')->setValue("Código=".$_REQUEST['codigo']."\nCustodia");
$objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setWrapText(true);

if($encontrado==1){
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setName('Arial');
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize(20);
	$objPHPExcel->getActiveSheet()->getCell('A3')->setValue("Código=".$_REQUEST['codigo']."\nCiclón");
	$objPHPExcel->getActiveSheet()->getStyle('A3')->getAlignment()->setWrapText(true);
	
}


// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Etiquetas Contrato '.$_REQUEST['contrato']);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
//pongo la impresion como landscape
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
//Seteo los margenes de impresion
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.10);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.20);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.50);




// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//$disposition='Content-Disposition: attachment;filename="Etiquetas COntrato "'..
header('Content-Disposition: attachment;filename="Etiquetas Contrato '.$_REQUEST['contrato'].'.xls"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
