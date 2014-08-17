<?php
session_start();
include('../cnx/conexion.php');
conectar();

/** Error reporting */
error_reporting(E_ALL);

date_default_timezone_set('Europe/London');

/** Include PHPExcel */
require_once '../includes/PHPExcel/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");



//**********************************************Tipo muestreo**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_codigos_alimentos");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$col, $row->codigo)
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Codigos Alimentos');
$objPHPExcel->createSheet();


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Listado_materias.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
