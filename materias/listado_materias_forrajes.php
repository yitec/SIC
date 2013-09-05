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
$result=mysql_query("select * from bd_materiasprimas.tbl_tipo_muestreo");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$col, $row->id)
            ->setCellValue('B'.$col, $row->nombre);
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Tipo Muestreo');
$objPHPExcel->createSheet();
//**********************************************Tipo muestreo**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_clase_alimento");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(1)
            ->setCellValue('A'.$col, $row->id)
            ->setCellValue('B'.$col, $row->nombre);
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Clase Alimento');
$objPHPExcel->createSheet();
// Create a new worksheet
//**********************************************Tipo alimento**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_tipo_alimento");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(2)
            ->setCellValue('A'.$col, $row->id)
            ->setCellValue('B'.$col, $row->nombre);
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Tipo Alimento');
$objPHPExcel->createSheet();
// Create a new worksheet
//**********************************************Codigo alimento**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_codigos_alimentos");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$result2=mysql_query("select * from bd_materiasprimas.tbl_fuente where id_codigo='".$row->id."'");
$row2=mysql_fetch_object($result2);
if (mysql_num_rows($result2)>0){
$objPHPExcel->setActiveSheetIndex(3)
            ->setCellValue('A'.$col, $row->id)
            ->setCellValue('B'.$col, utf8_encode($row2->nombre))
            ->setCellValue('C'.$col, utf8_encode($row->nombre));
}
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Codigos Alimento');
$objPHPExcel->createSheet();
// Create a new worksheet
//**********************************************Clasificacion**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_clasificacion");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(4)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Clasificacion Internacional');
$objPHPExcel->createSheet();
//**********************************************Año**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_year");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(5)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Año Toma Muestra');
$objPHPExcel->createSheet();
//**********************************************Procesamiento**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_procesamiento");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(6)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Tipo Procesamiento');
$objPHPExcel->createSheet();
//**********************************************Fuente**************************************
$result=mysql_query("select * from bd_materiasprimas.tbl_fuente");
$col=0;
while ($row=mysql_fetch_object($result)){                                           
$col++;
$objPHPExcel->setActiveSheetIndex(7)
            ->setCellValue('A'.$col,utf8_encode($row->id))
            ->setCellValue('B'.$col, utf8_encode($row->nombre));
}
// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Fuentes');
$objPHPExcel->createSheet();


// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Listado_materias.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
