<?php


/** Error reporting */
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
							 ->setTitle("Yitec ")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");

//pongo la columna como autoajustable
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);




$objPHPExcel->getActiveSheet()->getCell('A1')->setValue("Contrato=".$_REQUEST['contrato']."\nMuestra=".$_REQUEST['muestra']."\nCódigo=".$_REQUEST['codigo']."\nAnálisis=".$_REQUEST['nombre']);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(true);



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Etiqueta Análisis ');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
//pongo la impresion como landscape
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
//Seteo los margenes de impresion
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.20);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.20);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.50);




// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//$disposition='Content-Disposition: attachment;filename="Etiquetas COntrato "'..
header('Content-Disposition: attachment;filename="Etiquetas Analisis"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
